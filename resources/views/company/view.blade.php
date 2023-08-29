<x-admin-master>
    @section('content')
        <h1>View Companies</h1>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Company Details</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Website Url</th>
                            <th>Logo</th>
                            <th>Update</th>
                            <th>Delete</th>


                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Website Url</th>
                            <th>Logo</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($companies as $company)

                            <tr>
                                <td>{{$company->id}}</td>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td>{{$company->website_url}}</td>
                                <td>
                                    <img height="50px" src="{{asset('storage/'.$company->logo)}}" alt="not found">
                                </td>
                                <td>
                                    <a href="{{route('company.edit',$company)}}">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </a>
                                </td>

                                <td>
                                    <!-- Button trigger modal -->
                                    <button value="{{$company->id}}" type="button" class="btn btn-danger delete-btn"
                                            data-toggle="modal" data-target="#exampleModal">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to want to delete Company ?
                                                </div>
                                                <form method="POST" action="{{route('company.destroy')}}">
                                                    @csrf
                                                    <div class="modal-footer">
                                                        <input style="display: none" id="deleting_id"
                                                               name="delete_company_id">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            {{$companies->links()}}
        </div>

    @endsection


    @push('scripts')
        <script>
            $(document).ready(function () {
                $(document).on('click', '.delete-btn', function () {
                    var com_id = $(this).val();
                    // alert(com_id);
                    $("#deleting_id").val(com_id);
                })
            });
        </script>
    @endpush
</x-admin-master>
