<x-admin-master>
    @section('content')
        <h3>Edit Employee</h3>
        <hr>
        <div class="container">
            <form method="POST" action="{{route('employee.update',['employee'=>$employee])}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>First Name <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" value="{{old('title',$employee->first_name)}}"
                               id="first_name" name="first_name"
                               placeholder="First Name">
                        <span style="color:red;font-size: 12px;">
                        @error('first_name')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" value="{{old('title',$employee->last_name)}}"
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
                        <label for="exampleInputEmail1">Username <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" value="{{old('title',$employee->username)}}"
                               id="username" name="username"
                               placeholder="Enter username">
                        <span style="color:red;font-size: 12px;">
                        @error('username')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Email <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" value="{{old('title',$employee->email)}}" id="email"
                               name="email"
                               placeholder="Enter E-Mail">
                        <span style="color:red;font-size: 12px;">
                        @error('email')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <label class="form-label select-label"><strong>Select Company :</strong></label><br/>
                    <select class="form-control selectpicker" multiple data-live-search="true" id="company_id"
                            name="company_id[]" data-max-options="3">
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}"
                                    @if(in_array($company->id, old('company_id', $employee->companies->pluck('id')->toArray())))
                                        selected
                                @endif>
                                {{$company->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class='btn btn-primary'>Update</button>
            </form>
        </div>
    @endsection
</x-admin-master>
