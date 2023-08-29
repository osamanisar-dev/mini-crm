<x-admin-master>
    @section('content')

        <div class="chat">

            <!-- Header -->
            <div class="top">
                <img src="{{asset('employeedashboard/images/faces/face9.jpg')}}" alt="Avatar">
                <div>
                    @if(isset($employee))
                        <p>{{$employee->first_name}} {{$employee->last_name}}</p>
                        <p style="display: none" id="admin_side_employee_id">{{$employee->id}}</p>
                    @endif

                    <small>Online</small>
                </div>
            </div>
            <!-- End Header -->
            <!-- Chat -->

            <div class="messages">
                @foreach($messages as $message)
                    @if($message->sender_type === 'admin')
                        <div class="right message">
                            <strong style="color: blue"
                                    class="status-message message-box-admin">{{$message->message}}</strong>
                            <img height="50px" src="{{asset('employeedashboard/images/faces/face9.jpg')}}"
                                 alt="Profile picture">
                        </div>
                    @elseif($message->sender_type === 'user')
                        <div class="left message">
                            <img height="50px" src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg"
                                 alt="Profile picture">
                            <strong style="color: #9829ff"
                                    class="status-message message-box-user">{{$message->message}}</strong>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="bottom">
                <form id="adminmsg">
                    <input type="text" id="message" name="message" placeholder="Message {{$employee->first_name}} {{$employee->last_name}}" autocomplete="off">
                    <button type="submit"></button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
