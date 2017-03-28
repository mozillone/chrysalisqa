<!---Left Menu-->
<aside class="main-sidebar"> 
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li {{ (Request::is('dashboard') ? 'class=active' : '') }}>
        <a href='/dashboard'>
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
       
      <li {{ (Request::is('user-lists') ? 'class=active' : '') }}  {{ (Request::is('agent-list') ? 'class=active' : '') }} {{ (Request::is('user-edit/*') ? 'class=active' : '') }} {{ (Request::is('agent-edit/*') ? 'class=active' : '') }} {{ (Request::is('user-add') ? 'class=active' : '') }} {{ (Request::is('agent-add') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
            <i class="fa fa-users "></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('customers-list') ? 'class=active' : '') }}>
            <a href='{{route('customers-list')}}'>
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Customers List</span>
            </a>
          </li>
        </ul>
      </li>
      <li {{ (Request::is('user-lists') ? 'class=active' : '') }}  {{ (Request::is('agent-list') ? 'class=active' : '') }} {{ (Request::is('user-edit/*') ? 'class=active' : '') }} {{ (Request::is('agent-edit/*') ? 'class=active' : '') }} {{ (Request::is('user-add') ? 'class=active' : '') }} {{ (Request::is('agent-add') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
            <i class="fa fa-ticket"></i> <span>Listing Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('customers-list') ? 'class=active' : '') }}>
            <a href='{{route('listing')}}'>
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Listings</span>
            </a>
          </li>
        </ul>
      </li>
      <li {{ (Request::is('plans') ? 'class=active' : '') }}  {{ (Request::is('plan/*') ? 'class=active' : '') }} {{ (Request::is('admin/subscribers') ? 'class=active' : '') }}  {{ (Request::is('transactions/*') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
            <i class="fa fa-users"></i> <span>Manage Subscriptions</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('plans') ? 'class=active' : '') }}  {{ (Request::is('plan/*') ? 'class=active' : '') }} >
            <a href='{{route('plans')}}'>
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Plans</span>
            </a>
          </li>
          <li {{ (Request::is('admin/subscribers') ? 'class=active' : '') }}  {{ (Request::is('transactions/*') ? 'class=active' : '') }}>
            <a href='{{route('admin-subscribers')}}'>
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Subscribers</span>
            </a>
          </li>
        </ul>
      </li>
      <li {{ (Request::is('amenities') ? 'class=active' : '') }} {{ (Request::is('styles') ? 'class=active' : '') }}>
          <a href="javascript:void(0)">
            <i class="fa fa-cog"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu menu" style="display: none;">
            <li {{ (Request::is('amenities') ? 'class=active' : '') }}>
            <a href='/amenities'>
              <i class="fa fa-dashboard"></i> <span>Amenities</span>
            </a>
            </li>
           <li {{ (Request::is('styles') ? 'class=active' : '') }}>
             <a href='/styles'>
              <i class="fa fa-filter"></i> <span>Styles</span>
            </a>
          </li>
        </ul>
      </li>
    
    </ul>
  </section> 
</aside>