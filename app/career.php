<?php
include("system_config.php");
$url_return = SITEPATH . 'career';
// $url_return = "https://test.usicly.com/career";
// print($_POST);
// die;

switch ($action) {
    case "save":
        $field = array();


        $field['name'] = get_safe_post('name');
        $field['email'] = get_safe_post('email');
        $field['phone'] = get_safe_post('phone');
        $field['apply'] = get_safe_post('apply');
        $field['address'] = get_safe_post('address');
        $field['message'] = get_safe_post('message');

        $img_name = "";
        if ($_FILES["resume"]["error"] == 0) {
            $img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["resume"]["name"]));
            move_uploaded_file($_FILES["resume"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
        }
        if ((isset($_FILES["resume"])) && !empty($img_name)) {
            $field['resume'] = $img_name;
        }



        $field['status'] = 0;
        $primary_value = get_safe_post('data_id');

        $output =  save_command(tbl_career, $field, "id", $primary_value);
        $_SESSION['msg'] = $output;
        break;


    case "del":
        $field = array();
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $output =  del_command(tbl_career, "id", $primary_value, false);
        $_SESSION['message'] = $output;
        break;


    case "status":
        if (isset($_GET['id'])) {
            $id = urlencode(decryptIt($_GET['id']));
            $row = getuser_byID($id);
            $st = $row['user_status'];
        }
        if ($st == "0") {
            $status = "1";
        } else {
            $status = "0";
        }
        $field['user_status'] = $status;
        $primary_value = $id;
        $output =  save_command(tbl_career, $field, "id", $primary_value);
        $_SESSION['msg'] = $output;

        break;
}
header("Location:" . $url_return);
