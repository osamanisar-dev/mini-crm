<x-admin-master>
    @section('content')
        <h3>Edit Company Details</h3>
<hr>
        <div class="container">
            <form method="POST" action="{{route('company.update',$company)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Company Name <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$company->name}}"
                               placeholder="Company Name">
                        <span style="color:red;font-size: 12px;">
                        @error('name')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email <sup style="color: red">*</sup></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$company->email}}"
                               placeholder="Enter Email">
                        <span style="color:red;font-size: 12px;">
                        @error('email')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Website URL</label>
                        <input type="url" class="form-control" id="url" name="url" value="{{$company->website_url}}"
                               placeholder="URL">
                        <span style="color:red;font-size: 12px;">
                        @error('url')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>

                    <div class="form-group">
                        <label for="file">Upload Logo (100x100)</label>
                        <img height="50px" src="{{asset('storage/'.$company->logo)}}" alt="not found">
                        <input type="file" class="form-control-file" value="" name="logo" id="logo" placeholder="">
                        <span style="color:red;font-size: 12px;">
                        @error('logo')
                            {{$message}}
                            @enderror
                    </span><br>
                    </div>

                </div>
                <button class='btn btn-primary'>Update</button>
            </form>
        </div>
    @endsection
</x-admin-master>
