<?php
include("../../system_config.php");

$action = get_safe_get('action');
$url_return = "../destination/index.php";

// pr($_POST);exit;

switch ($action) {
    case "save":
        $field = [];
        $field['short_title'] = trim(get_safe_post('short_title'));
        $field['title'] = trim(get_safe_post('title'));
        $field['description'] = trim(get_safe_post('description'));
        $field['status'] = get_safe_post('status');

        $primary_value = get_safe_post('data_id');
        $image_name = "";

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
            // Clean and rename uploaded file
            $original_name = $_FILES["image"]["name"];
            $ext = pathinfo($original_name, PATHINFO_EXTENSION);
            $base_name = pathinfo($original_name, PATHINFO_FILENAME);
            $clean_name = preg_replace('/[^a-zA-Z0-9\-]/', '_', strtolower($base_name));
            $image_name = time() . "_" . $clean_name . "." . $ext;

            // Delete old image if editing
            if (!empty($primary_value)) {
                $oldData = getDestinationByID($primary_value);
                if (!empty($oldData['image'])) {
                    $oldPath = "../../" . $config['category_thumb'] . $oldData['image'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            // Upload new image
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../" . $config['category_thumb'] . $image_name);
            $field['image'] = $image_name;
        }

        if (isset($_FILES["banner_image"]) && $_FILES["banner_image"]["error"] === 0) {
            // Clean and rename uploaded file
            $original_name = $_FILES["banner_image"]["name"];
            $ext = pathinfo($original_name, PATHINFO_EXTENSION);
            $base_name = pathinfo($original_name, PATHINFO_FILENAME);
            $clean_name = preg_replace('/[^a-zA-Z0-9\-]/', '_', strtolower($base_name));
            $image_name = time() . "_" . $clean_name . "." . $ext;

            // Delete old image if editing
            if (!empty($primary_value)) {
                $oldData = getDestinationByID($primary_value);
                if (!empty($oldData['banner_image'])) {
                    $oldPath = "../../" . $config['category_thumb'] . $oldData['banner_image'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            // Upload new image
            move_uploaded_file($_FILES["banner_image"]["tmp_name"], "../../" . $config['category_thumb'] . $image_name);
            $field['banner_image'] = $image_name;
        }


        // Save to database
        $output = save_command("tbl_destinations", $field, "id", $primary_value);
        // pr($output);exit;
        $_SESSION['msg'] = $output;
        $_SESSION['msg_type'] = 'success';
        break;

    case "del":
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $row = getDestinationByID($primary_value);

        // Delete image if exists
        if (!empty($row['image'])) {
            $image_path = "../../" . $config['category_thumb'] . $row['image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        if (!empty($row['banner_image'])) {
            $image_path = "../../" . $config['category_thumb'] . $row['banner_image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        // Delete DB entry
        $output = del_command("tbl_destinations", "id", $primary_value, false);
        $_SESSION['msg'] = $output;
        $_SESSION['msg_type'] = 'success';
        break;

    case "status":
        if (isset($_GET['id'])) {
            $id = urlencode(decryptIt($_GET['id']));
            $row = getDestinationByID($id);
            $newStatus = ($row['status'] == "0") ? "1" : "0";
            $field = ['status' => $newStatus];

            $output = save_command("tbl_destinations", $field, "id", $id);
            $_SESSION['msg'] = $output;
            $_SESSION['msg_type'] = 'success';
        }
        break;
}

header("Location: " . $url_return);
