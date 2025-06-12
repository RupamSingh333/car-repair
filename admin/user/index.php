<?php
include("../../system_config.php");
include_once("../common/head.php");
// pr($r);die;
if ($r['user_type'] == 1) {
  $rows_list = getuser_byList();
} else {
  $rows_list = getuser_byList_byuser($_SESSION['AdminLogin']);
}
?>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">
    <?php include_once("../common/left_menu.php"); ?>
    <div class="content-wrapper">
      <!-- Content Header -->
      <section class="content-header">
        <h1>
          <?php if ($r['user_type'] == "1") { ?>
            <a style="text-decoration: underline;" href="<?php echo SITEPATH; ?>admin/user/add-new-user.php">Add New Musician</a>
          <?php } ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">
            <?php if ($per['user']['view'] == 1) { ?>
              View All Musician
            <?php } ?>
          </li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content"> <br />
        <div class="table-responsive" style="overflow-x: auto;">
          <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <td><strong>Sr No.</strong></td>
                <td><strong>Type</strong></td>
                <td><strong>Service Name</strong></td>
                <td><strong>Image</strong></td>
                <td><strong>Video</strong></td>
                <td><strong>Name</strong></td>
                <td><strong>Email</strong></td>
                <td><strong>Password</strong></td>
                <td><strong>Number</strong></td>
                <td><strong>Address</strong></td>
                <td><strong>Gallery</strong></td>
                <td><strong>Total Rating</strong></td>
                <td><strong>District Name</strong></td>
                <!-- <td><strong>State</strong></td> -->
                <td><strong>Transaction Status</strong></td>
                <?php if ($r['user_type'] == 1) { ?>
                  <td><strong>Action</strong></td>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              // pr($rows_list);die;
              foreach ($rows_list as $rows) {
               
                $getAllReviewsByArtistId = getAllReviewsByArtistId($rows['user_id']);
                $totalReviews = count($getAllReviewsByArtistId);
                $ratingCounts = [0, 0, 0, 0, 0]; // Array to count occurrences for each star rating

                // Calculate rating counts
                foreach ($getAllReviewsByArtistId as $review) {
                  $rating = intval($review['rating']);
                  if ($rating >= 1 && $rating <= 5) {
                    $ratingCounts[$rating - 1]++;
                  }
                }

                // Calculate the overall rating
                $averageRating = 0;
                if ($totalReviews > 0) {
                  $totalRating = 0;
                  foreach ($ratingCounts as $starRating => $count) {
                    $totalRating += ($starRating + 1) * $count;
                  }
                  $averageRating = $totalRating / $totalReviews;
                  $averageRating = round($averageRating, 1); // Round to one decimal place
                }

                $gallery = getImages($rows['user_id']);
                // pr($gallery);die;
                // $res = getState_byID($rows['user_state']);
                $cat = getCategory_byID($rows['cat_id']);
                $rescity = getcity_byID($rows['user_district']);
                $resstate = getState_byID12($rows['user_state']);
                $wallet =  getPaymentHistoryByUserIdStatus($rows['user_id']);

              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $config['services_type'][$rows['cat_type']]; ?></td>
                  <td><?php echo $cat['cat_name']; ?></td>
                  <td><a href="#"><img src="<?php echo SITEPATH; ?>upload/thumb/<?php echo $rows['user_logo']; ?>" width="50px" height="50px"></a></td>
                  <td>
                    <?php if ($rows['user_video'] != '') { ?>
                      <a href="<?php echo SITEPATH; ?>upload/video/<?php echo $rows['user_video']; ?>" target="new">Watch Video</a>
                    <?php } else {
                      echo "No Video";
                    } ?>

                  </td>
                  <td><?php echo $rows['first_name']; ?></b></td>
                  <td><?php echo $rows['user_email']; ?></td>
                  <td><?php echo decryptIt($rows['user_pass']); ?></td>
                  <td><?php echo $rows['user_phone']; ?></td>
                  <td><?php echo $rows['user_address'] ?></td>
                  <td>
                    <a href="<?= SITEPATH ?>admin/user/gallery.php?id=<?= $rows['user_id']; ?>">View Gallery</a>
                  </td>
                  <td>
                    <?php
                    echo '<a href="' . SITEPATH . 'admin/user/review_view.php?id=' . $rows['user_id'] . '">View Rating :</a> ' . $averageRating;
                    ?>


                  </td>
                  <td><?php echo $rescity['name']; ?></td>
                  <!-- <td><?php echo $resstate['name']; ?></td> -->
                  <td><?php echo !empty($wallet['payment_status']) ? $wallet['payment_status'] : 'Pending'; ?></td>
                  <?php if ($r['user_type'] == "1") { ?>
                    <td id="font12"><?php if ($per['user']['edit'] == 1) { ?>
                        <a href="<?php echo SITEPATH; ?>admin/action/user.php?action=status&id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>" <?php if ($rows['user_status'] == "0") { ?> onMouseOver="showbox('active<?php echo $i; ?>')" onMouseOut="hidebox('active<?php echo $i; ?>')"><i class="fa fa-angle-double-up"></i>
                        <?php } else { ?>
                          onMouseOver="showbox('inactive<?php echo $i; ?>')" onMouseOut="hidebox('inactive<?php echo $i; ?>')"> <i class="fa fa-angle-double-down"></i>
                        <?php } ?>
                        </a>
                        <div id="active<?php echo $i; ?>" class="hide1">
                          <p>Active</p>
                        </div>
                        <div id="inactive<?php echo $i; ?>" class="hide1">
                          <p>Inactive</p>
                        </div>

                        <!-- <?php if ($r['user_id'] == "1") { ?>
                <?php ?> &nbsp;&nbsp; <a href="<?php echo SITEPATH; ?>admin/user/setting.php?id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>"onMouseOver="showbox('Setting<?php echo $i; ?>')"  onMouseOut="hidebox('Setting<?php echo $i; ?>')"> <i class="fa fa-cogs"></i></a>
                <div id="Setting<?php echo $i; ?>" class="hide1">
                  <p>Setting</p>
                </div><?php } ?>-->
                        &nbsp;&nbsp; <a href="<?php echo SITEPATH; ?>admin/user/add-new-user.php?id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>" onMouseOver="showbox('Edit<?php echo $i; ?>')" onMouseOut="hidebox('Edit<?php echo $i; ?>')"> <i class="fa fa-pencil"></i></a>
                        <div id="Edit<?php echo $i; ?>" class="hide1">
                          <p>Edit</p>
                        </div>
                      <?php } ?>
                      &nbsp;&nbsp;
                      <?php if ($per['user']['del'] == 1) { ?>
                        <a href="<?php echo SITEPATH; ?>admin/action/user.php?action=del&id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>" onClick="return confirm('Are you sure you want to delete this item?');" onMouseOver="showbox('Delete<?php echo $i; ?>')" onMouseOut="hidebox('Delete<?php echo $i; ?>')"><i class="fa fa-times"></i></a>
                        <div id="Delete<?php echo $i; ?>" class="hide1">
                          <p>Delete</p>
                        </div>
                      <?php } ?>
                    </td>
                  <?php } ?>
                </tr>
              <?php
                $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <!--close page contets , start footer-->
    <footer class="main-footer">
      <?php include_once("../common/copyright.php"); ?>
    </footer>
  </div>
  <?php include_once("../common/footer.php"); ?>
</body>

</html>