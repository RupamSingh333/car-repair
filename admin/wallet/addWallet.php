<?php
include("../../system_config.php");
include_once("../common/head.php");

$name = "Add Wallet";

if (isset($_GET['id'])) {
    $name = "Update Wallet";

    $id = decryptIt($_GET['id']);
    // You might want to implement a function like getCategory_byID() for retrieving game details by ID
    $userWallet = getWalletDetailsById($id);
    // pr($userWallet['user_id']);die;
    $st = $userWallet['payment_status'];
    $str = $userWallet['paymentType'];
    $strl = $userWallet['paymentCategory'];
}

// Check permissions, redirect if necessary
if ($per['categories']['add'] == 0) {
    header("Location: ../dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include your CSS files here -->
    <!-- Include your JavaScript files here -->
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
                    <!-- <div align="center" style="color:#FF0000">
                        ?php echo $_SESSION['msg']; ?>
                    </div> -->
                    <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/wallet.php?action=save" method="post" enctype="multipart/form-data">
                        <input id="data_id" name="data_id" type="hidden" value="<?php echo isset($id) ? $id : ''; ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <select id="user_id" name="user_id" class="form-control">
                                            <?php
                                            $rows_list = getuser_byList();
                                            foreach ($rows_list as $rows) {
                                                $selected = ($userWallet['user_id'] == $rows['user_id']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $rows['user_id']; ?>" <?php echo $selected; ?>><?php echo $rows['first_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="label-brdr" style="width: 0%;"></label>
                                    </div>
                                    <!-- <?php
                                            $res = getcustomer_byID($userWallet['username']);
                                            ?>
                                      <input type="hidden" name="user_id" value="<?php echo $userWallet['username']; ?>"> -->

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">User Amount:</label>
                                        <input type="number" name="user_amount" id="user_amount" placeholder="User Amount" class="form-control" value="<?php echo isset($userWallet['user_amount']) ? $userWallet['user_amount'] : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="paymentType">Payment Type:</label>
                                        <select name="paymentType" id="paymentType" class="form-control">
                                            <option value="">Select Payment Type</option>
                                            <option value="Cr" <?php if ($str == 'Cr') echo 'selected'; ?>>Cr</option>
                                            <option value="Dr" <?php if ($str == 'Dr') echo 'selected'; ?>>Dr</option>

                                        </select>
                                        </select>
                                    </div>
                                </div>

                                <!-- game -->

                            </div>
                            <div class="row">
                                <!-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="transaction_id">Transaction Id:</label>
                                        <input type="number" name="transaction_id" id="transaction_id" class="form-control" value="<?php echo isset($userWallet['transaction_id']) ? $userWallet['transaction_id'] : ''; ?>"  required>
                                    </div>
                                </div> -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="transaction_id">Payment Status:</label>
                                        <select name="payment_status" id="payment_status" class="form-control">
                                            <option value="">Select Payment Status</option>
                                            <option value="Pending" <?php if ($st == 'Pending') echo 'selected'; ?>>Pending</option>
                                            <option value="Done" <?php if ($st == 'Done') echo 'selected'; ?>>Done</option>
                                            <option value="Failed" <?php if ($st == 'Failed') echo 'selected'; ?>>Failed</option>
                                            <option value="Refunded" <?php if ($st == 'Refunded') echo 'selected'; ?>>Refunded</option>
                                            <option value="Canceled" <?php if ($st == 'Canceled') echo 'selected'; ?>>Canceled</option>
                                        </select>
                                        <!-- </select> -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="paymentCategory">Payment Category:</label>
                                        <input class="form-control" required name="paymentCategory" type="text" value="<?php echo $userWallet['paymentCategory']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">

                                      
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo SITEPATH; ?>admin/wallet/index.php" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <?php include_once("../common/copyright.php"); ?>
        </footer>
    </div>
    <?php include_once("../common/footer.php"); ?>




    <!-- 
    <script>
        function validateDateTime() {
            // Get the elements
            const gameBiding = document.getElementById("gamebiding");
            const gameStart = document.getElementById("gamestart");
            const gameEnd   = document.getElementById("gameend");
            // Convert values to Date objects for accurate comparison
            const gameBidingDate = new Date(gameBiding.value);
            const gameStartDate = new Date(gameStart.value);
            const gameEndDate = new Date(gameEnd.value);

            // Check if game start date is after game bidding date
            if (gameStartDate > gameBidingDate && gameEndDate > gameStartDate) {
                // Valid case
                return true;
          
            } else {
                // Show error message
                alert(" Game End Date and Game Start Date and Time must be after Game Bidding Date and Time.");
                return false;
            }
            
            
        }
    </script> -->






</body>

</html>