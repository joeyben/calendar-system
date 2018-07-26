<tr data-entry-id="{{ $historyItem->id }}">

    <td field-key='icon'><i class="fa fa-{{ $historyItem->icon }} {{ $historyItem->class }}"></i></td>
    <td field-key='user'><strong>{{ $historyItem->user->name }}</strong></td>
    <td field-key='type'>{{ trans('quickadmin.history.fields.type_.'.$historyItem->type->name) }}</td>
    <td field-key='text'>{!! history()->renderDescription($historyItem->text, $historyItem->assets) !!}</td>
    <td field-key='time_to'><i class="fa fa-clock-o"></i> {{ $historyItem->created_at->diffForHumans() }}</td>
    <td field-key='day'> {{ $historyItem->created_at }}</td>
</tr>


