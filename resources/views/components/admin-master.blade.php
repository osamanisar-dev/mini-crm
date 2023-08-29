<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('select').selectpicker();
        });
    </script>
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/card.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('style.css')}}">


</head>

<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <div style="padding: 10px 0"
             class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{{route('home')}}"><img height="50px"
                                                                             src="{{asset('employeedashboard/images/mini_crm.png')}}"
                                                                             alt="logo"/></a>
        </div>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Admin Control
        </div>

        <x-admin-sidebar-employees-links>

        </x-admin-sidebar-employees-links>

        <x-admin-sidebar-companies-links>

        </x-admin-sidebar-companies-links>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <form method="POST" action="{{route('chat.filter')}}">
                @csrf
                <button style="color: white;text-decoration: none" class="btn btn-link" type="submit"><i
                        class="fa-solid fa-comments"></i> Chats
                </button>
            </form>
        </li>


        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item">
            <form method="POST" action="{{route('user.logout')}}">
                @csrf
                <button style="color: white;text-decoration: none" type="submit" class="btn btn-link"><i
                        class="fa-solid fa-briefcase"></i> Logout
                </button>
            </form>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <x-admin-notification-icon>

                </x-admin-notification-icon>

            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>


        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
    </div>


</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.js')}}"></script>
<script>
    const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap2'});
    const channel = pusher.subscribe('public');
    $(document.getElementById('navbarDropdown')).on('click', function () {
        new bootstrap.Dropdown(this);
    });
    document.addEventListener("click", function (event) {
        var dropdownMenu = document.querySelector(".dropdown-menu");
        var dropdownToggle = document.querySelector("#navbarDropdown");

        // Check if the clicked element is not the dropdown menu or its toggle button
        if (!dropdownMenu.contains(event.target) && !dropdownToggle.contains(event.target)) {
            dropdownMenu.classList.remove("show"); // Close the dropdown
        }
    });


    channel.bind('chat', function (data) {
        console.log(data)

        var check = $('#admin_side_employee_id').text()
        console.log((check))
        console.log(data['employee_id'])
        if (check === data['employee_id']) {
            $.post("/admin/employee/receive", {
                _token: '{{csrf_token()}}',
                message: data.message,
                employee_id: data.employee_id,
                employee_name: data.employee_name,
            }).done(function (res) {
                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
        }

        var list = $('<ul></ul>');
        var form_tag = $('<form method="POST" action="">' + '@csrf' + '</form>');
        var anchor_tag = $('<a onclick="this.parentNode.submit();" class="text-primary"></a>')
        var link = '<li id="notifi" class="p-1 text-primary"><strong>' + data.employee_name + '</strong> has sent message: <strong>' + data.message + '</strong></li>';

        list.append(form_tag);
        list.append(anchor_tag);
        list.append(link);
        $("#unreadNotifications").append(list);

        var notificationCountElement = $('#notificationCount1');
        var currentCount = parseInt(notificationCountElement.text());
        notificationCountElement.text(currentCount + 1);
        notificationCountElement.attr('value', currentCount + 1);

    });

    $("#adminmsg").submit(function (event) {
        console.log('form-hit')
        event.preventDefault();
        var employee_id = $('#admin_side_employee_id').text();
        console.log(employee_id)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/employee/broadcast",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{csrf_token()}}',
                message: $("#adminmsg #message").val(),
                employee_id,
            }
        }).done(function (res) {
            console.log(res)
            if (res.status === 'success') {
                new_msg = res.message['message'];
                var newMessageDiv = $('<div class="right message"></div>');

                var messageText = $('<strong style="color: blue" class="status-message message-box-admin"></strong>').text(new_msg);

                var profileImage = $('<img height="50px" src="{{asset('employeedashboard/images/faces/face9.jpg')}}" alt="Profile picture">');

                newMessageDiv.append(messageText);
                newMessageDiv.append(profileImage);

                $(".messages").append(newMessageDiv);


                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            } else {
                // alert('failed');
                $(".status-message").text(res.message);
            }
            $("#adminmsg #message").val('');

        });
    });
</script>

@yield('scripts')
@stack('scripts')

</body>
</html>
