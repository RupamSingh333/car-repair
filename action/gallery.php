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
$url_return = "../user_profile.php";

switch ($action) {
    case "save":
        // Update profile details
        $upload_dir = "../../upload/image/";
        $allowed_types = ['jpg', 'png', 'gif'];
        $max_size = 10 * 1024 * 1024; // 10 MB

        // Handle gallery image uploads
        foreach ($_FILES['gallery_images']['name'] as $key => $name) {
            $tmp_name = $_FILES['gallery_images']['tmp_name'][$key];
            $size = $_FILES['gallery_images']['size'][$key];
            $type = pathinfo($name, PATHINFO_EXTENSION);

            if (in_array($type, $allowed_types) && $size <= $max_size) {
                $file_name = time() . "_" . strtolower(str_replace(" ", "_", $name));
                move_uploaded_file($tmp_name, $upload_dir . $file_name);
                saveGalleryImage($user_id, $file_name);
            }
        }

      

        $output = save_command('tbl_user_gallery', $field, "id", $user_id);
        $_SESSION['msg'] = $output;
        break;
    case "del":
        $field = array();
        //  pr($_POST);die;
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $output =  del_command(tbl_user_gallery, "id", $primary_value, false);
        $_SESSION['msg'] = $output;
        if ($file_name) {
            $file_path = "../../upload/image/" . $file_name;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        break;
}

header("Location: " . $url_return);
