<header class="main-header">
  <style>
    .skin-blue .main-header .navbar .sidebar-toggle1 {
      color: #fff;
    }

    .main-header .sidebar-toggle1 {
      float: left;
      background-color: transparent;
      background-image: none;
      padding: 17px 15px;
      font-family: fontAwesome;
    }
  </style>
  <!-- Logo -->

  <a href="<?php echo SITEPATH; ?>admin/dashboard.php" class="logo">
    <span class="logo-mini"><img src="<?php echo SITEPATH; ?>uploads/logo.png"></span>
    <span class="logo-lg"> <img src="<?php echo SITEPATH; ?>uploads/logo.png" style="width: 80px;"></span>
  </a>

  <!-- Navbar-->

  <nav class="navbar navbar-static-top" role="navigation">

    <!-- Sidebar toggle button-->

    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo SITEPATH; ?>upload/thumb/<?php echo $r["user_logo"]; ?>" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $r["first_name"]; ?></span> <i class="fa fa-angle-down"></i></a>
          <ul class="dropdown-menu">

            <!-- User image -->

            <li class="user-header">
              <img src="<?php echo SITEPATH; ?>upload/thumb/<?php echo $r["user_logo"]; ?>" class="img-circle" alt="User Image">
              <p><?php echo $r["first_name"]; ?><small><?php echo date('d-m-Y h:i A', strtotime($r["user_startfrom"])); ?></small> </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo SITEPATH; ?>admin/Customer/add-new-customer.php?id=<?php echo  urlencode(encryptIt($r['user_id'])); ?>" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right"> <a href="<?php echo SITEPATH; ?>admin/logout.php" class="btn btn-default btn-flat">Logout</a> </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu"> </li>
      </ul>
    </div>
  </nav>
</header>

<!--header close here, starts Left side column  -->

<aside class="main-sidebar">
  <section class="sidebar">

    <!-- sidebar user panel -->

    <div class="user-panel">
      <div class="pull-left image"> <img src="<?php echo SITEPATH; ?>upload/thumb/<?php echo $r["user_logo"]; ?>" class="img-circle" alt="User Image"> </div>
      <div class="pull-left info">
        <p style="color:#666666"><small>Welcome,</small></p>
        <p><?php echo $r["first_name"]; ?></p>
      </div>
    </div>
    <?php

    ?>
    <ul class="sidebar-menu">

      <!-- <li class="treeview">
        <a> <i class="fa fa-user nav_icon"></i>
          <span> Users Management</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/user/add-new-user.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/user/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li> -->

      <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Customer Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/Customer/add-new-customer.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/Customer/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>

      <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Banner Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/banner/add_new_Banner_page.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/banner/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a>
          <i class="fa fa-cogs nav_icon"></i>
          <span> Services Management</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/services/add-new-service.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/services/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a>
          <i class="fa fa-map-marker nav_icon"></i>
          <span> Destination Management</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/destination/add-new-destination.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/destination/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a>
          <i class="fa fa-suitcase nav_icon"></i>
          <span> Package Management</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/newpackage/add-new-package.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/newpackage/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>



      <li class="treeview"> <a><i class="fa fa-indent nav_icon"></i> <span> Contact Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/contactus/add_new_contact_page.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/contactus/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>

      <!-- <li class="treeview"> <a><i class="fa fa-rss-square"></i><span> Musician Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/user/add-new-user.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/user/"><i class="fa fa-caret-right"></i>View All</a></li>
        </ul>
      </li> -->


      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Category Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/Category/add_new_Category_page.php"><i class="fa fa-caret-right"></i> Add New Category</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/Category/index.php"><i class="fa fa-caret-right"></i> View All Category</a></li>
        </ul>
      </li>


      <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Blog Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/Blog/add_new_Blog_page.php"><i class="fa fa-caret-right"></i> Add New </a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/Blog/index.php"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->


      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Add Package</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/package/add_package.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/package/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Register Package </span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/register/add_package.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/register/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span>Booking Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/booking/add_booking.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/booking/"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span>Subscribe Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/subscribe/add_subscribe.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/subscribe/"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span>Report Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/report/add_report.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/report/"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span>Enquiry Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/enquiry/add_enquiry.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/enquiry/"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span>Testimonials Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/testimonials/add_testi.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/testimonials/"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span>Career Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/career/add_career.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/career/"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span>Lead Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>

          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/lead/"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->

      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span>Wallet Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
            <li><a href="<?php echo SITEPATH; ?>admin/wallet/addWallet.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/wallet/"><i class="fa fa-caret-right"></i> View All </a></li>
        </ul>
      </li> -->

      <?php  ?>
    </ul>
  </section>
</aside>

<!--close Left side column, starts page contets  -->