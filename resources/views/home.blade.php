@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel-body">
                {!! history()->render() !!}
            </div>
        </div>
    </div>
@endsection
