<!---Left Menu-->

<?php  $roleid=Auth::user()->role_id;?>


<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li <?php echo e((Request::is('dashboard') ? 'class=active' : '')); ?>>
        <a href='/dashboard'>
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
        <?php
        if($roleid=="1")
        {
        ?>
      <li <?php echo e((Request::is('customers-list') ? 'class=active' : '')); ?>  <?php echo e((Request::is('agent-list') ? 'class=active' : '')); ?> <?php echo e((Request::is('user-edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('agent-edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('user-add') ? 'class=active' : '')); ?> <?php echo e((Request::is('agent-add') ? 'class=active' : '')); ?>>
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
      <li <?php echo e((Request::is('categories') ? 'class=active' : '')); ?>  <?php echo e((Request::is('category/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('category/edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('specality-themes-priority') ? 'class=active' : '')); ?>>
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
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('categories') ? 'class=active' : '')); ?> <?php echo e((Request::is('category/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('category/edit/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('specality-themes-priority') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('specality-themes-priority')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Specialty Themes </span>
            </a>
          </li>
        </ul>
      </li>

      <li <?php echo e((Request::is('reported/costumes') ? 'class=active' : '')); ?> <?php echo e((Request::is('costumes/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('customes-list') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
          <i class="fa fa-tasks" aria-hidden="true"></i> <span>Costumes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('reported/costumes') ? 'class=active' : '')); ?> >
            <a href="<?php echo e(route('reported-costumes-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Reported Costumes</span>
            </a>
          </li>
          <li <?php echo e((Request::is('costumes/create') ? 'class=active' : '')); ?> >
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
      <li <?php echo e((Request::is('orders') ? 'class=active' : '')); ?> <?php echo e((Request::is('transactions') ? 'class=active' : '')); ?>  >
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
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Transactions List</span>
            </a>
          </li>
        </ul>
      </li>
      <li <?php echo e((Request::is('manage-bags') ? 'class=active' : '')); ?><?php echo e((Request::is('process-bag/*') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
          <i class="fa fa-suitcase" aria-hidden="true"></i><span>Request a Bag</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('manage-bags') ? 'class=active' : '')); ?><?php echo e((Request::is('process-bag/*') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('manage-bags')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Bags</span>
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

      <li <?php echo e(Request::is('events-list') ? 'class=active' : ''); ?> <?php echo e(Request::is('add-event') ? 'class=active' : ''); ?> <?php echo e(Request::is('admin/editevent/*') ? 'class=active' : ''); ?>>
        <a href="javascript:void(0)">
          <i class="fa fa-calendar-o" aria-hidden="true"></i>
          <span>Events</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('events-list') ? 'class=active' : ''); ?> <?php echo e(Request::is('add-event') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('events-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Events List</span>
            </a>
          </li>
        </ul>

      </li>


      <li <?php echo e(Request::is('press-posts') ? 'class=active' : ''); ?> <?php echo e(Request::is('add-press-post') ? 'class=active' : ''); ?> <?php echo e(Request::is('admin/editpress/*') ? 'class=active' : ''); ?>>
        <a href="javascript:void(0)">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>Press</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('press-posts') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('press-posts')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Press Posts</span>
            </a>
          </li>
        </ul>

      </li>



      <li <?php echo e(Request::is('blog-posts') ? 'class=active' : ''); ?> <?php echo e(Request::is('blog-posts') ? 'class=active' : ''); ?> <?php echo e(Request::is('add-blog-post') ? 'class=active' : ''); ?>>
        <a href="javascript:void(0)">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          <span>Blog</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('blog-posts') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('blog-posts')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Blog Posts</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('add-blog-post') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-blog-post')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add Blog Post</span>
            </a>
          </li>
        </ul>

      </li>

      <li <?php echo e(Request::is('cms-pages') ? 'class=active' : ''); ?>

      <?php echo e(Request::is('edit-page/*') ? 'class=active' : ''); ?>

       <?php echo e(Request::is('add-cms-page') ? 'class=active' : ''); ?>

         <?php echo e(Request::is('cms-blocks') ? 'class=active' : ''); ?>

         <?php echo e(Request::is('add-cms-block') ? 'class=active' : ''); ?>

          <?php echo e(Request::is('edit-block/*') ? 'class=active' : ''); ?>

         >
        <a href="javascript:void(0)">
          <i class="fa fa-desktop" aria-hidden="true"></i>
          <span>CMS</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('add-cms-page') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-cms-page')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add CMS Page</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('cms-pages') ? 'class=active' : ''); ?>

           <?php echo e(Request::is('edit-page/*') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('cms-pages')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>CMS Pages</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('cms-blocks') ? 'class=active' : ''); ?> <?php echo e(Request::is('edit-block/*') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('cms-blocks')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>CMS Blocks</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('add-cms-block') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-cms-block')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add CMS Block</span>
            </a>
          </li>
        </ul>

      </li>
      <li <?php echo e((Request::is('jobs-list') ? 'class=active' : '')); ?> <?php echo e((Request::is('create-job') ? 'class=active' : '')); ?> <?php echo e((Request::is('jobs_list/edit/*') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
          <i class="fa fa-diamond" aria-hidden="true"></i> <span>Jobs</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('jobs-list') ? 'class=active' : '')); ?> <?php echo e((Request::is('create-job') ? 'class=active' : '')); ?> <?php echo e((Request::is('jobs_list/edit/*') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('jobs-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Jobs</span>

            </a>
          </li>
        </ul>


      </li>


      <li <?php echo e(Request::is('manage-faqs') ? 'class=active' : ''); ?> <?php echo e(Request::is('add-faqs') ? 'class=active' : ''); ?>>
        <a href="javascript:void(0)">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          <span>FAQ</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('manage-faqs') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('manage-faqs')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Manage FAQs</span>
            </a>
          </li>
        </ul>

        <ul class="treeview-menu menu">
          <li <?php echo e(Request::is('add-faqs') ? 'class=active' : ''); ?>>
            <a href="<?php echo e(route('add-faqs')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <span>Add FAQ</span>
            </a>
          </li>
        </ul>

      </li>



     <li <?php echo e((Request::is('settings') ? 'class=active' : '')); ?>>
        <a href="<?php echo e(route('settings')); ?>">
          <i class="fa fa-cog" aria-hidden="true"></i><span>Settings</span>
        </a>
      </li>
      <li
              <?php echo e((Request::is('revenue-reports') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('seller-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('paypal-reports') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('event-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('blog-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('product-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('users-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('profile-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('cost-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('request-bag-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('charity-report') ? 'class=active' : '')); ?>

              <?php echo e((Request::is('discounts-report') ? 'class=active' : '')); ?>

      >
        <a href="javascript:void(0)">
          <i class="fa fa-file-excel-o" aria-hidden="true"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('revenue-reports') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('revenue-reports')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Revenue Reports</span>

            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('paypal-reports') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('paypal-reports')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Paypal Payout Reports</span>

            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('seller-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('seller-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Top Seller Report</span>

            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('event-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('event-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Event Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('blog-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('blog-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Blog Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('product-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('product-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Product Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('users-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('users-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Users Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('profile-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('profile-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Profile Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('cost-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('cost-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Cost Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('request-bag-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('request-bag-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Request Bag Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('charity-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('charity-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Charity Report</span>
            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('discounts-report') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('discounts-report')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Discounts Report</span>
            </a>
          </li>
        </ul>
      </li>
        <?php } ?>
        <?php  if(($roleid=="2") || ($roleid=="1")) {  ?>
      <li <?php echo e((Request::is('support-users') ? 'class=active' : '')); ?> <?php echo e((Request::is('tickets-list') ? 'class=active' : '')); ?> <?php echo e((Request::is('manage-tickets/*') ? 'class=active' : '')); ?> <?php echo e((Request::is('promotion/create') ? 'class=active' : '')); ?> <?php echo e((Request::is('promotion/edit/*') ? 'class=active' : '')); ?>>
        <a href="javascript:void(0)">
          <i class="fa fa-diamond" aria-hidden="true"></i> <span>Support</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('support-users') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('support-users')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Support Users</span>

            </a>
          </li>
        </ul>
        <ul class="treeview-menu menu">
          <li <?php echo e((Request::is('tickets-list') ? 'class=active' : '')); ?> <?php echo e((Request::is('manage-tickets/*') ? 'class=active' : '')); ?>>
            <a href="<?php echo e(route('tickets-list')); ?>">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>Support Tickets</span>
        </a>
          </li>
        </ul>

      </li>
        <?php } ?>

    </ul>
  </section>
</aside>