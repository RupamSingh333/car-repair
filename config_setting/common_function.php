<?php

function get_safe_get($name)
{
    $output = $_GET[$name];
    return $output;
}
function get_safe_post($name)
{
    $output = $_POST[$name];
    return $output;
}

function save_command($tblName, $field, $primary_key = "", $primary_value = 0, $return_id = false)
{

    $link = connectme();

    $output = $query = "";
    $output = "Some technical error !. please try again";
    if ($primary_value == "") {
        foreach ($field as $key => $value) {

            $columnField[] = $key;
            $fieldValue[] = "'" . addslashes(trim($value)) . "'";
        }

        $query = "INSERT into " . $tblName . " (" . implode(',', $columnField) . ") values (" . implode(',', $fieldValue) . ")";
        // echo $query; die;
        $link->set_charset("utf8mb4");
        if (mysqli_query($link, $query)) {
            $output = "Data has been saved successfully";
        }
    } else {
        foreach ($field as $key => $value) {
            $field_Value[] = $key . " =  '" . addslashes(trim($value)) . "'";
        }
        $query = "UPDATE " . $tblName . " set " . implode(',', $field_Value) . "   where " . $primary_key . " = " . $primary_value;
        $link->set_charset("utf8mb4");
        if (mysqli_query($link, $query)) {
            $output = "Data has been update successfully";
        }
    }
    return $output;
}

function new_save_command($tblName, $field, $primary_key = null, $primary_value = null)
{
    $link = connectme();

    $output = $query = "";
    $output = "Some technical error! Please try again";
    $inserted_updated_id = 0;


    if (empty($primary_value)) {

        foreach ($field as $key => $value) {
            $columnField[] = $key;
            $fieldValue[] = "'" . addslashes(trim($value)) . "'";
        }

        $query = "INSERT into " . $tblName . " (" . implode(',', $columnField) . ") values (" . implode(',', $fieldValue) . ")";
        // pr($query);die;
        $link->set_charset("utf8mb4");
        if (mysqli_query($link, $query)) {
            $output = "Data has been saved successfully";
            $inserted_updated_id = mysqli_insert_id($link);
        } else {
            $output = "Error: " . mysqli_error($link);
        }
    } else {

        foreach ($field as $key => $value) {
            $field_Value[] = $key . " =  '" . addslashes(trim($value)) . "'";
        }

        $query = "UPDATE " . $tblName . " set " . implode(',', $field_Value) . "   where " . $primary_key . " = " . $primary_value;
        // pr($query);exit;
        $link->set_charset("utf8mb4");
        if (mysqli_query($link, $query)) {
            $output = "Data has been update successfully";
            $inserted_updated_id = $primary_value;
        } else {
            $output = "Error: " . mysqli_error($link);
        }
    }

    return array("message" => $output, "inserted_updated_id" => $inserted_updated_id);
}

function del_command($tblName, $primary_key = "", $primary_value = 0, $return_id = false)
{
    $link = connectme();
    $output = $query = "";
    $output = "Some technical error !. please try again";
    $query = "DELETE FROM  " . $tblName . " where " . $primary_key . " = " . $primary_value;
    //echo $query;
    if (mysqli_query($link, $query)) {
        $output = "Request delete sucessfully";
    }
    return $output;
}

function Insert($tblName, $fields)
{
    $link = connectme();
    $columnField = [];
    $fieldValue = [];
    foreach ($fields as $key => $value) {
        $columnField[] = $key;
        $fieldValue[] = "'" . addslashes(trim($value)) . "'";
    }

    $query = "INSERT INTO " . $tblName . " (" . implode(',', $columnField) . ") VALUES (" . implode(',', $fieldValue) . ")";
    // pr($query);exit;
    $link->set_charset("utf8mb4");
    if (mysqli_query($link, $query)) {
        return array("message" => "Data has been saved successfully", "inserted_id" => mysqli_insert_id($link));
    } else {
        return array("message" => "Error: " . mysqli_error($link), "inserted_id" => 0);
    }
}

function Update($tblName, $fields, $where)
{
    $link = connectme();
    $field_Value = [];
    foreach ($fields as $key => $value) {
        $field_Value[] = $key . " =  '" . addslashes(trim($value)) . "'";
    }

    $query = "UPDATE " . $tblName . " SET " . implode(',', $field_Value) . " WHERE " . $where;
    // pr($query);exit;
    $link->set_charset("utf8mb4");
    if (mysqli_query($link, $query)) {
        return array("message" => "Data has been updated successfully", "updated_id" => mysqli_affected_rows($link));
    } else {
        return array("message" => "Error: " . mysqli_error($link), "updated_id" => 0);
    }
}
