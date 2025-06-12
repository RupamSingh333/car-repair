<?php
include("../../system_config.php");
include_once("../common/head.php");

if ($r['user_type'] == "1") {
  $rows_list = getLead_list();
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
        <h1>View All Lead</h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">View All Lead</li>
        </ol>
      </section>
      <section class="content">
        <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['msg'];
                                                    unset($_SESSION['msg']); ?></h1>

        <div class="table-responsive" style="overflow-x: auto;">
          <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <td><strong>Sr no</strong></td>
                <td><strong>User Name</strong></td>
                <!-- <td><strong>User Email</strong></td> -->
                <td><strong>User Phone</strong></td>
                <td><strong>Category</strong></td>
                <td><strong>User Address</strong></td>
                <td><strong>Artist Name</strong></td>
                <td><strong>Artist Phone</strong></td>
                <td><strong>Call Type</strong></td>
                <!-- <td><strong>Message</strong></td> -->
                <td><strong>Create Date</strong></td>
                <?php if ($r['user_type'] == "1") { ?>
                  <!-- <td><strong>Action</strong></td> -->
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;

              foreach ($rows_list as $rows) {
                // $userName = getuser_byCustomer($rows['user_id']);
                $artistName = getuser_byartist($rows['artist_id']);
                // pr($rows);exit;
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td>
                    <?php echo htmlspecialchars($rows['name']); ?>
                  </td>
                  <!-- <td>
                    <?php echo htmlspecialchars($rows['email']); ?>
                  </td> -->
                  <td><?php echo htmlspecialchars($rows['mobile']); ?></td>
                  <td><?php echo htmlspecialchars($rows['category_name']); ?></td>
                  <td><?php echo htmlspecialchars($rows['address']); ?></td>
                  <td>
                    <?php echo htmlspecialchars($artistName['first_name']); ?>
                  </td>
                  <td><?php echo htmlspecialchars($artistName['user_phone']); ?></td>
                  <td><?php echo $rows['callType']; ?></td>
                  <!-- <td><?php echo $rows['message']; ?></td> -->
                  <td><?php echo date('d-m-Y h:i A', strtotime($rows['created_at'])); ?></td>
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