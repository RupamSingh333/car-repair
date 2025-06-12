<?php
include("../../system_config.php");
include_once("../common/head.php");
$rows_list = getcontact_byList();
if ($per['user']['view'] == 0) { ?>
  <script>
    window.location.href = "../dashboard.php";
  </script>
<?php } ?>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">
    <?php include_once("../common/left_menu.php"); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>View All Contact </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
          <li class="active">View All Contact</li>
        </ol>
      </section>
      <section class="content">
        <h1 align="center" style="color: #337ab7;">
          <?php echo $_SESSION['message'];
          unset($_SESSION['message']); ?></h1>
        <div class="table-responsive" style="overflow-x: auto;">
          <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <td><strong>Sr No</strong></td>
                <td><strong>Name</strong></td>
                <td><strong>Mobile</strong></td>
                <td><strong>Email</strong></td>
                <td><strong>Type</strong></td> <!-- New Column -->
                <td><strong>Date</strong></td>
                <td><strong>Comment</strong></td>
                <td><strong>Action</strong></td>
              </tr>
            </thead>

            <tbody>
              <?php
              $i = 1;
              foreach ($rows_list as $rows) {
                // pr($rows_list);
                // exit; 
                
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><b><?php echo $rows['name']; ?></b></td>
                  <td><?php echo $rows['telephone'] ? $rows['telephone'] : ''; ?></td>
                  <td><?php echo $rows['email']; ?></td>

                  <td>
                    <?php
                    if ($rows['form_type'] == 'hotel_booking') {
                      echo "Hotel Booking";
                    } elseif ($rows['form_type'] == 'cab_booking') {
                      echo "Cab Booking";
                    } else {
                      echo "Contact";
                    }
                    ?>
                  </td>

                  <td style="width:13%"><?php echo date('d-m-Y h:i A', strtotime($rows['createdAt'])); ?></td>

                  <td>
                    <?php echo substr($rows['comment'], 0, 50); ?><?php if (strlen($rows['comment']) > 50) { ?>...<?php } ?>
                    <div class="show-more" style="display:none;"><?php echo $rows['comment']; ?></div>
                    <a href="javascript:void(0)" class="show-more-link" onclick="this.parentNode.querySelector('.show-more').style.display='block';this.style.display='none';">Show More</a>
                  </td>
                  <td id="font12" width="10%">

                    <a href="<?php echo SITEPATH; ?>/admin/action/contact.php?action=status&id=<?php echo  urlencode(encryptIt($rows['contactus_id'])); ?>" <?php if ($rows['status'] == "0") { ?> onMouseOver="showbox('active<?php echo $i; ?>')" onMouseOut="hidebox('active<?php echo $i; ?>')"><i class="fa fa-angle-double-up"></i><?php } else { ?> onMouseOver="showbox('inactive<?php echo $i; ?>')" onMouseOut="hidebox('inactive<?php echo $i; ?>')"> <i class="fa fa-angle-double-down"></i><?php } ?></a>
                    <div id="active<?php echo $i; ?>" class="hide1">
                      <p>Active</p>
                    </div>
                    <div id="inactive<?php echo $i; ?>" class="hide1">
                      <p>Inactive</p>
                    </div> &nbsp;&nbsp;
                    <a href="<?php echo SITEPATH; ?>/admin/contactus/add_new_contact_page.php?id=<?php echo  urlencode(encryptIt($rows['contactus_id'])); ?>" onMouseOver="showbox('Edit<?php echo $i; ?>')" onMouseOut="hidebox('Edit<?php echo $i; ?>')"> <i class="fa fa-pencil"></i></a>
                    <div id="Edit<?php echo $i; ?>" class="hide1">
                      <p>Edit</p>
                    </div>
                    &nbsp;&nbsp;
                    <a href="<?php echo SITEPATH; ?>/admin/action/contact.php?action=del&id=<?php echo  urlencode(encryptIt($rows['contactus_id'])); ?>"
                      onClick="return confirm('Are you sure want to delete?');"
                      onMouseOver="showbox('Delete<?php echo $i; ?>')"
                      onMouseOut="hidebox('Delete<?php echo $i; ?>')">
                      <i class="fa fa-times"></i>
                    </a>
                    <div id="Delete<?php echo $i; ?>" class="hide1">
                      <p>Delete</p>
                    </div>
                  </td>
                </tr>
              <?php
                $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <?php include_once("../common/copyright.php"); ?>
    </footer>
  </div>
  <?php include_once("../common/footer.php"); ?>
</body>

</html>