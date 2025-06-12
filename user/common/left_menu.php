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

<header class="main-header">

<!-- Logo -->

<a href="<?php echo SITEPATH;?>user/dashboard.php" class="logo"> <span class="logo-mini"><img src="<?php echo SITEPATH;?>user/images/footer-logo.png" ></span> <span class="logo-lg"> <img src="<?php echo SITEPATH;?>user/images/footer-logo.png" style="width: 151px;"></span> </a>

<!-- Navbar-->

<nav class="navbar navbar-static-top" role="navigation">

  <!-- Sidebar toggle button-->

  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>

  <div class="navbar-custom-menu">

    <ul class="nav navbar-nav">

      <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img  src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $r["user_logo"];?>" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $r["first_name"];?></span> <i class="fa fa-angle-down"></i></a>

        <ul class="dropdown-menu">

          <!-- User image -->

          <li class="user-header"> <img src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $r["user_logo"];?>" class="img-circle" alt="User Image">

            <p><?php echo $r["first_name"];?><small><?php echo $r["user_startfrom"];?></small> </p>

          </li>

          <li class="user-footer">

            <div class="pull-left">

              <a href="<?php echo SITEPATH; ?>/user/user/add-new-user.php?id=<?php echo  urlencode(encryptIt($r['user_id'])); ?>" class="btn btn-default btn-flat">Profile</a>

            </div>

            <div class="pull-right"> <a href="<?php echo SITEPATH;?>user/logout.php" class="btn btn-default btn-flat">Logout</a> </div>

          </li>

        </ul>

      </li>

    </ul>

  </div>

  <?php

	  

	

	  ?>

  <?php if($r['user_id']=="1")

	  {?>

  <!--<div class="navbar-custom-menu">

    <ul class="nav navbar-nav">

      <li class="dropdown user user-menu"> <a href="<?php  echo SITEPATH;?>/user/shipment_master/index.php?c=count" class="dropdown-toggle"> <i class="fa fa-truck"></i> <span class="hidden-xs" style="    font-size: 17px;"><?php echo $totalcount[0]['COUNT(shipment_master_id)'];?></span> </a> </li>

    </ul>

  </div>-->

  <?php }?>

  <div class="navbar-custom-menu">

    <ul class="nav navbar-nav">

      <li class="dropdown user user-menu"> </li>

    </ul>

  </div>

</nav>

</header>

<!--header close here, starts Left side column  -->

<aside class="main-sidebar">

  <section class="sidebar" style="">

    <!-- sidebar user panel -->

    <div class="user-panel">

      <div class="pull-left image"> <img src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $r["user_logo"];?>" class="img-circle" alt="User Image"> </div>

      <div class="pull-left info">

        <p style="color:#666666"><small>Welcome,</small></p>

        <p><?php echo $r["first_name"];?></p>

      </div>

    </div>

    <?php

      ?>

   

 <ul class="sidebar-menu">

 <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Fourm Management</span> <i class="fa fa-angle-left pull-right"></i> </a>

        <ul class="treeview-menu">

		<?php 

				if($r['user_type']=="1")

    {?>

          <li><a href="<?php echo SITEPATH;?>user/Fourm/add_new_Fourm_page.php"><i class="fa fa-caret-right"></i>Add New</a></li>

		 

		   <?php }?>

          <li><a href="<?php echo SITEPATH;?>user/Fourm/index.php"><i class="fa fa-caret-right"></i> View  All </a></li>

        </ul>

      </li>

    </ul>

  </section>

</aside>

<!--close Left side column, starts page contets  -->

