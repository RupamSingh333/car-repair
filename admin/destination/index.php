<?php
include("../../system_config.php");
include_once("../common/head.php");
$rows_list = getDestinationList(); // Make sure this function is defined

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
        <h1>Destination Management</h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">View All Destinations</li>
        </ol>
      </section>

      <section class="content">
        <div class="text-right" style="margin-bottom: 10px;">
          <a href="<?php echo SITEPATH; ?>admin/destination/add-new-destination.php" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New Destination
          </a>
        </div>

        <!-- <h1 align="center" style="color: #337ab7;">
          <?php echo $_SESSION['msg'];
          unset($_SESSION['msg']); ?>
        </h1> -->

        <div class="table-responsive">
          <table id="exportable" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Sr No</th>
                <th>Title</th>
                <th>Short Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($rows_list as $row) {
              ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo substr(strip_tags($row['short_title']), 0, 30) . '...'; ?></td>
                  <td><?php echo substr(strip_tags($row['description']), 0, 50) . '...'; ?></td>
                  <td>
                    <?php if (!empty($row['image'])) { ?>
                      <img src="<?php echo SITEPATH; ?>upload/thumb/<?php echo $row['image']; ?>" width="50" height="50">
                    <?php } else {
                      echo 'No Image';
                    } ?>
                  </td>
                  <td><?php echo ($row['status'] == "1") ? "Active" : "Inactive"; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                  <td>
                    <!-- Status Toggle -->
                    <a href="<?php echo SITEPATH; ?>admin/action/destination.php?action=status&id=<?php echo urlencode(encryptIt($row['id'])); ?>" title="Toggle Status">
                      <i class="fa <?php echo ($row['status'] == "1") ? 'fa-eye' : 'fa-eye-slash'; ?>"></i>
                    </a>

                    &nbsp;&nbsp;
                    <!-- Edit -->
                    <a href="<?php echo SITEPATH; ?>admin/destination/add-new-destination.php?id=<?php echo urlencode(encryptIt($row['id'])); ?>" title="Edit">
                      <i class="fa fa-pencil"></i>
                    </a>

                    &nbsp;&nbsp;
                    <!-- Delete -->
                    <a href="<?php echo SITEPATH; ?>admin/action/destination.php?action=del&id=<?php echo urlencode(encryptIt($row['id'])); ?>" title="Delete" onclick="return confirmDelete();">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>

    <script type="text/javascript">
      function confirmDelete() {
        return confirm("Are you sure you want to delete this destination?");
      }
    </script>

    <footer class="main-footer">
      <?php include_once("../common/copyright.php"); ?>
    </footer>
  </div>
  <?php include_once("../common/footer.php"); ?>
</body>

</html>
