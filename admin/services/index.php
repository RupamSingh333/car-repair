<?php
include("../../system_config.php");
include_once("../common/head.php");
$rows_list = get_servicesList(); // Make sure this function is defined and working

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
                <h1>Service Management</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">View All Services</li>
                </ol>
            </section>

            <section class="content">
                <div class="text-right" style="margin-bottom: 10px;">
                    <a href="<?php echo SITEPATH; ?>admin/services/add-new-service.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add New Service
                    </a>
                </div>

                <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['message'];
                                                            unset($_SESSION['message']); ?></h1>
                <div class="table-responsive" style="overflow-x: auto;">
                    <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Service Name</th>
                                <th>Service Title</th>
                                <th>Is Special</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($rows_list as $rows) {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows['service_name']; ?></td>
                                    <td><?php echo $rows['service_title']; ?></td>
                                    <td><?php echo ($rows['is_special'] == "Y") ? "Yes" : "No"; ?></td>
                                    <td>
                                        <?php if (!empty($rows['service_image'])) { ?>
                                            <img src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $rows['service_image']; ?>" width="50" height="50">
                                        <?php } else {
                                            echo 'No Image';
                                        } ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($rows['created_at'])); ?></td>
                                    <td id="font12" width="15%">
                                        <!-- Status Toggle -->
                                        <a href="<?php echo SITEPATH; ?>admin/action/service.php?action=status&id=<?php echo urlencode(encryptIt($rows['service_id'])); ?>"
                                            onMouseOver="showbox('status<?php echo $i; ?>')"
                                            onMouseOut="hidebox('status<?php echo $i; ?>')">
                                            <i class="fa <?php echo ($rows['status'] == "0") ? 'fa-angle-double-down' : 'fa-angle-double-up'; ?>"></i>
                                        </a>
                                        <div id="status<?php echo $i; ?>" class="hide1">
                                            <p><?php echo ($rows['status'] == "1") ? 'Deactivate' : 'Activate'; ?></p>
                                        </div>

                                        &nbsp;&nbsp;
                                        <!-- Edit -->
                                        <a href="<?php echo SITEPATH; ?>admin/services/add-new-service.php?id=<?php echo urlencode(encryptIt($rows['service_id'])); ?>"
                                            onMouseOver="showbox('edit<?php echo $i; ?>')"
                                            onMouseOut="hidebox('edit<?php echo $i; ?>')">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <div id="edit<?php echo $i; ?>" class="hide1">
                                            <p>Edit</p>
                                        </div>

                                        &nbsp;&nbsp;
                                        <!-- Delete -->
                                        <a href="<?php echo SITEPATH; ?>admin/action/service.php?action=del&id=<?php echo urlencode(encryptIt($rows['service_id'])); ?>"
                                            title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this service?');">
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

        <script type="text/javascript">
            function confirmDelete() {
                return confirm("Are you sure you want to delete this service?");
            }
        </script>


        <footer class="main-footer">
            <?php include_once("../common/copyright.php"); ?>
        </footer>
    </div>
    <?php include_once("../common/footer.php"); ?>
</body>

</html>