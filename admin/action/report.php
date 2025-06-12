<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../report/index.php";
switch ($action) {
    case "save":
        $field = array();

        $field['user_id'] = get_safe_post('user_id');
        $field['a_id'] = get_safe_post('a_id');
        $field['status'] = get_safe_post('status');
       
      
        $primary_value = get_safe_post('data_id');



        $output =  save_command(tbl_report, $field, "id", $primary_value);
        $_SESSION['msg'] = $output;
        break;

    case "del":
        $field = array();
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $output =  del_command(tbl_report, "id", $primary_value, false);
        // pr($output);die;


        $_SESSION['msg'] = $output;
        break;
    case "status":
        if (isset($_GET['id'])) {
            $id = urlencode(decryptIt($_GET['id']));
            $row = getReport_byID($id);
            $st = $row['status'];
        }
        if ($st == "Active") {
            $status = "Inactive";
        } else {
            $status = "Active";
        }
        $field['status'] = $status;
        $primary_value = $id;
        $output =  save_command(tbl_report, $field, "id", $primary_value);
        $_SESSION['msg'] = $output;

        break;
}
header("Location:" . $url_return);
