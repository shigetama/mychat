@extends('layouts.default')

@section('title', 'Chat Room')

@section('menu', 'CHAT ROOM')

@section('header-btn')

  <a href="{{ '/chats/create' }}" class="header_btn">ROOM</a>
  <a href="{{ URL::route('account-sign-out') }}" class="header_btn">Logout</a>
  <a href="{{'/admin '}}" class="header_btn" >管理画面</a>
@endsection

@section('content')

  <div class="container">
  <h2>参加中のROOM</h2>
  <div class="index_div">
    <table class="index_table">
      <tr>
        <th>ルーム</th>
        <th>参加ユーザー</th>
      </tr>
        @forelse($rooms as $room)
          @if($room->hasUser())
            <li class="room_show">

                <tr>
                    <td>
                      <a href="{{ action('ChatsController@room', $room) }}" class="">{{ $room->title }}</a>
                    </td>
                    <td class="join_users">
                      {{ $room->users->count() }}人参加中
                      <div class="join_user_box">
                        @forelse($room->users as $user)
                          <li>$user->name</li>
                        @empty
                        @endforelse
                      </div>
                    </td>
                    <td>
                      <a href="{{ action('ChatsController@edit', $room) }}">[メンバー追加]</a>
                    </td>
                    <td>
                      <form class="del_btn" method="post" action="{{ action('ChatsController@destroy', $room->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <input type="submit" value="削除">
                      </form>
                    </td>
                </tr>

            </li>
          @endif
        @empty
          <li>roomがありません</li>
        @endforelse
      </table>
  </div>

</div>

<div class="container">
</div>

@endsection
