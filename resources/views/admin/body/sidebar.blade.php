@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp



<aside class="main-sidebar">
  <section class="sidebar">	
      
      <div class="user-profile">
          <div class="ulogo">
              <a href="index-2.html">
                <!-- logo for regular state and mobile devices -->
                  <div class="d-flex align-items-center justify-content-center">					 	
                        <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
                        <h3><b>Kejani</b> </h3>
                  </div>
              </a>
          </div>
      </div>
    
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">  
        
      <li class= "{{ ($route == 'dashboard')?'active':'' }}">
        <a href="{{ route('dashboard') }}">
          <i data-feather="pie-chart"></i>
          <span>Dashboard</span>
        </a>
      </li>  
      
    
        <li class="treeview {{ ($prefix == '/users')?'active':'' }} " >
          <a href="#">
            <i data-feather="user"></i>
            <span>Manage User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('user.view')}}"><i class="ti-more"></i>View User</a></li>
            <li><a href="{{route('users.add')}}"><i class="ti-more"></i>Add User</a></li>
          </ul>
        </li>
        
        <li class="treeview {{ ($prefix == '/profile')?'active':'' }} ">
          <a href="#">
            <i data-feather="user-check"></i> <span>Manage Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('profile.view')}}"><i class="ti-more"></i>Your Profile</a></li>
            <li><a href=""><i class="ti-more"></i>Change Password</a></li>
            
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/setup')?'active':'' }} ">
          <a href="#">
            <i data-feather="settings"></i> <span>Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('details.view')}}"><i class="ti-more"></i>Company Info</a></li>
            <li><a href="{{route('unit.cat.view')}}"><i class="ti-more"></i>Unit Categories</a></li>
            <li><a href="{{route('unit.view')}}"><i class="ti-more"></i>Units</a></li>
            <li><a href="{{route('branch.view')}}"><i class="ti-more"></i>Apartments</a></li>
            <li><a href="{{route('fee.cat.view')}}"><i class="ti-more"></i>Fee Category</a></li>
            <li><a href="{{route('fee.amount.view')}}"><i class="ti-more"></i>Fee Amount</a></li>
          
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/student')?'active':'' }} ">
          <a href="#">
            <i data-feather="users"></i> <span>Member Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('tenant.view')}}"><i class="ti-more"></i>Tenants</a></li>
              
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/accounts')?'active':'' }} ">
          <a href="#">
            <i data-feather="credit-card"></i> <span>Accounts Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="{{route('ledger.view')}}"><i class="ti-more"></i>Chart of Accounts</a></li>
            <li class=""><a href="{{route('tenant.fee.view')}}"><i class="ti-more"></i>Projections</a></li>
            <li class=""><a href="{{route('rent.view')}}"><i class="ti-more"></i>Expected Rent</a></li>
              
          </ul>
        </li>
      
      
        
      

      

      
      
      
      
      
    </ul>
  </section>
</aside>

<div class="sidebar-footer">
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
    <!-- item-->
    <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
</div>