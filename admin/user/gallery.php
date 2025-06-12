<?php
include("../../system_config.php");
include_once("../common/head.php");
// pr($r);die;
$userId = $_GET['id'];
if ($r['user_type'] == 1) {
    $rows_list = getGalleryImagesListByUserId($userId);
} else {
    $rows_list = [];
}

// pr($rows_list);die;
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
                            View All Gallery
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
                                <td><strong>Gallery</strong></td>
                                <?php if ($r['user_type'] == 1) { ?>
                                    <td><strong>Action</strong></td>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $user = getuser_byID($userId); // Fetch user details based on user_id
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['first_name']; ?></td>

                                <td>
                                    <?php foreach ($rows_list as $keyId => $file_name) {
                                        $img_url = SITEPATH . "upload/image/" . $file_name;
                                        $view_url = SITEPATH . "upload/image/" . $file_name; // Full image URL
                                    ?>
                                        <!-- Image Thumbnail -->
                                        <a href="javascript:void(0);" onclick="showImageModal('<?php echo $view_url; ?>')">
                                            <img src="<?php echo $img_url; ?>" width="50px" height="50px">
                                        </a>

                                        <a href="<?php echo SITEPATH; ?>admin/action/user_gallery.php?action=delindivisual&file_id=<?= $keyId; ?>">
                                            <i class="fa fa-trash"
                                                onClick="return confirm('Are you sure you want to delete this image?');" style="color:red"></i>
                                        </a>
                                    <?php } ?>

                                </td>
                                <td>
                                    <?php if ($per['user']['del'] == 1) { ?>
                                        <a href="<?php echo SITEPATH; ?>admin/action/user_gallery.php?action=del&id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>" onClick="return confirm('Are you sure you want to delete this item?');" onMouseOver="showbox('Delete<?php echo $i; ?>')" onMouseOut="hidebox('Delete<?php echo $i; ?>')"><i class="fa fa-times"></i></a>
                                        <div id="Delete<?php echo $i; ?>" class="hide1">
                                            <p>Delete</p>
                                        </div>
                                    <?php } ?>
                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <!-- Image Modal -->
                    <div id="imageModal" class="modal" style="display: none;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span class="close" onclick="closeImageModal()">&times;</span>
                        <img class="modal-content" id="modalImage">
                        <div id="caption"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeImageModal()" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                    <script>
                        function showImageModal(imageUrl) {
                            var modal = document.getElementById("imageModal");
                            var modalImage = document.getElementById("modalImage");
                            modal.style.display = "block";
                            modalImage.src = imageUrl;
                        }

                        function closeImageModal() {
                            var modal = document.getElementById("imageModal");
                            modal.style.display = "none";
                        }
                    </script>

                    <!-- Modal Styling -->
                    <style>
                        .modal {
                            position: fixed;
                            z-index: 1;
                            padding-top: 100px;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            overflow: auto;
                            background-color: rgba(0, 0, 0, 0.9);
                        }

                        .modal-content {
                            margin: auto;
                            display: block;
                            max-width: 80%;
                            max-height: 80%;
                        }

                        .close {
                            position: absolute;
                            top: 15px;
                            right: 35px;
                            color: #fff;
                            font-size: 40px;
                            font-weight: bold;
                            cursor: pointer;
                        }
                    </style>



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