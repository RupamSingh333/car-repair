<?php
/*
 * A Design by W3layouts
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
 *
 */
// error_reporting(1);
$current_page_uri = $_SERVER['REQUEST_URI'];
$part_url = explode("/", $current_page_uri);
$page_name = end($part_url);
$email_id = "rajput.gajendra12@gmail.com";
define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/");

