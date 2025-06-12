<?php
include("../../system_config.php");
include_once("../common/head.php");

if ($r['user_type'] == "1") {
  $rows_list = getReport_list();
  // pr($rows_list);die;
}

?>
</head>
<style>
  .button-wrapper {
    text-align: right;
  }

  .button-wrapper button {
    background-color: blue;
    width: 150px;
    height: 40px;
    margin-bottom: 10px;
    color: white;
    border: none;
    cursor: pointer;
  }

  .table-responsive a {
    color: #337ab7;
    text-decoration: none;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">
    <?php include_once("../common/left_menu.php"); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>View All Report</h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">View All Report</li>
        </ol>
      </section>
      <section class="content">
        <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></h1>

        <div class="table-responsive" style="overflow-x: auto;">
          <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <td><strong>Sr no</strong></td>
                <!-- <td><strong>User Id</strong></td> -->
                <td><strong>User Name</strong></td>
                <!-- <td><strong>Artist Id</strong></td> -->
                <td><strong>Artist Name</strong></td>
                <td><strong>Status</strong></td>
                <td><strong>Create Date</strong></td>
                <?php if ($r['user_type'] == "1") { ?>
                  <td><strong>Action</strong></td>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;

              foreach ($rows_list as $rows) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <!-- <td>
                    <a href="<?php echo SITEPATH; ?>admin/Customer?user_id=<?php echo urlencode($rows['user_id']); ?>">
                      <?php echo $rows['user_id']; ?>
                    </a>
                  </td> -->
                  <td>
                  <a href="<?php echo SITEPATH; ?>admin/Customer?user_id=<?php echo urlencode($rows['user_id']); ?>">
                  <?php echo htmlspecialchars($rows['user_name']); ?>
                  </a></td>
                  <!-- <td>
                    <a href="<?php echo SITEPATH; ?>admin/Artist?a_id=<?php echo urlencode($rows['a_id']); ?>">
                      <?php echo $rows['a_id']; ?>
                    </a>
                  </td> -->
                  <td>
                  <a href="<?php echo SITEPATH; ?>admin/Artist?a_id=<?php echo urlencode($rows['a_id']); ?>">  
                  <?php echo htmlspecialchars($rows['artist_name']); ?>
                  </a></td>
                  <td><?php echo $rows['status']; ?></td>
                  <td><?php echo $rows['created_at']; ?></td>
                  <?php if ($r['user_type'] == "1") { ?>
                    <td id="font12" width="20%">
                      <a href="<?php echo htmlspecialchars(SITEPATH); ?>admin/action/report.php?action=status&id=<?php echo urlencode(encryptIt($rows['id'])); ?>"
                        <?php if ($rows['status'] == "Active") { ?>
                        onMouseOver="showbox('active<?php echo $i; ?>')" onMouseOut="hidebox('active<?php echo $i; ?>')">
                        <i class="fa fa-angle-double-up"></i>
                      <?php } else { ?>
                        onMouseOver="showbox('inactive<?php echo $i; ?>')" onMouseOut="hidebox('inactive<?php echo $i; ?>')">
                        <i class="fa fa-angle-double-down"></i>
                      <?php } ?>
                      </a>

                      <div id="active<?php echo $i; ?>" class="hide1">
                        <p>Active</p>
                      </div>
                      <div id="inactive<?php echo $i; ?>" class="hide1">
                        <p>Inactive</p>
                      </div> 

                      <!-- <a href="<?php echo htmlspecialchars(SITEPATH); ?>admin/report/add_report.php?id=<?php echo urlencode(encryptIt($rows['id'])); ?>"
                        onMouseOver="showbox('Edit<?php echo $i; ?>')" onMouseOut="hidebox('Edit<?php echo $i; ?>')">
                        <i class="fa fa-pencil"></i>
                      </a> -->

                      <div id="Edit<?php echo $i; ?>" class="hide1">
                        <p>Edit</p>
                      </div>
                      &nbsp;&nbsp;

                      <?php if ($per['user']['del'] == 1) { ?>
                        <a href="<?php echo htmlspecialchars(SITEPATH); ?>admin/action/report.php?action=del&id=<?php echo urlencode(encryptIt($rows['id'])); ?>"
                          onclick="return confirmDelete('<?php echo urlencode(encryptIt($rows['id'])); ?>');">
                          <i class="fa fa-times" aria-hidden="true" title="Delete"></i>
                        </a>
                      <?php } ?>
                    </td>
                  <?php } ?>
                </tr>
              <?php
                $i++;
              } ?>
            </tbody>
          </table>

          <script>
            function confirmDelete(id) {
              Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
              }).then((result) => {
                if (result.isConfirmed) {
                  var deleteUrl = "<?php echo SITEPATH; ?>admin/action/report.php?action=del&id=" + id;
                  window.location.href = deleteUrl;
                }
              });
              return false;
            }
          </script>

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
