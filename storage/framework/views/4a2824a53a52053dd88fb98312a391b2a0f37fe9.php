<!---Left Menu-->
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li <?php echo e((Request::is('dashboard') ? 'class=active' : '')); ?>>
        <a href='/dashboard'>
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li <?php echo e((Request::is('user-lists') ? 'class=active' : '')); ?>  <?php echo e((Request::is('agent-list') ? 'class=active' : '')); ?> <?php echo e((Request::is('user-edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('agent-edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('user-add') ? 'class=active' : '')); ?> <?php echo e((Request::is('agent-add') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
            <i class="fa fa-users "></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('customers-list') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('customers-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Users List</span>
            </a>
          </li>
        </ul>
      </li>


      <li <?php echo e((Request::is('attributes') ? 'class=active' : '')); ?>  <?php echo e((Request::is('attributes/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('attribute/edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('attributes/values') ? 'class=active' : '')); ?> <?php echo e((Request::is('attribute/value/edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('attributes/value/create') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
             <i class="fa fa-hourglass-start" aria-hidden="true"></i> <span>Attribute Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('attributes') ? 'class=active' : '')); ?> <?php echo e((Request::is('attributes/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('attribute/edit/*') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('attributes-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Attributes</span>
            </a>
          </li>
          <li  <?php echo e((Request::is('attributes/values') ? 'class=active' : '')); ?>  <?php echo e((Request::is('attribute/value/edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('attributes/value/create') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('attributes-values-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Attribute Values</span>
            </a>
          </li>
        </ul>
      </li>
      <li <?php echo e((Request::is('categories') ? 'class=active' : '')); ?>  <?php echo e((Request::is('category/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('category/edit/*') ? 'class=active' : '')); ?> >
        <a href="javascript:void(0)">
            <i class="fa fa-tags" aria-hidden="true"></i> <span>Category Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('categories') ? 'class=active' : '')); ?> <?php echo e((Request::is('category/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('category/edit/*') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('categories-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Categories</span>
            </a>
          </li>
        </ul>
      </li>

       <li <?php echo e((Request::is('reported/costumes') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
            <i class="fa fa-tasks" aria-hidden="true"></i> <span>Costumes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('reported/costumes') ? 'class=active' : '')); ?> >
            <a href="<?php echo e(route('reported-costumes-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Reported Costumes</span>
            </a>
          </li>
		   <li <?php echo e((Request::is('reported/costumes') ? 'class=active' : '')); ?> >
            <a href="/costumes/create">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Create Costume</span>
            </a>
          </li>
		 <li <?php echo e((Request::is('customes-list') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('customes-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Costumes List</span>
            </a>
          </li>
        </ul>
      </li>
      <li <?php echo e((Request::is('orders') ? 'class=active' : '') || (Request::is('transactions') ? 'class=active' : '')); ?>  >
        <a href="javascript:void(0)">
           <i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('orders') ? 'class=active' : '')); ?> >
            <a href="<?php echo e(route('orders-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Orders List</span>
            </a>
          </li>
           <li <?php echo e((Request::is('transactions') ? 'class=active' : '')); ?> >
           <a href="<?php echo e(route('transactions-list')); ?>">
              <i class="fa fa-money" aria-hidden="true"></i> <span>Transactions List</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?php echo e((Request::is('promotions') ? 'class=active' : '')); ?> <?php echo e((Request::is('promotion/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('promotion/edit/*') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
            <i class="fa fa-diamond" aria-hidden="true"></i> <span>Promotions</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('promotions') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('promotions-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Promotion List</span>

            </a>
          </li>
        </ul>
      </li>

      <li <?php echo e((Request::is('charities') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
           <i class="fa fa-home" aria-hidden="true"></i> <span>Charities</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('charities') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('charities-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Charities</span>
            </a>
          </li>
        </ul>
      </li>
      <li <?php echo e(Request::is('events') ? 'class=active' : ''); ?>>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Events</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('events') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('events-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Events List</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('events') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-event')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Event</span>
            </a>
          </li>
        </ul>

      </li>

      <li <?php echo e(Request::is('press') ? 'class=active' : ''); ?>>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Press</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('press') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('press-posts')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Press Posts</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('press') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-press-post')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Press Posts</span>
            </a>
          </li>
        </ul>

      </li>

      <li <?php echo e(Request::is('support') ? 'class=active' : ''); ?>>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Support</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('support') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('support-tickets')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Support Tickets</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('support') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('manage-ticket')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Manage Tickets</span>
            </a>
          </li>
        </ul>

      </li>

      <li <?php echo e(Request::is('blog') ? 'class=active' : ''); ?>>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Blog</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('blog') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('blog-posts')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Blog Posts</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('blog') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-blog-post')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Blog Post</span>
            </a>
          </li>
        </ul>

      </li> -->

      <li <?php echo e(Request::is('cms') ? 'class=active' : ''); ?>>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>CMS</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('cms') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-cms-page')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add CMS Page</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('cms') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('cms-pages')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>CMS Pages</span>
            </a>
          </li>
        </ul>

         <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('cms') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('cms-blocks')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>CMS Blocks</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('cms') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-cms-block')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add CMS Block</span>
            </a>
          </li>
        </ul>

      </li>

      <!-- <li <?php echo e(Request::is('jobs') ? 'class=active' : ''); ?>>
      <a href="javascript:void(0)">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Jobs</span><i class="fa fa-angle-left pull-right"></i>
      </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('jobs') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('manage-jobs')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Manage Jobs</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('jobs') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-job-post')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Job Post</span>
            </a>
          </li>
        </ul>

      </li>
      <li <?php echo e((Request::is('requestabag') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
           <i class="fa fa-home" aria-hidden="true"></i> <span>Request a Bag</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('requestabag') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('manage-bags')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Bags</span>
            </a>
          </li>
        </ul>
        <!--  -->
      </li>
    </ul>
  </section>
</aside>
