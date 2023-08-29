
<x-employee-master>
    @section('content')
        @if(Session::has('profile-update'))
            <div class="alert alert-success">{{Session::get('profile-update')}}</div>
        @endif
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('employeedashboard/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Attached Companies <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2>{{Auth::user()->companies->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-employee-master>
