<x-admin-master>
    @section('content')
        <div class="container">
            <form method="POST" action="{{route('chat.filter')}}">
                @csrf
                <label for="filter"><strong>Filter by:</strong></label>
                <select class="form-select col-md-3" name="filter">
                    <option value="default"  {{ $filter === 'default' ? 'selected' : '' }}>Default</option>
                    <option value="latest" {{ $filter === 'latest' ? 'selected' : '' }}>Latest Chats Order</option>
                </select>
                <br>
                <button class="btn btn-primary" type="submit">Apply Filter</button>
            </form>
            <hr>
            <div class="row">
                <div class="col-md-10">
                    <div class="list-group">
                        @foreach($sortedEmployees as $employee)
                            <div style="margin: 10px;box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div id="chat_{{$employee->id}}">
                                    <img height="50px" style="border-radius: 50%" src="{{asset('employeedashboard/images/faces/face15.jpg')}}" alt="image">
                                    <span class="font-weight-bold">{{$employee->first_name}} {{$employee->last_name}}</span>
                                    <p style="padding: 10px 0 0 50px; color: grey">
                                        @php
                                            $latestMessage = $employee->message()->latest('created_at')->first();
                                        @endphp
                                        {{ $latestMessage ? $latestMessage->created_at->diffForHumans() : 'No messages yet' }}
                                    </p>
                                </div>
                                <form method="POST" action="{{route('selected.admin',$employee)}}">
                                    @csrf
                                      <button type="submit" class="btn btn-primary">Chat</button>
                                </form>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    @endsection

</x-admin-master>
