<?php
include("../../system_config.php");
include_once("../common/head.php");

$userId = $_GET['id'];
$rows_list = [];

if ($r['user_type'] == 1) {
    $rows_list = getReviewListByUserId($userId);
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
                        <!-- <a style="text-decoration: underline;" href="<?php echo SITEPATH; ?>admin/user/add-new-user.php">Add New Musician</a> -->
                    <?php } ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">
                        <?php if ($per['user']['view'] == 1) { ?>
                            View All Reviews
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
                                <td><strong>Sr No.</strong></td>
                                <td><strong>Artist Name</strong></td>
                                <td><strong>User Name</strong></td>
                                <td><strong>User Email</strong></td>
                                <td><strong>Message</strong></td>
                                <td><strong>Rating</strong></td>
                                <td><strong>Date</strong></td>
                                <?php if ($r['user_type'] == 1) { ?>
                                    <td><strong>Action</strong></td>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($rows_list as $rows) {
                                $user = getuser_byID($rows['artist_id']); // Fetch user details based on artist_id
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $user['first_name']; ?></td>
                                    <td><?php echo $rows['reviewer_name']; ?></td>
                                    <td><?php echo $rows['reviewer_email']; ?></td>
                                    <td><?php echo $rows['review_text']; ?></td>
                                    <td><?php echo $rows['rating']; ?></td>
                                    <td><?php echo date('d-m-y', strtotime($rows['review_date'])); ?></td>

                              
                                    <?php if ($r['user_type'] == "1") { ?>
                                        <td id="font12">
                                            <?php if ($per['user']['del'] == 1) { ?>
                                                <a href="<?php echo SITEPATH; ?>admin/action/user_review.php?action=del&id=<?php echo urlencode(encryptIt($rows['review_id'])); ?>" onClick="return confirm('Are you sure you want to delete this item?');" onMouseOver="showbox('Delete<?php echo $i; ?>')" onMouseOut="hidebox('Delete<?php echo $i; ?>')">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                <div id="Delete<?php echo $i; ?>" class="hide1">
                                                    <p>Delete</p>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php
                                $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <!--close page contents, start footer-->
        <footer class="main-footer">
            <?php include_once("../common/copyright.php"); ?>
        </footer>
    </div>
    <?php include_once("../common/footer.php"); ?>
</body>

</html>
