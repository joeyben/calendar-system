<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoomsRequest;
use App\Http\Requests\Admin\UpdateRoomsRequest;
use App\Events\Rooms\RoomCreated;
use App\Events\Rooms\RoomDeleted;
use App\Events\Rooms\RoomUpdated;

class RoomsController extends Controller
{
    /**
     * Display a listing of Room.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('room_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('room_delete')) {
                return abort(401);
            }
            $rooms = Room::onlyTrashed()->get();
        } else {
            $rooms = Room::all();
        }

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating new Room.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('room_create')) {
            return abort(401);
        }
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created Room in storage.
     *
     * @param  \App\Http\Requests\StoreRoomsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomsRequest $request)
    {
        if (! Gate::allows('room_create')) {
            return abort(401);
        }
        $room = Room::create($request->all());

        event(new RoomCreated($room));

        return redirect()->route('admin.rooms.index');
    }


    /**
     * Show the form for editing Room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('room_edit')) {
            return abort(401);
        }
        $room = Room::findOrFail($id);

        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update Room in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomsRequest $request, $id)
    {
        if (! Gate::allows('room_edit')) {
            return abort(401);
        }
        $room = Room::findOrFail($id);
        $room->update($request->all());

        event(new RoomUpdated($room));

        return redirect()->route('admin.rooms.index');
    }


    /**
     * Display Room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('room_view')) {
            return abort(401);
        }
        $bookings = \App\Booking::where('room_id', $id)->get();

        $booking_arr = [];
        foreach ($bookings as $book){
            $start = new \DateTime($book['time_from']);
            $end = new \DateTime($book['time_to']);
            array_push($booking_arr, array(
                'id' => $book['id'],
                'customer' => $book->getCustomer()[0]->first_name." ".$book->getCustomer()[0]->last_name,
                'additional_information'=> $book['additional_information'],
                'startDateY'=> $start->format('Y'),
                'startDateM'=> $start->format('m')-1,
                'startDateD'=> $start->format('d'),
                'endDateY'=> $end->format('Y'),
                'endDateM'=> $end->format('m')-1,
                'endDateD'=> $end->format('d'),
            ));
        }
        $room = Room::findOrFail($id);

        $customers = Customer::get()->pluck('full_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.rooms.show', compact('room', 'bookings','booking_arr', 'customers'));
    }


    /**
     * Remove Room from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('room_delete')) {
            return abort(401);
        }
        $room = Room::findOrFail($id);
        $room->delete();
        event(new RoomDeleted($room));
        return redirect()->route('admin.rooms.index');
    }

    /**
     * Delete all selected Room at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('room_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Room::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Room from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('room_delete')) {
            return abort(401);
        }
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->restore();

        return redirect()->route('admin.rooms.index');
    }

    /**
     * Permanently delete Room from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('room_delete')) {
            return abort(401);
        }
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->forceDelete();

        return redirect()->route('admin.rooms.index');
    }
}
