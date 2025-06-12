<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../package/index.php";
switch ($action) {
    case "save":
        $field = array();

        $package_list = implode(',', $_POST['package_des']);


        $field['package_name'] = get_safe_post('package_name');
        $field['package_dd'] = get_safe_post('package_dd');
        $field['status'] = get_safe_post('status');
        $field['package_cost'] = get_safe_post('package_cost');
        $field['package_des'] = $package_list;
        $img_name = "";
        if ($_FILES["image"]["error"] == 0) {
            $img_name =  time() . "_" . strtolower(str_replace(" ", "_", $_FILES["image"]["name"]));
            // move_uploaded_file($_FILES["image"]["tmp_name"], "/upload/image" . $config['game_image'] . $img_name);
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../upload/image/" . $config['game_image'] . $img_name);
        }

        if (!empty($img_name)) {
            $field['image'] = $img_name;
        }
        $primary_value = get_safe_post('data_id');



        $output =  save_command(tbl_package, $field, "id", $primary_value);
        $_SESSION['msg'] = $output;
        break;

    case "del":
        $field = array();
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $output =  del_command(tbl_package, "id", $primary_value, false);
        $_SESSION['msg'] = $output;
        break;
    case "status":
        if (isset($_GET['id'])) {
            $id = urlencode(decryptIt($_GET['id']));
            $row = getPackage_byID($id);
            $st = $row['status'];
        }
        if ($st == "0") {
            $status = "1";
        } else {
            $status = "0";
        }
        $field['status'] = $status;
        $primary_value = $id;
        $output =  save_command(tbl_package, $field, "id", $primary_value);
        $_SESSION['msg'] = $output;

        break;
}
header("Location:" . $url_return);
