<x-employee-master>

    @section('content')
        <h3>User Profile</h3>
        <hr style="color: mediumpurple">
        <div class="container">
            <form method="POST" action="{{route('employee.self.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><strong>First Name</strong> <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" value="{{old('title',Auth::user()->first_name)}}"
                               id="first_name" name="first_name"
                               placeholder="First Name">
                        <span style="color:red;font-size: 12px;">
                        @error('first_name')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Last Name</strong> <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" value="{{old('title',Auth::user()->last_name)}}"
                               id="last_name" name="last_name"
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
                        <label for="exampleInputEmail1"><strong>Username</strong> <sup
                                style="color: red">*</sup></label>
                        <input type="text" class="form-control" value="{{old('title',Auth::user()->username)}}"
                               id="username" name="username"
                               placeholder="Enter username">
                        <span style="color:red;font-size: 12px;">
                        @error('username')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><strong>Email</strong> <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" value="{{old('title',Auth::user()->email)}}" id="email"
                               name="email"
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
                        <label class="form-label select-label"><strong>Select Company <sup
                                    style="color: red">*</sup></strong></label><br/>
                        <select disabled class="form-control selectpicker" multiple data-live-search="true"
                                id="company_id" name="company_id[]" data-max-options="3">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}"
                                        @if(in_array($company->id, old('company_id', Auth::user()->companies->pluck('id')->toArray())))
                                            selected
                                    @endif>
                                    {{$company->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    @endsection
</x-employee-master>
