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
      User Management
    </div>
    
    <li class="nav-item {{Request::is('app/role*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoleForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fa-sharp fa-solid fa-person"></i>
        <span>Role</span>
      </a>
      <div id="collapseRoleForm" class="collapse {{Request::is('app/role*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/role/index')?'active':''}} href="{{route('app.role.index')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-list"></i><span class="pl-1">List</span></a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/role/create')?'active':''}} href="{{route('app.role.create')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
        </div>
      </div>
    </li>

    <li class="nav-item {{Request::is('app/user*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUserForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fa-solid fa-user"></i>
        <span>User</span>
      </a>
      <div id="collapseUserForm" class="collapse {{Request::is('app/user*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/user/index')?'active':''}} href="{{route('app.user.index')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-list"></i><span class="pl-1">List</span></a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/user/create')?'active':''}} href="{{route('app.user.create')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
        </div>
      </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Product Management
    </div>

    <li class="nav-item {{Request::is('app/category*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategoryForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fa-solid fa-list-ol"></i>
        <span>Category</span>
      </a>
      <div id="collapseCategoryForm" class="collapse {{Request::is('app/category*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/category/index')?'active':''}} href="{{route('app.category.index')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-list"></i><span class="pl-1">List</span></a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/category/create')?'active':''}} href="{{route('app.category.create')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
        </div>
      </div>
    </li>

    <li class="nav-item {{Request::is('app/subcategory*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubCategoryForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fa-solid fa-list-ul"></i>
        <span>Sub Category</span>
      </a>
      <div id="collapseSubCategoryForm" class="collapse {{Request::is('app/subcategory*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/subcategory/index')?'active':''}} href="{{route('app.subcategory.index')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-list"></i><span class="pl-1">List</span></a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/subcategory/create')?'active':''}} href="{{route('app.subcategory.create')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
        </div>
      </div>
    </li>

    <li class="nav-item {{Request::is('app/color*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseColorForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fa-solid fa-palette"></i>
        <span>Color</span>
      </a>
      <div id="collapseColorForm" class="collapse {{Request::is('app/color*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/color/index')?'active':''}} href="{{route('app.color.index')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-list"></i><span class="pl-1">List</span></a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/color/create')?'active':''}} href="{{route('app.color.create')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
        </div>
      </div>
    </li>

    <li class="nav-item {{Request::is('app/size*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSizeForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fa-solid fa-s"></i>
        <span>Size</span>
      </a>
      <div id="collapseSizeForm" class="collapse {{Request::is('app/size*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/size/index')?'active':''}} href="{{route('app.size.index')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-list"></i><span class="pl-1">List</span></a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/size/create')?'active':''}} href="{{route('app.size.create')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
        </div>
      </div>
    </li>


    <li class="nav-item {{Request::is('app/unit*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUnitForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fa-brands fa-unity"></i>
        <span>Unit</span>
      </a>
      <div id="collapseUnitForm" class="collapse {{Request::is('app/unit*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/unit/index')?'active':''}} href="{{route('app.unit.index')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-list"></i><span class="pl-1">List</span></a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/unit/create')?'active':''}} href="{{route('app.unit.create')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
        </div>
      </div>
    </li>


    <li class="nav-item {{Request::is('app/product*')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fa-brands fa-product-hunt"></i>
        <span>Product</span>
      </a>
      <div id="collapseProductForm" class="collapse {{Request::is('app/product*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded " style="margin-bottom: 3px; margin-top:4px;">
          <a class="collapse-item" {{Request::is('app/product/index')?'active':''}} href="{{route('app.product.index')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-list"></i><span class="pl-1">List</span></a>
        </div>
        
        <div class="bg-white py-2 collapse-inner rounded custom_style"  style="margin-bottom: 3px;">
          <a class="collapse-item" {{Request::is('app/product/create')?'active':''}} href="{{route('app.product.create')}}" style="padding-top: 2px; padding-bottom:2px;"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
        </div>
      </div>
    </li>
  </ul>
  <!-- Sidebar -->