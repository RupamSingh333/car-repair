<?php
include("../../system_config.php");
include_once("../common/head.php");
$name = "Add Package";
// pr($_SESSION);exit;
if (isset($_GET['id'])) {
    $name = "Update Package";
    $id = decryptIt($_GET['id']);
    $res = getPackage_byID($id);
    $st = $res['status'];
  } else {
    if ($per['user']['add'] == 0) { ?>
      <script>
        window.location.href = "../dashboard.php";
      </script>
  <?php }
  }

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript">
</script>


<script type="text/javascript">
  /*input hover effect*/
  function txtFocus(Inp) {
    $(Inp).next(".label-brdr").css("width", "100%");
    $(Inp).parent(".form-group").find("label").css("color", "#06b5ef");
  }

  function txtFocusOut(Inp) {
    $(Inp).next(".label-brdr").css("width", "0%");
    $(Inp).parent(".form-group").find("label").css("color", "#999");
  }

 
<script type="text/javascript" src="<?php echo SITEPATH; ?>syspanel/js/custom.js">
</script>






</head>

<body class="hold-transition skin-blue sidebar-mini fixed">

  <div class="wrapper">
    <?php include_once("../common/left_menu.php"); ?>
    <div class="content-wrapper">
      <!-- Content Header -->
      <section class="content-header">
        <h1>
          <?php if ($per['user']['add'] == 1) { ?>
            <?php echo $name; ?>
          <?php } else {
            echo "&nbsp;";
          } ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">
            <?php if ($per['user']['view'] == 1) { ?>
              <?php echo $name; ?>
            <?php } else {
              echo "&nbsp;";
            } ?>
          </li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="box box-info">
          <!-- <div align="center" style="color:#FF0000">
            <?= $_SESSION['msg']; ?>
          </div> -->
          <form id="form" name="form" action="<?php echo SITEPATH; ?>/admin/action/package.php?action=save" method="post" enctype="multipart/form-data">
            <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
            <div class="box-body">
              <div class="row">
                <input type="hidden" name="cat_sub" value="1">

                <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <label>Package Name</label>
                    <input class="form-control" required name="package_name" placeholder="" type="text" value="<?php echo $res['package_name']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <label>Package Cost</label>
                    <input class="form-control" required name="package_cost" placeholder="" type="number" value="<?php echo $res['package_cost']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                  <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
                </div>
                   <div class="clearfix"></div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group"> 
                    <label>Status</label>
                    <select name="status" id="status" class="form-control">
                                        <option value="Active" <?php if ($st == 'Active') echo 'selected'; ?>>Active</option>
                                        <option value="Inactive" <?php if ($st == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                    </select>
                            
                  </div>
                </div>
                
                <div class="clearfix"></div>

                <div class="clearfix"></div>
                <div class="btn-submit-active">
                  <input type="submit" value="Submit" />
                  <span></span>
                </div>
                <a href="<?php echo SITEPATH; ?>/admin/package" class="btn btn-cancel">Cancel</a>
              </div>
            </div>
          </form>
          <div class="box-footer clearfix"> </div>
        </div>
      </section>
    </div>
  </div>


  

  

  

  <footer class="main-footer">
    <?php include_once("../common/copyright.php"); ?>
  </footer>

  </div>
  <?php include_once("../common/footer.php"); ?>
</body>

</html>