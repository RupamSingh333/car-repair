<?php
include("system_config.php");
session_start(); // Initialize session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = encryptIt($_POST['password']);

    // Check if the input is an email or phone number
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        // It's an email
        $sql = "SELECT * FROM reg_user WHERE user_email='" . mysqli_real_escape_string($link, $username) . "' AND user_pass='" . mysqli_real_escape_string($link, $password) . "' LIMIT 1";
    } else {
        // Assuming it's a phone number
        $sql = "SELECT * FROM reg_user WHERE user_phone='" . mysqli_real_escape_string($link, $username) . "' AND user_pass='" . mysqli_real_escape_string($link, $password) . "' LIMIT 1";
    }

    // Execute the query
    $rows = mysqli_query($link, $sql);

    // Check if exactly 1 row is returned
    if (mysqli_num_rows($rows) == 1) {
        $row = mysqli_fetch_assoc($rows); // Fetch associative array

        $isPaymentCompleted = isPaymentCompleted($row['user_id']);
        $userType =  $row['user_type'];
        // pr($userType);die;
        // Check user status
        if ($row['user_status'] == '0' || $row['user_status'] == '1') {
            // User is approved
            $_SESSION['userid'] = $row['user_id'];
            $_SESSION['AdminLogin'] = $row['user_id'];
            $_SESSION['email'] = $row['user_email'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['user_logo'] = $row['user_logo'];
            $_SESSION['type'] = $row['user_type'];

            $_SESSION['msg'] = 'Login successfully!';
            $_SESSION['msg_type'] = 'success';

            // if ($userType == 3 && empty($isPaymentCompleted)) { // 3 is the musician id and 0 is the normal customer
            //     header('Location: checkout');
            // }else{
                // }
                
                    header('Location: dashboard_user');
            exit;
        } 
      
    } else {
        // Invalid username or password
        $_SESSION['msg'] = 'Username or password is incorrect.';
        $_SESSION['msg_type'] = 'error';

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>


<?php
// include("system_config.php");
// session_start(); // Initialize session

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $username = $_POST['username'];
//     $password = encryptIt($_POST['password']);

//     // Check if the input is an email or phone number
//     if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
//         // It's an email
//         $sql = "SELECT * FROM reg_user WHERE user_email='" . mysqli_real_escape_string($link, $username) . "' AND user_pass='" . mysqli_real_escape_string($link, $password) . "' AND (user_status='0')";
//     } else {
//         // Assuming it's a phone number
//         $sql = "SELECT * FROM reg_user WHERE user_phone='" . mysqli_real_escape_string($link, $username) . "' AND user_pass='" . mysqli_real_escape_string($link, $password) . "' AND (user_status='0' ) LIMIT 1";
//     }

//     // Execute the query
//     $rows = mysqli_query($link, $sql);

//     // Check if exactly 1 row is returned
//     if (mysqli_num_rows($rows) == 1) {
//         $row = mysqli_fetch_assoc($rows); // Fetch associative array
//         $_SESSION['userid'] = $row['user_id'];
//         $_SESSION['AdminLogin'] = $row['user_id'];
//         $_SESSION['email'] = $row['user_email'];
//         $_SESSION['first_name'] = $row['first_name'];
//         $_SESSION['user_logo'] = $row['user_logo'];
//         $_SESSION['type'] = $row['user_type'];

//         $_SESSION['msg'] = 'Login successfully!';
//         $_SESSION['msg_type'] = 'success';

//         header('Location: dashboard_user');
//         exit;
//     } else {
//         $_SESSION['msg'] = 'Username or password is incorrect. Please try again. If you believe your credentials are correct, please approval your admin.';
//         $_SESSION['msg_type'] = 'error';
//         header('Location: ' . $_SERVER['HTTP_REFERER']);
//         exit;
//     }
// }
?>
