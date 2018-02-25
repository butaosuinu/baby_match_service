@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
            <h3>依頼を出す</h3>
            {!! Form::open(['route' => 'requests.store']) !!}
                <div class="form-group">
                    {!! Form::label('area', '場所') !!}
                    {!! Form::text('area', old('area'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('day', '日時') !!}
                    {!! Form::date('day', old('day'), ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('依頼を出す', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </aside>
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">依頼一覧 </a></li>
                <li role="presentation" class="{{ Request::is('users/*/contracts') ? 'active' : '' }}"><a href="{{ route('users.contracts', ['id' => $user->id]) }}">契約済み </a></li>
            </ul>
            @if (count($requests) > 0)
                @include('requests.requests', ['requests' => $requests])
            @endif
        </div>
    </div>
@endsection
