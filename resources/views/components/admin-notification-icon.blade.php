<ul style="padding-left: 30px" class="navbar-nav">

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-bell"></i>
            <span id="notificationCount{{session('user')->id}}" class="badge badge-light bg-primary badge-xs" value="{{session('user')->unreadNotifications->count()}}">{{session('user')->unreadNotifications->count()}}</span>
        </a>
        <ul class="dropdown-menu" style="width: 300px;">
            @if (session('user')->unreadNotifications)
                <li class="d-flex justify-content-start" style="padding: 20px">
                    <a href="{{route('mark-as-read')}}" class="btn btn-primary btn-sm">Mark All as
                        Read</a>
                </li>

<div id="unreadNotifications"></div>
                    @foreach (session('user')->unreadNotifications as $notification)
                        <ul>
                            <form method="POST"
                                  action="{{route('selected.admin',$notification->data['employee_id'])}}">
                                @csrf
                                <a onclick="this.parentNode.submit();" class="text-primary">
                                    <li id="notifi" class="p-1 text-primary"><strong>{{$notification->data['employee_name']}}</strong>  has
                                        sent message: <strong>{{$notification->data['message']}}</strong></li>
                                </a>
                            </form>
                        </ul>
                    @endforeach


            @elseif (session('user')->user()->readNotifications)
                <a href="#" class="text-secondary">
                    <li class="p-1 text-secondary"> No new notification</li>
                </a>
            @endif
        </ul>
    </li>
</ul>
