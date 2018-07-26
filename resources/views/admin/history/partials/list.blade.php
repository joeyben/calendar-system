<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.qa_list')
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered table-striped {{ count($history) > 0 ? 'datatable' : '' }}">
            <thead>
            <tr>

                <th>@lang('quickadmin.history.fields.icon')</th>
                <th>@lang('quickadmin.history.fields.user')</th>
                <th>@lang('quickadmin.history.fields.type')</th>
                <th>@lang('quickadmin.history.fields.text')</th>
                <th>@lang('quickadmin.history.fields.time')</th>
                <th>@lang('quickadmin.history.fields.day')</th>
            </tr>
            </thead>

            <tbody>
                @each('admin.history.partials.item', $history, 'historyItem')

            </tbody>
        </table>
    </div>
</div>


