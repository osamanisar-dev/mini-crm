@if(!empty($employee_id))
    <div class="left message">
        <img height="50px" src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Profile picture">
        <strong style="color: #9829ff" class="status-message message-box-user">{{$message}}</strong>
    </div>
@else
    <div class="left message">
        <img height="50px" src="{{asset('employeedashboard/images/faces/face9.jpg')}}" alt="Profile picture">
        <strong style="color: blue" class="status-message message-box-admin">{{$message}}</strong>
    </div>
@endif
