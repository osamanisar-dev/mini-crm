<x-admin-master>
    @section('content')
        <h3>Dashboard</h3>
        <div class="container">
            <div class="row">

                <div class="col-md-3 clickable-card-1">
                    <div class="card-counter primary">
                        <i class="fa-solid fa-user" style="color: #f6f5f4;"></i>
                        <span class="count-numbers">{{$employees}}</span>
                        <span class="count-name">Employees</span>
                    </div>
                </div>



                <div class="col-md-3 clickable-card-2">
                    <div class="card-counter success">
                        <i class="fa-solid fa-briefcase" style="color: #f6f5f4;"></i>
                        <span class="count-numbers">{{$companies}}</span>
                        <span class="count-name">Companies</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $(".clickable-card-1").click(function() {
                    // Redirect to the desired URL when the card is clicked
                    window.location.href = "{{route('employee.view')}}";
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $(".clickable-card-2").click(function() {
                    // Redirect to the desired URL when the card is clicked
                    window.location.href = "{{route('company.view')}}";
                });
            });
        </script>


    @endsection

</x-admin-master>
