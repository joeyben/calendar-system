@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.rooms.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.room-number')</th>
                            <td field-key='room_number'>{{ $room->room_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.floor')</th>
                            <td field-key='floor'>{{ $room->floor }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.description')</th>
                            <td field-key='description'>{!! $room->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active"><a href="#bookings" aria-controls="bookings" role="tab"
                                                          data-toggle="tab">Buchungen</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="bookings">
                    <table class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable' : '' }}">
                        <thead>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.customer')</th>
                            <th>@lang('quickadmin.bookings.fields.room')</th>
                            <th>@lang('quickadmin.bookings.fields.time-from')</th>
                            <th>@lang('quickadmin.bookings.fields.time-to')</th>
                            <th>@lang('quickadmin.bookings.fields.additional-information')</th>
                            @if( request('show_deleted') == 1 )
                                <th>&nbsp;</th>
                            @else
                                <th>&nbsp;</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @if (count($bookings) > 0)
                            @foreach ($bookings as $booking)
                                <tr data-entry-id="{{ $booking->id }}">
                                    <td field-key='customer'>{{ $booking->customer->first_name or '' }}</td>
                                    <td field-key='room'>{{ $booking->room->room_number or '' }}</td>
                                    <td field-key='time_from'>{{ $booking->time_from }}</td>
                                    <td field-key='time_to'>{{ $booking->time_to }}</td>
                                    <td field-key='additional_information'>{!! $booking->additional_information !!}</td>
                                    @if( request('show_deleted') == 1 )
                                        <td>
                                            @can('booking_delete')
                                                {!! Form::open(array(
                'style' => 'display: inline-block;',
                'method' => 'POST',
                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                'route' => ['admin.bookings.restore', $booking->id])) !!}
                                                {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                            @can('booking_delete')
                                                {!! Form::open(array(
                'style' => 'display: inline-block;',
                'method' => 'DELETE',
                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                'route' => ['admin.bookings.perma_del', $booking->id])) !!}
                                                {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    @else
                                        <td>
                                            @can('booking_view')
                                                <a href="{{ route('admin.bookings.show',[$booking->id]) }}"
                                                   class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                            @endcan
                                            @can('booking_edit')
                                                <a href="{{ route('admin.bookings.edit',[$booking->id]) }}"
                                                   class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                            @endcan
                                            @can('booking_delete')
                                                {!! Form::open(array(
                                                                                        'style' => 'display: inline-block;',
                                                                                        'method' => 'DELETE',
                                                                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                        'route' => ['admin.bookings.destroy', $booking->id])) !!}
                                                {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="calendar"></div>

            <a href="{{ route('admin.rooms.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
    <div class="modal modal-fade" id="event-modal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">
                        Buchung
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="event-index" value="">
                        {!! Form::open(['method' => 'POST','class'=>'form-horizontal', 'route' => ['admin.bookings.store']]) !!}
                        <div class="form-group">
                            {!! Form::label('customer_id', trans('quickadmin.bookings.fields.customer').'*', ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-7">
                                {!! Form::select('customer_id', $customers, old('customer_id'), ['class' => 'form-control select2', 'style' => 'width:100%', 'required' => true]) !!}
                            </div>
                            <p class="help-block"></p>
                            @if($errors->has('customer_id'))
                                <p class="help-block">
                                    {{ $errors->first('customer_id') }}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('additional_information', trans('quickadmin.bookings.fields.additional-information'), ['class' => 'col-sm-4 control-label']) !!}

                            <div class="col-sm-7">
                                {!! Form::textarea('additional_information', old('additional_information'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time_from" class="col-sm-4 control-label">Datum</label>
                            <div class="col-sm-7">
                                <div class="input-group input-daterange">
                                    <input name="time_from" type="text" class="form-control datetimepicker" value="2019-04-05">
                                    <span class="input-group-addon">bis</span>
                                    <input name="time_to" type="text" class="form-control datetimepicker" value="2019-04-19">
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <input name="room_id" type="hidden" class="form-control" value="{{ $room->id }}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary' ]) !!}

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@section('javascript')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('.datetimepicker').datetimepicker({
            format: "YYYY-MM-DD HH:mm"
        });
    </script>
    <script type="application/javascript" src="{{ url('js') }}/app.js"></script>

    <script type="application/javascript">
        function editEvent(event) {
            $('#event-modal input[name="event-index"]').val(event ? event.customer : '');
            $('#event-modal input[name="event-name"]').val(event ? event.name : '');
            $('#event-modal input[name="event-location"]').val(event ? event.location : '');
            $('#event-modal input[name="time_from"]').datetimepicker('date', event ? event.startDate : '');
            $('#event-modal input[name="time_to"]').datetimepicker('date', event ? event.endDate : '');
            $('#event-modal').modal();
        }
        $('.calendar').calendar({
            alwaysHalfDay: true,
            style:'background',
            enableContextMenu: true,
            enableRangeSelection: true,
            selectRange: function(e) {
                editEvent({ startDate: e.startDate, endDate: e.endDate });
            },
            dataSource: [
                @if (count($booking_arr) > 0)
                        @foreach ($booking_arr as $booking)
                    {
                    customer: '{{ $booking['customer'] }}',
                    name: '{{ $booking['additional_information'] }}',
                    startDate: new Date({{ $booking['startDateY'] }}, {{ $booking['startDateM'] }}, {{ $booking['startDateD'] }}),
                    endDate: new Date({{ $booking['endDateY'] }}, {{ $booking['endDateM'] }}, {{ $booking['endDateD'] }})
                    },
        @endforeach
        @endif
            ],
            mouseOnDay: function(e) {
                if(e.events.length > 0) {
                    var content = '';

                    for(var i in e.events) {
                        content += '<div class="event-tooltip-content">'
                            + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].customer + '</div>'
                            + '<div class="event-location">' + e.events[i].name + '</div>'
                            + '</div>';
                    }

                    $(e.element).popover({
                        trigger: 'manual',
                        container: 'body',
                        html:true,
                        content: content
                    });

                    $(e.element).popover('show');
                }
            },
            mouseOutDay: function(e) {
                if(e.events.length > 0) {
                    $(e.element).popover('hide');
                }
            },
        });

    </script>
@endsection
@stop
