<?php
include("../../system_config.php");
include_once("../common/head.php");
$name = "Add Package";
$id = null;  // Initialize $id to null

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  // Input hover effect
  function txtFocus(Inp) {
    $(Inp).next(".label-brdr").css("width", "100%");
    $(Inp).parent(".form-group").find("label").css("color", "#06b5ef");
  }

  function txtFocusOut(Inp) {
    $(Inp).next(".label-brdr").css("width", "0%");
    $(Inp).parent(".form-group").find("label").css("color", "#999");
  }

  $(document).ready(function() {
    <?php if (!empty($res['package_des'])) { ?>
      // Split the existing package features into an array
      var packageFeatures = "<?php echo $res['package_des']; ?>".split(',');

      // Populate the input fields with the existing features
      for (var i = 0; i < packageFeatures.length; i++) {
        increaseField(packageFeatures[i]);
      }
    <?php } else { ?>
      // Initialize with one empty input field
      increaseField();
    <?php } ?>
  });

  function decreaseField() {
    if ($('#inputFieldsContainer .field-group').length > 1) { // Ensure at least one field remains
      $('#inputFieldsContainer .field-group').last().remove();
    }
  }

  function increaseField(value = '') {
    var index = $('#inputFieldsContainer .field-group').length + 1; // Determine the next index
    var inputField = `
        <div class="field-group">
            <label>Package Features</label>
            <div class="input-container">
                <input name="package_des[]" class="form-control" required value="${value}" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
            </div>
        </div><br>`;
    $('#inputFieldsContainer').append(inputField);
  }
</script>

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
          <form id="form" name="form" action="<?php echo SITEPATH; ?>/admin/action/package.php?action=save" method="post" enctype="multipart/form-data">
            <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
            <div class="box-body">
              <div class="row">
                <input type="hidden" name="cat_sub" value="1">

                <!-- Package Name -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Package Name</label>
                    <input class="form-control" required name="package_name" type="text" value="<?php echo $res['package_name']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <!-- Package Cost -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Package Cost</label>
                    <input class="form-control" required name="package_cost" type="number" value="<?php echo $res['package_cost']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <!-- Image Upload -->
                <!-- <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
                </div> -->
                <div class="clearfix"></div>
                <!-- Package Description -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Package Description</label>
                    <input class="form-control" required name="package_dd" type="text" value="<?php echo $res['package_dd']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <!-- Package Features -->
                <div class="field-group">
                  <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary" onclick="decreaseField()">-</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="increaseField()">+</button>
                  </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div id="inputFieldsContainer"></div> <!-- Container for dynamic input fields -->
                </div>

                <!-- Status -->
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                  <label>Status</label>
                  <select id="user_status" name="status" class="form-control">
                    <?php
                    foreach ($config['display_status'] as $key => $value) {
                      $selected = ($key == $res['status']) ? ' selected="selected"' : '';
                      echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                    }
                    ?>
                  </select>
                  </div>
                </div>

                <div class="clearfix"></div>

                <!-- Submit Button -->
                <div class="btn-submit-active">
                  <input type="submit" value="Submit" />
                  <span></span>
                </div>
                <a href="<?php echo SITEPATH; ?>/admin/package" class="btn btn-cancel">Cancel</a>
              </div>
            </div>
          </form>
          <div class="box-footer clearfix"></div>
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