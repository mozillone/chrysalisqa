<!---Left Menu-->
<<<<<<< HEAD

<?php  $roleid=Auth::user()->role_id;?>


=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li {{ (Request::is('dashboard') ? 'class=active' : '') }}>
        <a href='/dashboard'>
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
<<<<<<< HEAD
        <?php
        if($roleid=="1")
        {
        ?>
      <li {{ (Request::is('customers-list') ? 'class=active' : '') }}  {{ (Request::is('agent-list') ? 'class=active' : '') }} {{ (Request::is('user-edit/*') ? 'class=active' : '') }} {{ (Request::is('agent-edit/*') ? 'class=active' : '') }} {{ (Request::is('user-add') ? 'class=active' : '') }} {{ (Request::is('agent-add') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
          <i class="fa fa-users "></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i>
=======

      <li {{ (Request::is('user-lists') ? 'class=active' : '') }}  {{ (Request::is('agent-list') ? 'class=active' : '') }} {{ (Request::is('user-edit/*') ? 'class=active' : '') }} {{ (Request::is('agent-edit/*') ? 'class=active' : '') }} {{ (Request::is('user-add') ? 'class=active' : '') }} {{ (Request::is('agent-add') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
            <i class="fa fa-users "></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('customers-list') ? 'class=active' : '') }}>
            <a href="{{route('customers-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Users List</span>
            </a>
          </li>
        </ul>
      </li>


      <li {{ (Request::is('attributes') ? 'class=active' : '') }}  {{ (Request::is('attributes/create') ? 'class=active' : '') }} {{ (Request::is('attribute/edit/*') ? 'class=active' : '') }} {{ (Request::is('attributes/values') ? 'class=active' : '') }} {{ (Request::is('attribute/value/edit/*') ? 'class=active' : '') }} {{ (Request::is('attributes/value/create') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
<<<<<<< HEAD
          <i class="fa fa-hourglass-start" aria-hidden="true"></i> <span>Attribute Management</span> <i class="fa fa-angle-left pull-right"></i>
=======
             <i class="fa fa-hourglass-start" aria-hidden="true"></i> <span>Attribute Management</span> <i class="fa fa-angle-left pull-right"></i>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
      <li {{ (Request::is('categories') ? 'class=active' : '') }}  {{ (Request::is('category/create') ? 'class=active' : '') }} {{ (Request::is('category/edit/*') ? 'class=active' : '') }} {{ (Request::is('specality-themes-priority') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
          <i class="fa fa-tags" aria-hidden="true"></i> <span>Category Management</span> <i class="fa fa-angle-left pull-right"></i>
=======
      <li {{ (Request::is('categories') ? 'class=active' : '') }}  {{ (Request::is('category/create') ? 'class=active' : '') }} {{ (Request::is('category/edit/*') ? 'class=active' : '') }} >
        <a href="javascript:void(0)">
            <i class="fa fa-tags" aria-hidden="true"></i> <span>Category Management</span> <i class="fa fa-angle-left pull-right"></i>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('categories') ? 'class=active' : '') }} {{ (Request::is('category/create') ? 'class=active' : '') }} {{ (Request::is('category/edit/*') ? 'class=active' : '') }}>
            <a href="{{route('categories-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Categories</span>
            </a>
          </li>
        </ul>
<<<<<<< HEAD
        <ul class="treeview-menu menu">
          <li {{ (Request::is('categories') ? 'class=active' : '') }} {{ (Request::is('category/create') ? 'class=active' : '') }} {{ (Request::is('category/edit/*') ? 'class=active' : '') }} {{ (Request::is('specality-themes-priority') ? 'class=active' : '') }}>
            <a href="{{route('specality-themes-priority')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Specialty Themes </span>
            </a>
          </li>
        </ul>
      </li>

      <li {{ (Request::is('reported/costumes') ? 'class=active' : '') }} {{ (Request::is('costumes/create') ? 'class=active' : '') }} {{ (Request::is('customes-list') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
          <i class="fa fa-tasks" aria-hidden="true"></i> <span>Costumes</span> <i class="fa fa-angle-left pull-right"></i>
=======
      </li>

       <li {{ (Request::is('reported/costumes') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
            <i class="fa fa-tasks" aria-hidden="true"></i> <span>Costumes</span> <i class="fa fa-angle-left pull-right"></i>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('reported/costumes') ? 'class=active' : '') }} >
            <a href="{{route('reported-costumes-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Reported Costumes</span>
            </a>
          </li>
<<<<<<< HEAD
          <li {{ (Request::is('costumes/create') ? 'class=active' : '') }} >
=======
		   <li {{ (Request::is('reported/costumes') ? 'class=active' : '') }} >
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="/costumes/create">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Create Costume</span>
            </a>
          </li>
<<<<<<< HEAD
          <li {{ (Request::is('customes-list') ? 'class=active' : '') }}>
=======
		 <li {{ (Request::is('customes-list') ? 'class=active' : '') }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{route('customes-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Costumes List</span>
            </a>
          </li>
        </ul>
      </li>
<<<<<<< HEAD
      <li {{ (Request::is('orders') ? 'class=active' : '') }} {{ (Request::is('transactions') ? 'class=active' : '')  }}  >
        <a href="javascript:void(0)">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span> <i class="fa fa-angle-left pull-right"></i>
=======
      <li {{ (Request::is('orders') ? 'class=active' : '') || (Request::is('transactions') ? 'class=active' : '')  }}  >
        <a href="javascript:void(0)">
           <i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span> <i class="fa fa-angle-left pull-right"></i>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('orders') ? 'class=active' : '') }} >
            <a href="{{route('orders-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Orders List</span>
            </a>
          </li>
<<<<<<< HEAD
          <li {{ (Request::is('transactions') ? 'class=active' : '') }} >
            <a href="{{route('transactions-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Transactions List</span>
            </a>
          </li>
        </ul>
      </li>
      <li {{ (Request::is('manage-bags') ? 'class=active' : '') }}{{ (Request::is('process-bag/*') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
          <i class="fa fa-suitcase" aria-hidden="true"></i><span>Request a Bag</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('manage-bags') ? 'class=active' : '') }}{{ (Request::is('process-bag/*') ? 'class=active' : '') }}>
            <a href="{{route('manage-bags')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Bags</span>
            </a>
          </li>
        </ul>

=======
           <li {{ (Request::is('transactions') ? 'class=active' : '') }} >
           <a href="{{route('transactions-list')}}">
              <i class="fa fa-money" aria-hidden="true"></i> <span>Transactions List</span>
            </a>
          </li>
        </ul>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
      </li>

      <li {{ (Request::is('promotions') ? 'class=active' : '') }} {{ (Request::is('promotion/create') ? 'class=active' : '') }} {{ (Request::is('promotion/edit/*') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
<<<<<<< HEAD
          <i class="fa fa-diamond" aria-hidden="true"></i> <span>Promotions</span> <i class="fa fa-angle-left pull-right"></i>
=======
            <i class="fa fa-diamond" aria-hidden="true"></i> <span>Promotions</span> <i class="fa fa-angle-left pull-right"></i>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('promotions') ? 'class=active' : '') }}>
            <a href="{{route('promotions-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Promotion List</span>

            </a>
          </li>
        </ul>
      </li>

<<<<<<< HEAD


      <li {{ (Request::is('charities') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
          <i class="fa fa-home" aria-hidden="true"></i> <span>Charities</span> <i class="fa fa-angle-left pull-right"></i>
=======
      <li {{ (Request::is('charities') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
           <i class="fa fa-home" aria-hidden="true"></i> <span>Charities</span> <i class="fa fa-angle-left pull-right"></i>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('charities') ? 'class=active' : '') }}>
            <a href="{{route('charities-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Charities</span>
            </a>
          </li>
        </ul>
      </li>
<<<<<<< HEAD

      <li {{ Request::is('events-list') ? 'class=active' : '' }} {{ Request::is('add-event') ? 'class=active' : '' }} {{ Request::is('admin/editevent/*') ? 'class=active' : '' }}>
        <a href="javascript:void(0)">
          <i class="fa fa-calendar-o" aria-hidden="true"></i>
          <span>Events</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('events-list') ? 'class=active' : '' }} {{ Request::is('add-event') ? 'class=active' : '' }}>
=======
      <li {{ Request::is('events') ? 'class=active' : '' }}>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Events</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('events') ? 'class=active' : '' }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{route('events-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Events List</span>
            </a>
          </li>
        </ul>

<<<<<<< HEAD
      </li>


      <li {{ Request::is('press-posts') ? 'class=active' : '' }} {{ Request::is('add-press-post') ? 'class=active' : '' }} {{ Request::is('admin/editpress/*') ? 'class=active' : '' }}>
        <a href="javascript:void(0)">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>Press</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('press-posts') ? 'class=active' : '' }}>
=======
        <ul class="treeview-menu menu">
          <li {{ Request::is('events') ? 'class=active' : '' }}>
            <a href="{{route('add-event')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Event</span>
            </a>
          </li>
        </ul>

      </li>

      <li {{ Request::is('press') ? 'class=active' : '' }}>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Press</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('press') ? 'class=active' : '' }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{ route('press-posts')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Press Posts</span>
            </a>
          </li>
        </ul>

<<<<<<< HEAD
      </li>



      <li {{ Request::is('blog-posts') ? 'class=active' : '' }} {{ Request::is('blog-posts') ? 'class=active' : '' }} {{ Request::is('add-blog-post') ? 'class=active' : '' }}>
        <a href="javascript:void(0)">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          <span>Blog</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('blog-posts') ? 'class=active' : '' }}>
=======
        <ul class="treeview-menu menu">
          <li {{ Request::is('press') ? 'class=active' : '' }}>
            <a href="{{ route('add-press-post')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Press Posts</span>
            </a>
          </li>
        </ul>

      </li>

      <li {{ Request::is('support') ? 'class=active' : '' }}>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Support</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('support') ? 'class=active' : '' }}>
            <a href="{{ route('support-tickets')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Support Tickets</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li {{ Request::is('support') ? 'class=active' : '' }}>
            <a href="{{ route('manage-ticket')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Manage Tickets</span>
            </a>
          </li>
        </ul>

      </li>

      <li {{ Request::is('blog') ? 'class=active' : '' }}>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Blog</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('blog') ? 'class=active' : '' }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{ route('blog-posts')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Blog Posts</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
<<<<<<< HEAD
          <li {{ Request::is('add-blog-post') ? 'class=active' : '' }}>
=======
          <li {{ Request::is('blog') ? 'class=active' : '' }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{ route('add-blog-post')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Blog Post</span>
            </a>
          </li>
        </ul>

<<<<<<< HEAD
      </li>

      <li {{ Request::is('cms-pages') ? 'class=active' : '' }}
      {{ Request::is('edit-page/*') ? 'class=active' : '' }}
       {{ Request::is('add-cms-page') ? 'class=active' : '' }}
         {{ Request::is('cms-blocks') ? 'class=active' : '' }}
         {{ Request::is('add-cms-block') ? 'class=active' : '' }}
          {{ Request::is('edit-block/*') ? 'class=active' : '' }}
         >
        <a href="javascript:void(0)">
          <i class="fa fa-desktop" aria-hidden="true"></i>
          <span>CMS</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('add-cms-page') ? 'class=active' : '' }}>
=======
      </li> -->

      <li {{ Request::is('cms') ? 'class=active' : '' }}>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>CMS</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('cms') ? 'class=active' : '' }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{ route('add-cms-page')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add CMS Page</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
<<<<<<< HEAD
          <li {{ Request::is('cms-pages') ? 'class=active' : '' }}
           {{ Request::is('edit-page/*') ? 'class=active' : '' }}>
=======
          <li {{ Request::is('cms') ? 'class=active' : '' }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{ route('cms-pages')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>CMS Pages</span>
            </a>
          </li>
        </ul>

<<<<<<< HEAD
        <ul class="treeview-menu menu">
          <li {{ Request::is('cms-blocks') ? 'class=active' : '' }} {{ Request::is('edit-block/*') ? 'class=active' : '' }}>
=======
         <ul class="treeview-menu menu">
          <li {{ Request::is('cms') ? 'class=active' : '' }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{ route('cms-blocks')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>CMS Blocks</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
<<<<<<< HEAD
          <li {{ Request::is('add-cms-block') ? 'class=active' : '' }}>
=======
          <li {{ Request::is('cms') ? 'class=active' : '' }}>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            <a href="{{ route('add-cms-block')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add CMS Block</span>
            </a>
          </li>
        </ul>

      </li>
<<<<<<< HEAD
      <li {{ (Request::is('jobs-list') ? 'class=active' : '') }} {{ (Request::is('create-job') ? 'class=active' : '') }} {{ (Request::is('jobs_list/edit/*') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
          <i class="fa fa-diamond" aria-hidden="true"></i> <span>Jobs</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('jobs-list') ? 'class=active' : '') }} {{ (Request::is('create-job') ? 'class=active' : '') }} {{ (Request::is('jobs_list/edit/*') ? 'class=active' : '') }}>
            <a href="{{route('jobs-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Jobs</span>

            </a>
          </li>
        </ul>


      </li>


      <li {{ Request::is('manage-faqs') ? 'class=active' : '' }} {{ Request::is('add-faqs') ? 'class=active' : '' }}>
        <a href="javascript:void(0)">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          <span>FAQ</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('manage-faqs') ? 'class=active' : '' }}>
            <a href="{{ route('manage-faqs')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Manage FAQs</span>
=======

      <!-- <li {{ Request::is('jobs') ? 'class=active' : '' }}>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Jobs</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li {{ Request::is('jobs') ? 'class=active' : '' }}>
            <a href="{{ route('manage-jobs')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Manage Jobs</span>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
<<<<<<< HEAD
          <li {{ Request::is('add-faqs') ? 'class=active' : '' }}>
            <a href="{{ route('add-faqs')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add FAQ</span>
=======
          <li {{ Request::is('jobs') ? 'class=active' : '' }}>
            <a href="{{ route('add-job-post')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Job Post</span>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            </a>
          </li>
        </ul>

      </li>
<<<<<<< HEAD



     <li {{ (Request::is('settings') ? 'class=active' : '') }}>
        <a href="{{route('settings')}}">
          <i class="fa fa-cog" aria-hidden="true"></i><span>Settings</span>
        </a>
      </li>
      <li
              {{ (Request::is('revenue-reports') ? 'class=active' : '') }}
              {{ (Request::is('seller-report') ? 'class=active' : '') }}
              {{ (Request::is('paypal-reports') ? 'class=active' : '') }}
              {{ (Request::is('event-report') ? 'class=active' : '') }}
              {{ (Request::is('blog-report') ? 'class=active' : '') }}
              {{ (Request::is('product-report') ? 'class=active' : '') }}
              {{ (Request::is('users-report') ? 'class=active' : '') }}
              {{ (Request::is('profile-report') ? 'class=active' : '') }}
              {{ (Request::is('cost-report') ? 'class=active' : '') }}
              {{ (Request::is('request-bag-report') ? 'class=active' : '') }}
              {{ (Request::is('charity-report') ? 'class=active' : '') }}
              {{ (Request::is('discounts-report') ? 'class=active' : '') }}
      >
        <a href="javascript:void(0)">
          <i class="fa fa-file-excel-o" aria-hidden="true"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('revenue-reports') ? 'class=active' : '') }}>
            <a href="{{route('revenue-reports')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Revenue Reports</span>

            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('paypal-reports') ? 'class=active' : '') }}>
            <a href="{{route('paypal-reports')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Paypal Payout Reports</span>

            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('seller-report') ? 'class=active' : '') }}>
            <a href="{{route('seller-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Top Seller Report</span>

            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('event-report') ? 'class=active' : '') }}>
            <a href="{{route('event-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Event Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('blog-report') ? 'class=active' : '') }}>
            <a href="{{route('blog-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Blog Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('product-report') ? 'class=active' : '') }}>
            <a href="{{route('product-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Product Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('users-report') ? 'class=active' : '') }}>
            <a href="{{route('users-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Users Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('profile-report') ? 'class=active' : '') }}>
            <a href="{{route('profile-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Profile Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('cost-report') ? 'class=active' : '') }}>
            <a href="{{route('cost-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Cost Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('request-bag-report') ? 'class=active' : '') }}>
            <a href="{{route('request-bag-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Request Bag Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('charity-report') ? 'class=active' : '') }}>
            <a href="{{route('charity-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Charity Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('discounts-report') ? 'class=active' : '') }}>
            <a href="{{route('discounts-report')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Discounts Report</span>
            </a>
          </li>
        </ul>
      </li>
        <?php } ?>
        <?php  if(($roleid=="2") || ($roleid=="1")) {  ?>
      <li {{ (Request::is('support-users') ? 'class=active' : '') }} {{ (Request::is('tickets-list') ? 'class=active' : '') }} {{ (Request::is('manage-tickets/*') ? 'class=active' : '') }} {{ (Request::is('promotion/create') ? 'class=active' : '') }} {{ (Request::is('promotion/edit/*') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
          <i class="fa fa-diamond" aria-hidden="true"></i> <span>Support</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('support-users') ? 'class=active' : '') }}>
            <a href="{{route('support-users')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Support Users</span>

            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('tickets-list') ? 'class=active' : '') }} {{ (Request::is('manage-tickets/*') ? 'class=active' : '') }}>
            <a href="{{route('tickets-list')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Support Tickets</span>
        </a>
          </li>
        </ul>

      </li>
        <?php } ?>

    </ul>
  </section>
</aside>
=======
      <li {{ (Request::is('requestabag') ? 'class=active' : '') }}>
        <a href="javascript:void(0)">
           <i class="fa fa-home" aria-hidden="true"></i> <span>Request a Bag</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li {{ (Request::is('requestabag') ? 'class=active' : '') }}>
            <a href="{{route('manage-bags')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Bags</span>
            </a>
          </li>
        </ul>
        <!--  -->
      </li>
    </ul>
  </section>
</aside>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
