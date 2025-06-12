<?php
include("../../system_config.php");
include_once("../common/head.php");

$name = "Add New Destination";
$id = "";
$row = [];

if (isset($_GET['id'])) {
    $name = "Update Destination";
    $id = urlencode(decryptIt($_GET['id']));
    $row = getDestinationByID($id); // You need to define this function.
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
                    <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/destination.php?action=save" method="post" enctype="multipart/form-data">
                        <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
                        <div class="box-body">
                            <div class="row">


                                <!-- Title -->
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input id="title" placeholder="Title" class="form-control" name="title" type="text" required
                                            value="<?php echo isset($row['title']) ? $row['title'] : ''; ?>" />
                                    </div>
                                </div>


                                <!-- Upload Image -->
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Upload Image (Banner)</label>
                                        <input type="file" name="banner_image" id="image" accept="image/*" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <input type="file" name="image" id="image" accept="image/*" class="form-control" required />
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="1" <?php echo ($row['status'] == 1) ? 'selected' : '' ?>>Active</option>
                                            <option value="0" <?php echo ($row['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Short Title -->
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Short Title</label>
                                        <textarea id="short_title" required class="form-control" name="short_title" rows="4"><?php echo isset($row['short_title']) ? $row['short_title'] : ''; ?></textarea>
                                    </div>
                                </div>
                                <!-- Description -->
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="description" required class="form-control" name="description" rows="4"><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea>
                                    </div>
                                </div>

                                <!-- Submit and Cancel -->
                                <div class="clearfix"></div>
                                <div class="btn-submit-active">
                                    <input type="submit" value="Submit" />
                                    <span></span>
                                </div>
                                <a href="<?php echo SITEPATH; ?>admin/destination" class="btn btn-cancel">Cancel</a>

                            </div>
                        </div>
                    </form>
                    <div class="box-footer clearfix"></div>
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