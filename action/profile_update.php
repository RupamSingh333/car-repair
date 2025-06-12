<?php
include("../../system_config.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user ID is set in session
if (!isset($_SESSION['userid'])) {
    // Redirect to login page if user ID is not set in session
    header("Location: login.php");
    exit();
}

// Get user ID from session
$user_id = $_SESSION['userid'];
$action = get_safe_get('action');


// Redirect URL after update
$url_return = "../user_profile";

if ($action == "save") {
    // Update profile details
    $field = array();
    $field['user_email'] = get_safe_post('user_email');
    $field['note'] = get_safe_post('note');
    $field['first_name'] = get_safe_post('first_name');
    $field['user_phone'] = get_safe_post('user_phone');
    $field['user_district'] = get_safe_post('user_district');
    $field['user_state'] = get_safe_post('user_state');
    $field['user_tel'] = get_safe_post('user_tel');
    $field['user_address'] = get_safe_post('user_address');
    $field['user_desc'] = get_safe_post('user_desc');

    // Handle image upload
    $img_name = "";
    if ($_FILES["user_logo"]["error"] == 0) {
        $img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["user_logo"]["name"]));
        move_uploaded_file($_FILES["user_logo"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
    }
    if ((isset($_FILES["user_logo"])) && !empty($img_name)) {
        $field['user_logo'] = $img_name;
    }

    $field['user_status'] = get_safe_post('user_status');
    $primary_value = $user_id;

    $output = save_command(tbl_user, $field, "user_id", $primary_value);
    $_SESSION['msg'] = $output;
}
// elseif (isset($_POST['change_password'])) {
//     // Update password
//     $current_password = get_safe_post('current_password');
//     $new_password = get_safe_post('new_password');
//     $confirm_password = get_safe_post('confirm_password');

//     // Fetch current user data
//     $user_data = getuser_byID($user_id);

//     // Check if current password is correct
//     if (decryptIt($user_data['user_pass']) != $current_password) {
//         $_SESSION['msg'] = "Current password is incorrect.";
//     } elseif ($new_password != $confirm_password) {
//         $_SESSION['msg'] = "New password and confirm password do not match.";
//     } else {
//         $field['user_pass'] = encryptIt($new_password);
//         $primary_value = $user_id;

//         $output = save_command(tbl_user, $field, "user_id", $primary_value);
//         $_SESSION['msg'] = $output;
//     }
// }

// Redirect to profile page after update
header("Location:" . $url_return);
