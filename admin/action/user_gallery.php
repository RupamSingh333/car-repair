<?php
include("../../system_config.php");

$action = get_safe_get('action');
$url_return = "../user/gallery.php";

switch ($action) {
    case "del":
        // Get the decrypted user ID from the GET parameter
        $user_id = urlencode(decryptIt(get_safe_get('id')));

        // Ensure the user ID is valid before proceeding
        if ($user_id) {
            // Delete all records in tbl_user_gallery where user_id matches the given ID
            $output = del_command(tbl_user_gallery, "user_id", $user_id, false);

            // Set success message
            $_SESSION['msg'] = $output;
            $_SESSION['msg_type'] = 'success';
        } else {
            // Set an error message if the user ID is invalid
            $_SESSION['msg'] = 'Invalid user ID';
            $_SESSION['msg_type'] = 'error';
        }
    case "delindivisual":
        $file_id = get_safe_get('file_id');
        $output = del_command(tbl_user_gallery, "id", $file_id, false);
        // pr($output);die;
        // Set success message
        $_SESSION['msg'] = $output;
        $_SESSION['msg_type'] = 'success';
        // break;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;

    default:
        // If no valid action is provided, redirect to the default URL
        header("Location:" . $url_return);
        exit;
}
