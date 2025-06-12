<?php
include("../../system_config.php");

$action = get_safe_get('action');
$url_return = "../services/index.php"; // <-- Make sure your service list is in this path

switch ($action) {
    case "save":
        // pr(($_POST)); die;
        $field = array();
        $field['service_name']   = trim(get_safe_post('service_name'));
        $field['icon_class']   = trim(get_safe_post('icon_class'));
        $field['service_slug'] = trim(get_safe_post('service_slug'));
        $field['service_title']  = trim(get_safe_post('service_title'));
        $field['created_at']     = date('Y-m-d');
        $field['status'] = get_safe_post('status');
        $field['is_special'] = get_safe_post('is_special');

        $primary_value = get_safe_post('data_id');
        $img_name = "";

        if (isset($_FILES["images"]) && $_FILES["images"]["error"] == 0) {
            // Clean file name
            $original_name = $_FILES["images"]["name"];
            $ext = pathinfo($original_name, PATHINFO_EXTENSION);
            $base_name = pathinfo($original_name, PATHINFO_FILENAME);
            $clean_name = preg_replace('/[^a-zA-Z0-9\-]/', '_', strtolower($base_name));
            $img_name = time() . "_" . $clean_name . "." . $ext;

            // Delete old image if editing
            if (!empty($primary_value)) {
                $oldData = get_service_byID($primary_value); // <-- Ensure this function exists
                if (!empty($oldData['service_image'])) {
                    $oldPath = "../../" . $config['category_thumb'] . $oldData['service_image'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            // Upload new image
            move_uploaded_file($_FILES["images"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
            $field['service_image'] = $img_name;
        }

        // Save to DB
        $output = save_command(tbl_services, $field, "service_id", $primary_value); // <-- Replace tbl_services with your actual table constant
        $_SESSION['message'] = $output;
        break;

    case "del":
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $row = get_service_byID($primary_value);

        // Delete image file if exists
        if (!empty($row['service_image'])) {
            $image_path = "../../" . $config['category_thumb'] . $row['service_image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        // Delete from DB
        $output = del_command(tbl_services, "service_id", $primary_value, false);
        $_SESSION['message'] = $output;
        break;

    case "status":
        if (isset($_GET['id'])) {
            $id = urlencode(decryptIt($_GET['id']));
            $row = get_service_byID($id);
            $status = ($row['status'] == "0") ? "1" : "0";
            $field['status'] = $status;
            $output = save_command(tbl_services, $field, "service_id", $id);
            $_SESSION['message'] = $output;
        }
        break;
}

header("Location:" . $url_return);
