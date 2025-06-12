<?php
include("../../system_config.php");
include_once("../common/head.php");
if ($r['user_type'] == 1) {
    $rows_list = getcareer_byList();
}
?>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <?php include_once("../common/left_menu.php"); ?>
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <h1>
                    <?php if ($r['user_type'] == "1") { ?>
                        <a style="text-decoration: underline;" href="<?php echo SITEPATH; ?>admin/career/add_career.php">Add New Career</a>
                    <?php } ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">
                        <?php if ($per['user']['view'] == 1) { ?>
                            View All Career
                        <?php } ?>
                    </li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content"> <br />
                <div class="table-responsive" style="overflow-x: auto;">

                    <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Client Info</th>
                                <th>Event Details</th>
                                <th>Artist Info</th>
                                <!-- <th>Resume</th> -->
                                <th>Additional Info</th>
                                <th>Status</th>
                                <?php if ($r['user_type'] == "1") { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($rows_list as $rows) {
                            ?>
                                <tr>
                                    <!-- Serial Number -->
                                    <td><?php echo $i; ?></td>

                                    <!-- Client Info -->
                                    <td>
                                        <strong>Name:</strong> <?php echo $rows['client_name']; ?><br>
                                        <strong>Contact:</strong> <?php echo $rows['client_contact']; ?><br>
                                        <strong>Email:</strong> <?php echo $rows['client_email']; ?>
                                    </td>

                                    <!-- Event Details -->
                                    <td>
                                        <strong>Type:</strong> <?php echo $rows['event_type']; ?><br>
                                        <strong>Date:</strong> <?php echo date('d-m-Y', strtotime($rows['event_date'])); ?><br>
                                        <strong>Time:</strong> <?php echo date('h:i A', strtotime($rows['event_time'])); ?><br>
                                        <strong>Venue:</strong> <?php echo $rows['venue_address']; ?>
                                    </td>

                                    <!-- Artist Info -->
                                    <td>
                                        <strong>Type:</strong> <?php echo htmlspecialchars($rows['artist_type']); ?><br>
                                        <strong>Genre:</strong> <?php echo $rows['genre_preference']; ?><br>
                                        <strong>Budget:</strong> <?php echo $rows['budget_range']; ?>
                                    </td>

                                    <!-- Resume -->
                                    <!-- <td>
                                        <?php if ($rows['resume_path']) { ?>
                                            <a href="<?php echo SITEPATH . $config['category_thumb']; ?><?php echo $rows['resume_path']; ?>" target="_blank">View Resume</a>
                                        <?php } else { ?>
                                            <span>No resume uploaded</span>
                                        <?php } ?>

                                    </td> -->

                                    <!-- Additional Info -->
                                    <td>
                                        <strong>Requests:</strong> <?php echo $rows['special_requests'] ?: 'N/A'; ?><br>
                                        <strong>Audience:</strong> <?php echo $rows['audience_size'] ?: 'N/A'; ?>
                                    </td>

                                    <!-- Status -->
                                    <td><?php echo $rows['status'] == 'Y' ? 'Active' : 'Inactive'; ?></td>

                                    <!-- Actions -->
                                    <?php if ($r['user_type'] == "1") { ?>
                                        <td>
                                            <a href="<?php echo SITEPATH; ?>admin/action/career.php?action=status&id=<?php echo urlencode(encryptIt($rows['booking_id'])); ?>">
                                                <?php if ($rows['status'] == 'N') { ?>
                                                    <i class="fa fa-angle-double-down" title="Deactivate"></i>
                                                <?php } else { ?>
                                                    <i class="fa fa-angle-double-up" title="Activate"></i>
                                                <?php } ?>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a href="<?php echo SITEPATH; ?>admin/career/add_career.php?id=<?php echo urlencode(encryptIt($rows['booking_id'])); ?>">
                                                <i class="fa fa-pencil" title="Edit"></i>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a href="<?php echo SITEPATH; ?>admin/action/career.php?action=del&id=<?php echo urlencode(encryptIt($rows['booking_id'])); ?>" onclick="return confirm('Are you sure you want to delete this booking?');">
                                                <i class="fa fa-times" title="Delete"></i>
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>


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