<?php
include("../../system_config.php");
include_once("../common/head.php");

$name = "Add New Package";
$id = "";
$row = [];

if (isset($_GET['id'])) {
    $name = "Update Package";
    $id = urlencode(decryptIt($_GET['id']));
    $row = getPackagebyID($id);
}
?>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <?php include_once("../common/left_menu.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1><?php echo $name; ?></h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><?php echo $name; ?></li>
                </ol>
            </section>

            <section class="content">
                <div class="box box-info">
                    <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/new_package.php?action=save" method="post" enctype="multipart/form-data">
                        <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
                        <div class="box-body">
                            <div class="row">
                                <!-- Package Name -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Package Name</label>
                                        <input id="package_name" placeholder="Package Name Kashmir Family Tour" class="form-control" name="package_name" type="text" required value="<?php echo (isset($row['package_name'])) ? $row['package_name'] : ''; ?>" />
                                    </div>
                                </div>

                                <!-- Package Route Summary -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Package Route Summary</label>
                                        <input id="package_route_summary" placeholder="[5D/4N] Srinagar » Pahalgam » Gulmarg" class="form-control" name="package_route_summary" type="text" value="<?php echo (isset($row['package_route_summary'])) ? $row['package_route_summary'] : ''; ?>" />
                                    </div>
                                </div>


                                <!-- Title -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input id="title" placeholder="Title of the Package" class="form-control" name="title" type="text" value="<?php echo (isset($row['title'])) ? $row['title'] : ''; ?>" />
                                    </div>
                                </div>

                                <!-- Upload Image -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <input type="file" name="package_image" id="package_image" accept="image/*" class="form-control" />
                                        <?php if (!empty($row['package_image'])) { ?>
                                            <img src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $row['package_image']; ?>" width="100" height="100">
                                        <?php } ?>
                                    </div>
                                </div>

                                <!-- Package Description -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Package Description</label>
                                        <textarea id="package_description" class="form-control" name="package_description" rows="5"><?php echo (isset($row['package_description'])) ? $row['package_description'] : ''; ?></textarea>
                                    </div>
                                </div>
                                <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                                <script>
                                    CKEDITOR.replace('package_description');
                                </script>

                                <!-- Status -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="package_status" name="package_status" class="form-control">
                                            <option value="1" <?php if (isset($row['package_status']) && $row['package_status'] == '1') echo 'selected'; ?>>Active</option>
                                            <option value="0" <?php if (isset($row['package_status']) && $row['package_status'] == '0') echo 'selected'; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- here add new filds radio button  is special for service -->
                                <div class="col-sm-4">
                                    <div class="form-group
">
                                        <label>Is Special</label>
                                        <div class="radio">
                                            <label><input type="radio" name="is_special" value="Y" <?php echo (isset($row['is_special']) && $row['is_special'] == "Y") ? 'checked' : ''; ?>>Special</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="is_special" value="N" <?php echo (isset($row['is_special']) && $row['is_special'] == "N") ? 'checked' : ''; ?>>No</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit and Cancel Buttons -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary" />
                                        <a href="<?php echo SITEPATH; ?>admin/newpackage" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </div> <!-- /.row -->
                        </div> <!-- /.box-body -->
                    </form>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <?php include_once("../common/footer.php"); ?>
        </footer>
    </div>
    <?php include_once("../common/footer.php"); ?>
</body>

</html>