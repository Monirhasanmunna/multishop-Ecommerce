<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="{{asset('backend/img/logo/logo2.png')}}">
      </div>
      <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{route('app.dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Features
    </div>
    
    <li class="nav-item {{Request::is('app/role*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Role</span>
      </a>
      <div id="collapseForm" class="collapse {{Request::is('app/role*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/role/index')?'active':''}} href="{{route('app.role.index')}}" style="padding-top: 2px; padding-bottom:2px;">List</a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/role/create')?'active':''}} href="{{route('app.role.create')}}" style="padding-top: 2px; padding-bottom:2px;">Add New</a>
        </div>
      </div>
    </li>
  </ul>
  <!-- Sidebar -->