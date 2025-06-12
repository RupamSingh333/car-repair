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
    $current_password = get_safe_post('current_password');
        $new_password = get_safe_post('new_password');
        $confirm_password = get_safe_post('confirm_password');
    
        // Fetch current user data
        $user_data = getuser_byID($user_id);
    
        // Check if current password is correct
        if (decryptIt($user_data['user_pass']) != $current_password) {
            $_SESSION['msg'] = "Current password is incorrect.";
        } elseif ($new_password != $confirm_password) {
            $_SESSION['msg'] = "New password and confirm password do not match.";
        } else {
            $field['user_pass'] = encryptIt($new_password);
            $primary_value = $user_id;
    
            $output = save_command(tbl_user, $field, "user_id", $primary_value);
            $_SESSION['msg'] = $output;
        }

} 

header("Location:".$url_return);

