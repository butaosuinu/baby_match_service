<ul class="media-list">
@foreach ($requests as $request)
    <?php $user = $request->user; ?>
    <li class="media">
        <div class="media-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    依頼人：{!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!}
                </div>
                <div class="panel-body">
                    <div>
                        <p>場所：{!! nl2br(e($request->area)) !!}</p>
                        <p>日時：{{ $request->date }}</p>
                        @if ($request->contracteds())
                            @foreach ($request->contracteds() as $contractor)
                                <p>受注者：{{ $contractor->name }}</p>
                                <p>受注者メール：{{ $contractor->email }}</p>
                            @endforeach
                        @endif
                    </div>
                    <div>
                        {{-- @include('requests.contract_button', ['request' => $request]) --}}
                        @if ($request->is_contracted(Auth::user()->id))
                            {!! Form::open(['route' => ['user.uncontract', $request->id], 'method' => 'delete']) !!}
                                {!! Form::submit('受注済', ['class' => "btn btn-success btn-xs"]) !!}
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => ['user.contract', $request->id]]) !!}
                                {!! Form::submit('受注する', ['class' => "btn btn-default btn-xs"]) !!}
                            {!! Form::close() !!}
                        @endif

                        @if (Auth::user()->id == $request->user_id)
                            {!! Form::open(['route' => ['requests.destroy', $request->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $requests->render() !!}