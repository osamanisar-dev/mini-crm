<x-employee-master>
    @section('content')

        <div class="chat">

            <!-- Header -->
            <div class="top">
                <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
                <div>
                    <p>{{$admin->name}}</p>
                    <p style="display: none" id="admin_id">{{$admin->id}}</p>
                    <small>Online</small>
                </div>
            </div>

            <div class="messages">
                @foreach($messages as $message)
                    <p style="display: none" id="employee_id">{{$message->employee_id}}</p>

                @if($message->sender_type === 'user')
                        <div class="right message">

                            <strong style="color: #9829ff"
                                    class="status-message message-box-user">{{$message->message}}</strong>
                            <img height="50px" src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg"
                                 alt="Profile picture">
                        </div>
                    @elseif($message->sender_type === 'admin')
                        <div class="left message">
                            <img height="50px" src="{{asset('employeedashboard/images/faces/face9.jpg')}}"
                                 alt="Profile picture">
                            <strong style="color: blue"
                                    class="status-message message-box-admin">{{$message->message}}</strong>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="bottom">
                <form>
                    <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                    <button type="submit"></button>
                </form>
            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
            $(document).ready(function () {
                const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap2'});
                const channel = pusher.subscribe('public');

                //Receive messages
                channel.bind('chat', function (data) {

                    // console.log(data)
                    var check = $('#employee_id').text()
                    console.log((check))
                    console.log(data['employee_id'])
                    if (check === data['employee_id']) {
                        $.post("/employee/receive", {

                            _token: '{{csrf_token()}}',
                            message: data.message,

                        }).done(function (res) {

                            $(".messages > .message").last().after(res);
                            $(document).scrollTop($(document).height());
                        });
                    }

                });

                //Broadcast messages
                $("form").submit(function (event) {
                    event.preventDefault();
                    var admin_id = $('#admin_id').text();
                    var employee_id = $('#employee_id').text();
                    console.log(employee_id)
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/employee/broadcast",
                        method: 'POST',
                        headers: {
                            'X-Socket-Id': pusher.connection.socket_id
                        },
                        data: {
                            _token: '{{csrf_token()}}',
                            message: $("form #message").val(),
                            admin_id,
                            employee_id,
                        }
                    }).done(function (res) {
                        console.log(res)
                        if (res.status === 'success') {

                            new_msg = res.message['message'];
                            var newMessageDiv = $('<div class="right message"></div>');
                            var messageText = $('<strong style="color: #9829ff" class="status-message message-box-user"></strong>').text(new_msg);
                            var profileImage = $('<img height="50px" src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Profile picture">');

                            newMessageDiv.append(messageText);
                            newMessageDiv.append(profileImage);
                            $(".messages").append(newMessageDiv);
                            $(".messages > .message").last().after(res);
                            $(document).scrollTop($(document).height());


                        } else {

                            $(".status-message").text(res.message);
                        }
                        $("form #message").val('');
                    });

                    $.ajax({
                        url: "/admin/employee/notificationTesting",
                        method: 'POST',
                        headers: {
                            'X-Socket-Id': pusher.connection.socket_id
                        },
                        data: {
                            _token: '{{csrf_token()}}',
                            message: $("form #message").val(),
                            admin_id,
                            employee_id,
                        }
                    });
                });
            });

        </script>
    @endpush
</x-employee-master>
