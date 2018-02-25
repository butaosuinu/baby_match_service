@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-8">
            @if (count($requests) > 0)
                @include('requests.requests', ['requests' => $requests])
            @endif
        </div>
    </div>
@endsection
