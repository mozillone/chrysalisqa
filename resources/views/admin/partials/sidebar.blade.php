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
            <a href="{{route('customers-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Customers List</span>
            </a>
          </li>
        </ul>
      </li>


      <li {{ (Request::is('attributes') ? 'class=active' : '') }}  {{ (Request::is('attributes/create') ? 'class=active' : '') }} {{ (Request::is('attribute/edit/*') ? 'class=active' : '') }} {{ (Request::is('attributes/values') ? 'class=active' : '') }} {{ (Request::is('attribute/value/edit/*') ? 'class=active' : '') }} {{ (Request::is('attributes/value/create') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
             <i class="fa fa-hourglass-start" aria-hidden="true"></i> <span>Attribute Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('attributes') ? 'class=active' : '') }} {{ (Request::is('attributes/create') ? 'class=active' : '') }} {{ (Request::is('attribute/edit/*') ? 'class=active' : '') }}>
            <a href="{{route('attributes-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Attributes</span>
            </a>
          </li>
          <li  {{ (Request::is('attributes/values') ? 'class=active' : '') }}  {{ (Request::is('attribute/value/edit/*') ? 'class=active' : '') }} {{ (Request::is('attributes/value/create') ? 'class=active' : '') }}>
            <a href="{{route('attributes-values-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Attribute Values</span>
            </a>
          </li>
        </ul>
      </li>
      <li {{ (Request::is('categories') ? 'class=active' : '') }}  {{ (Request::is('category/create') ? 'class=active' : '') }} {{ (Request::is('category/edit/*') ? 'class=active' : '') }} >
        <a href="javascript:void(0)">
             <i class="fa fa-hourglass-start" aria-hidden="true"></i> <span>category Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('categories') ? 'class=active' : '') }} {{ (Request::is('category/create') ? 'class=active' : '') }} {{ (Request::is('category/edit/*') ? 'class=active' : '') }}>
            <a href="{{route('categories-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> categories</span>
            </a>
          </li>
        </ul>
      </li>
	 
    </ul>
  </section> 
</aside>