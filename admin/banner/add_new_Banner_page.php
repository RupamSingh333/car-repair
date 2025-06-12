<?php
include("../../system_config.php");
include_once("../common/head.php");

$name = "Add New Banner";
$id = "";
$row = [];

if (isset($_GET['id'])) {
  $name = "Update Banner";
  $id = urlencode(decryptIt($_GET['id']));
  $row = getbanner_byID($id);
}
?>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">
    <?php include_once("../common/left_menu.php"); ?>
    <div class="content-wrapper">
      <!-- Content Header -->
      <section class="content-header">
        <h1><?php echo $name; ?></h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $name; ?></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="box box-info">
          <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/banner.php?action=save" method="post" enctype="multipart/form-data">
            <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
            <div class="box-body">
              <div class="row">

                <!-- Banner Type -->
                <div class="col-sm-3 col-md-3 col-lg-3">
                  <div class="form-group">
                    <label>Banner Type</label>
                    <select id="banner_type" name="banner_type" class="form-control">
                      <?php
                      foreach ($config['banner_type'] as $key => $value) {
                        $selected = ($key == $row['banner_type']) ? ' selected="selected"' : '';
                        echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <!-- Banner Name -->
                <div class="col-sm-3 col-md-3 col-lg-3">
                  <div class="form-group">
                    <label>Banner Name</label>
                    <input id="title" placeholder="Banner Name" class="form-control" name="title" type="text" REQUIRED
                      value="<?php echo (isset($row['banner_name'])) ? $row['banner_name'] : ''; ?>" />
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <!-- Upload Image -->
                <div class="col-sm-3 col-md-3 col-lg-3">
                  <div class="form-group">
                    <label>Upload Image :</label>
                    <input type="file" name="images" id="images" accept="image/*" class="form-control" />
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                
                <!-- Status -->
                <div class="col-sm-3 col-md-3 col-lg-3">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="select" name="select" class="form-control">
                      <?php
                      foreach ($config['display_status'] as $key => $value) {
                        $selected = ($key == $row['banner_status']) ? ' selected="selected"' : '';
                        echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>



                <!-- Banner Paragraph -->
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                    <label>Banner Paragraph</label>
                    <textarea id="paragraph" class="form-control" name="paragraph" rows="3"><?php echo (isset($row['banner_paragraph'])) ? $row['banner_paragraph'] : ''; ?></textarea>
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="clearfix"></div>
                <div class="btn-submit-active">
                  <input type="submit" value="Submit" />
                  <span></span>
                </div>
                <a href="<?php echo SITEPATH; ?>admin/banner" class="btn btn-cancel">Cancel</a>

              </div> <!-- /.row -->
            </div> <!-- /.box-body -->
          </form>
          <div class="box-footer clearfix"> </div>
        </div>
      </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
      <?php include_once("../common/copyright.php"); ?>
    </footer>
  </div>
  <?php include_once("../common/footer.php"); ?>
</body>

</html>