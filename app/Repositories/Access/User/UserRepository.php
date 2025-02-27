<?php

namespace App\Repositories\Access\User;

use App\Events\Access\User\UserCreated;
use App\Events\Access\User\UserDeactivated;
use App\Events\Access\User\UserDeleted;
use App\Events\Access\User\UserPasswordChanged;
use App\Events\Access\User\UserPermanentlyDeleted;
use App\Events\Access\User\UserReactivated;
use App\Events\Access\User\UserRestored;
use App\Events\Access\User\UserUpdated;
use App\Exceptions\GeneralException;
use App\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

    /**
     * @var User Model
     */
    protected $model;

    /**
     * @param RoleRepository $role
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }



    /**
     * Create User.
     *
     * @param Model $request
     */
    public function create($request)
    {
        $data = $request;
        $user = $this->createUserStub($data);

        DB::transaction(function () use ($user, $data, $roles, $permissions,$whitelabels) {
            if ($user->save()) {

                //User Created, Validate Roles
                if (!count($roles)) {
                    throw new GeneralException(trans('exceptions.backend.access.users.role_needed_create'));
                }

                //Attach new roles
                $user->attachRoles($roles);

                // Attach New Permissions
                $user->attachPermissions($permissions);

                //Attach new whitelabels
                $user->attachWhitelabels($whitelabels);

                //Send confirmation email if requested and account approval is off
                if (isset($data['confirmation_email']) && $user->confirmed == 0) {
                    $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                }

                event(new UserCreated($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
        });
    }

    /**
     * @param Model $user
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($user, $request)
    {
        $data = $request->except('assignees_roles', 'permissions');
        $roles = $request->get('assignees_roles');
        $permissions = $request->get('permissions');
        $whitelabels = $request->get('whitelabels');
        $groups = $request->get('groups');
        $this->checkUserByEmail($data, $user);

        DB::transaction(function () use ($user, $data, $roles, $permissions, $whitelabels, $groups) {
            if ($user->update($data)) {
                $user->status = isset($data['status']) && $data['status'] == '1' ? 1 : 0;
                $user->confirmed = isset($data['confirmed']) && $data['confirmed'] == '1' ? 1 : 0;

                $user->save();

                $this->checkUserRolesCount($roles);
                $this->flushRoles($roles, $user);

                $this->flushPermissions($permissions, $user);
                $this->flushWhitelabels($whitelabels, $user);
                $this->flushGroups($groups, $user);
                event(new UserUpdated($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
        });
    }

    /**
     * Change Password.
     *
     * @param $user
     * @param $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function updatePassword($user, $input)
    {
        $user = $this->find(access()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            $user->password = bcrypt($input['password']);

            if ($user->save()) {
                event(new UserPasswordChanged($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.users.update_password_error'));
        }

        throw new GeneralException(trans('exceptions.backend.access.users.change_mismatch'));
    }

    /**
     * Delete User.
     *
     * @param Model $user
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($user)
    {
        if (access()->id() == $user->id) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_self'));
        }

        if ($user->delete()) {
            event(new UserDeleted($user));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    }

    /**
     * Delete All Users.
     *
     * @param Model $user
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function deleteAll($ids)
    {
        if (in_array(access()->id(), $ids)) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_self'));
        }

        if (in_array(1, $ids)) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_admin'));
        }

        $result = DB::table('users')->whereIn('id', $ids)->delete();

        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * @param $user
     *
     * @throws GeneralException
     */
    public function forceDelete($user)
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.access.users.delete_first'));
        }

        DB::transaction(function () use ($user) {
            if ($user->forceDelete()) {
                event(new UserPermanentlyDeleted($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
        });
    }

    /**
     * @param $user
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function restore($user)
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_restore'));
        }

        if ($user->restore()) {
            event(new UserRestored($user));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param $user
     * @param $status
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function mark($user, $status)
    {
        if (access()->id() == $user->id && $status == 0) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user->status = $status;

        switch ($status) {
            case 0:
                event(new UserDeactivated($user));
            break;

            case 1:
                event(new UserReactivated($user));
            break;
        }

        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.mark_error'));
    }

    /**
     * @param  $input
     * @param  $user
     *
     * @throws GeneralException
     */
    protected function checkUserByEmail($input, $user)
    {
        //Figure out if email is not the same
        if ($user->email != $input['email']) {
            //Check to see if email exists
            if ($this->query()->where('email', '=', $input['email'])->first()) {
                throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
            }
        }
    }

    /**
     * Flush roles out, then add array of new ones.
     *
     * @param $roles
     * @param $user
     */
    protected function flushRoles($roles, $user)
    {
        //Flush roles out, then add array of new ones
        $user->detachRoles($user->roles);
        $user->attachRoles($roles);
    }

    /**
     * Flush Permissions out, then add array of new ones.
     *
     * @param $permissions
     * @param $user
     */
    protected function flushPermissions($permissions, $user)
    {
        //Flush permission out, then add array of new ones
        $user->detachPermissions($user->permissions);
        $user->attachPermissions($permissions);
    }

    /**
     * Flush Whitelabels out, then add array of new ones.
     *
     * @param $whitelabels
     * @param $user
     */
    protected function flushWhitelabels($whitelabels, $user)
    {
        //Flush permission out, then add array of new ones
        $user->detachWhitelabels($user->whitelabels);
        $user->attachWhitelabels($whitelabels);
    }


    /**
     * Flush Groups out, then add array of new ones.
     *
     * @param $groups
     * @param $user
     */
    protected function flushGroups($groups, $user)
    {
        //Flush permission out, then add array of new ones
        $user->detachGroups($user->groups);
        $user->attachGroups($groups);
    }

    /**
     * @param  $roles
     *
     * @throws GeneralException
     */
    protected function checkUserRolesCount($roles)
    {
        //User Updated, Update Roles
        //Validate that there's at least one role chosen
        if (count($roles) == 0) {
            throw new GeneralException(trans('exceptions.backend.access.users.role_needed'));
        }
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserStub($input)
    {
        $user = self::MODEL;
        $user = new $user();
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->status = isset($input['status']) ? 1 : 0;
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->confirmed = isset($input['confirmed']) ? 1 : 0;
        $user->created_by = access()->user()->id;

        return $user;
    }

    /**
     * @param $permissions
     * @param string $by
     *
     * @return mixed
     */
    public function getByPermission($permissions, $by = 'name')
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        return $this->query()->whereHas('roles.permissions', function ($query) use ($permissions, $by) {
            $query->whereIn('permissions.'.$by, $permissions);
        })->get();
    }

    /**
     * @param $roles
     * @param string $by
     *
     * @return mixed
     */
    public function getByRole($roles, $by = 'name')
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        return $this->query()->whereHas('roles', function ($query) use ($roles, $by) {
            $query->whereIn('roles.'.$by, $roles);
        })->get();
    }
}
