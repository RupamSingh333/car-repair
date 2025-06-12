<?php
include("../../system_config.php");
include_once("../common/head.php");
$name = "Add New Contact";
if (isset($_GET['id'])) {
  $name = "Update Contact";
  $id = decryptIt($_GET['id']);
  $res = getcontact_byID($id);
}
if ($per['user']['add'] == 0) { ?>
  <script>
    window.location.href = "../dashboard.php";
  </script>
<?php } ?>
</head>

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
          <form id="form" name="form" action="<?php echo SITEPATH; ?>/admin/action/contact.php?action=save" method="post" enctype="multipart/form-data">
            <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />

            <div class="box-body">
              <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" required name="name" placeholder="" type="text" value="<?php echo $res['name']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Mobile Number </label>
                    <input class="form-control" required name="telephone" placeholder="" value="<?php echo $res['telephone']; ?>" type="number" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" placeholder="" value="<?php echo $res['email']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <?php if ($res['form_type'] == 'hotel_booking') { ?>
                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group">
                      <label>Hotel</label>
                      <input class="form-control" name="hotel" value="<?php echo $res['hotel']; ?>" type="text">
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group">
                      <label>Rooms</label>
                      <input class="form-control" name="rooms" value="<?php echo $res['rooms']; ?>" type="text">
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group">
                      <label>Nights/Days</label>
                      <input class="form-control" name="nights_days" value="<?php echo $res['nights_days']; ?>" type="text">
                    </div>
                  </div>
                <?php } elseif ($res['form_type'] == 'cab_booking') { ?>
                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group">
                      <label>Cab</label>
                      <input class="form-control" name="cab" value="<?php echo $res['cab']; ?>" type="text">
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="form-group">
                      <label>Days</label>
                      <input class="form-control" name="days" value="<?php echo $res['days']; ?>" type="text">
                    </div>
                  </div>
                <?php } ?>

                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Form Type</label>
                    <select class="form-control" name="form_type">
                      <option value="contact" <?php if ($res['form_type'] == 'contact') echo 'selected'; ?>>Contact</option>
                      <option value="hotel_booking" <?php if ($res['form_type'] == 'hotel_booking') echo 'selected'; ?>>Hotel Booking</option>
                      <option value="cab_booking" <?php if ($res['form_type'] == 'cab_booking') echo 'selected'; ?>>Cab Booking</option>
                    </select>
                  </div>
                </div>
                
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                    <label>Message</label>
                    <input class="form-control" name="comment" placeholder="" value="<?php echo $res['comment']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>


                <div class="clearfix"></div>

                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control">
                      <?php
                      foreach ($config['display_status'] as $key => $value) {
                        $selected = ($key == $res['status']) ? ' selected="selected"' : '';
                        echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>


                <!--buttons-->
                <div class="clearfix"></div>
                <div class="btn-submit-active">
                  <input type="submit" value="Submit" />
                  <span></span>
                </div>
                <a href="<?php echo SITEPATH; ?>admin/contactus" class="btn btn-cancel">Cancel</a>
              </div>
            </div>
          </form>
          <div class="box-footer clearfix"> </div>
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