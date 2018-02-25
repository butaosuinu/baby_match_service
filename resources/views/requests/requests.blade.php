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
                        <p>日時：{!! nl2br(e($request->date)) !!}</p>
                        {{-- @if ($user->is_contract($request->id))
                            <p>受注者：</p>
                            <p>受注者メール：</p>
                        @endif --}}
                    </div>
                    <div>
                        {{-- @include('requests.contract_button', ['request' => $request]) --}}
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