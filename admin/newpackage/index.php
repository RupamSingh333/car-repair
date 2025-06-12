<?php
include("../../system_config.php");
include_once("../common/head.php");
$rows_list = getPackage_list(); // Ensure this function is defined to fetch packages

if ($per['user']['view'] == 0) {
    echo "<script>window.location.href = '../dashboard.php';</script>";
    exit;
}
?>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <?php include_once("../common/left_menu.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Package Management</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">View All Packages</li>
                </ol>
            </section>

            <section class="content">
                <div class="text-right" style="margin-bottom: 10px;">
                    <a href="<?php echo SITEPATH; ?>admin/newpackage/add-new-package.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add New Package
                    </a>
                </div>

                <!-- <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['message'];
                                                            unset($_SESSION['message']); ?></h1> -->
                <div class="table-responsive" style="overflow-x: auto;">
                    <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Package Name</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Is Special</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($rows_list as $rows) {
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $rows['package_name']; ?></td>
                                    <td>
                                        <?php if (!empty($rows['package_image'])) { ?>
                                            <img src="<?php echo SITEPATH; ?>upload/thumb/<?php echo $rows['package_image']; ?>" width="50" height="50" />
                                        <?php } else {
                                            echo 'No Image';
                                        } ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($rows['created_at'])); ?></td>
                                    <td><?php echo ($rows['package_status'] == "1") ? 'Active' : 'Inactive'; ?></td>
                                    <td><?php echo ($rows['is_special'] == "Y") ? 'Special' : 'No'; ?></td>
                                    <td>
                                        <!-- Status Toggle -->
                                        <a href="<?php echo SITEPATH; ?>admin/action/new_package.php?action=status&id=<?php echo urlencode(encryptIt($rows['package_id'])); ?>"
                                            title="<?php echo ($rows['package_status'] == '1') ? 'Deactivate' : 'Activate'; ?>">
                                            <i class="fa <?php echo ($rows['package_status'] == '1') ? 'fa-eye' : 'fa-eye-slash'; ?>"></i>
                                        </a>

                                        &nbsp;&nbsp;
                                        <!-- Edit -->
                                        <a href="<?php echo SITEPATH; ?>admin/newpackage/add-new-package.php?id=<?php echo urlencode(encryptIt($rows['package_id'])); ?>" title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        &nbsp;&nbsp;
                                        <!-- Delete -->
                                        <a href="<?php echo SITEPATH; ?>admin/action/new_package.php?action=del&id=<?php echo urlencode(encryptIt($rows['package_id'])); ?>"
                                            title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this package?');">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
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