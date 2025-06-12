<?php
include("../../system_config.php");
$action = get_safe_get('action');
// $url_return = "../index.php";
switch ($action) {
    case "save":
        $field = array();


        $field['title'] = get_safe_post('package_name');
        $field['status'] = get_safe_post('status');
        $field['package_cost'] = get_safe_post('package_cost');
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



        $output =  save_command(tbl_listing, $field, "id", $primary_value);
        $_SESSION['msg'] = $output;
        break;

    case "del":
        $field = array();
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $output =  del_command(tbl_listing, "id", $primary_value, false);
        $_SESSION['msg'] = $output;
        break;
}
header("Location:" . $url_return);
