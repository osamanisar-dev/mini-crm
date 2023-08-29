 <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fa-solid fa-user"></i>
                <span>Employees</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Employees:</h6>
                    <a class="collapse-item" href="{{route('employee.create')}}"><i class="fa-solid fa-plus"></i>  Create Employee</a>
                    <a class="collapse-item" href="{{route('employee.view')}}"><i class="fa-solid fa-eye"></i>  See all Employees</a>
                </div>
            </div>
        </li>
