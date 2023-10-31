<x-admin-master>
    @section('content')
        <h3>Create Employee</h3>
<hr>
        <div class="container card-body">
            <form method="POST" action="{{route('employee.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>First Name <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}"
                               placeholder="First Name">
                        <span style="color:red;font-size: 12px;">
                        @error('first_name')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}"
                               placeholder="Enter lastname">
                        <span style="color:red;font-size: 12px;">
                        @error('last_name')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Username <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}"
                               placeholder="Enter username">
                        <span style="color:red;font-size: 12px;">
                        @error('username')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Email <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                               placeholder="Enter E-Mail">
                        <span style="color:red;font-size: 12px;">
                        @error('email')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Password <sup style="color: red">*</sup></label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                               placeholder="Enter password">
                        <span style="color:red;font-size: 12px;">
                        @error('password')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Confirm Password <sup style="color: red">*</sup></label>
                        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password') }}"
                               placeholder="Re Enter password">
                        <span style="color:red;font-size: 12px;">
                        @error('confirmation_password')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                </div>
                <div class="form-group col-md-6">
                            <label class="form-label select-label"><strong>Select Company :</strong></label><br/>
                            <select class="form-control selectpicker" multiple data-live-search="true" id="company_id" name="company_id[]" data-max-options="3">
                                 @foreach($companies as $company)
                                    <option value="{{ $company->id }}">
                                      {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                    <span style="color:red;font-size: 12px;">
                        @error('company_id')
                        {{$message}}
                        @enderror
                    </span><br>
                    </div>
                <button class='btn btn-primary'>Add</button>
            </form>
        </div>
    @endsection
</x-admin-master>
