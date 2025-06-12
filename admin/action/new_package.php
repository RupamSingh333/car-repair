<?php
include("../../system_config.php");

$action = get_safe_get('action');
$url_return = "../newpackage/index.php";

switch ($action) {
    case "save":
        $field = array();
        $field['package_name'] = trim(get_safe_post('package_name'));
        $field['package_route_summary'] = trim(get_safe_post('package_route_summary'));
        $field['title'] = trim(get_safe_post('title'));
        $field['package_description'] = trim(get_safe_post('package_description'));
        $field['package_status'] = get_safe_post('package_status');
        $field['created_at'] = date("Y-m-d H:i:s");
        $field['is_special'] = get_safe_post('is_special');

        $primary_value = get_safe_post('data_id');
        $img_name = "";

        if (isset($_FILES["package_image"]) && $_FILES["package_image"]["error"] == 0) {
            $original_name = $_FILES["package_image"]["name"];
            $ext = pathinfo($original_name, PATHINFO_EXTENSION);
            $base_name = pathinfo($original_name, PATHINFO_FILENAME);
            $clean_name = preg_replace('/[^a-zA-Z0-9\-]/', '_', strtolower($base_name));
            $img_name = time() . "_" . $clean_name . "." . $ext;

            // Delete old image if editing
            if (!empty($primary_value)) {
                $oldData = getPackagebyID($primary_value);
                if (!empty($oldData['package_image'])) {
                    $oldPath = "../../upload/thumb/" . $oldData['package_image'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            // Upload new image
            move_uploaded_file($_FILES["package_image"]["tmp_name"], "../../upload/thumb/" . $img_name);
            $field['package_image'] = $img_name;
        }

        $output = save_command('tbl_package', $field, "package_id", $primary_value);
        $_SESSION['msg'] = $output;
        $_SESSION['msg_type'] = 'success';
        break;

    case "del":
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $row = getPackagebyID($primary_value);

        if (!empty($row['package_image'])) {
            $image_path = "../../upload/thumb/" . $row['package_image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $output = del_command('tbl_package', "package_id", $primary_value, false);
        $_SESSION['message'] = $output;
        $_SESSION['msg_type'] = 'success';

        break;

    case "status":
        if (isset($_GET['id'])) {
            $id = urlencode(decryptIt($_GET['id']));
            $row = getPackagebyID($id);
            $status = ($row['package_status'] == "0") ? "1" : "0";
            $field['package_status'] = $status;
            $output = save_command('tbl_package', $field, "package_id", $id);
            $_SESSION['msg'] = $output;
            $_SESSION['msg_type'] = 'success';

        }
        break;
}

header("Location:" . $url_return);
