<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="{{asset('admin/img/logo/logo2.png')}}">
      </div>
      <div class="sidebar-brand-text mx-3">E-Commerence</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Features
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
        aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Category</span>
      </a>
      <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Category</h6>
          <a class="collapse-item" href="/auth/category/index">View</a>
          <a class="collapse-item" href="/auth/category/create">Add New</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1"
        aria-expanded="true" aria-controls="collapseBootstrap1">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Sub Category</span>
      </a>
      <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Category</h6>
          <a class="collapse-item" href="/auth/subcategory/index">View</a>
          <a class="collapse-item" href="/auth/subcategory/create">Add New</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
        aria-expanded="true" aria-controls="collapseBootstrap2">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Products</span>
      </a>
      <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Category</h6>
          <a class="collapse-item" href="/auth/product/index">View</a>
          <a class="collapse-item" href="/auth/product/create">Add New</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3"
        aria-expanded="true" aria-controls="collapseBootstrap2">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Slider</span>
      </a>
      <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Slider</h6>
          <a class="collapse-item" href="/auth/slider/index">View</a>
          <a class="collapse-item" href="/auth/slider/create">Add New</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap4"
        aria-expanded="true" aria-controls="collapseBootstrap2">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Users</span>
      </a>
      <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Users</h6>
          <a class="collapse-item" href="/auth/users">View</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap5"
        aria-expanded="true" aria-controls="collapseBootstrap2">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Orders</span>
      </a>
      <div id="collapseBootstrap5" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Orders</h6>
          <a class="collapse-item" href="/auth/orders">View</a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        </form>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
  </ul>