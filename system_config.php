<?php
@session_start();
date_default_timezone_set('asia/calcutta');

// define("SITEPATH", "https://codelabsindia.com/");
define("SITEPATH", "http://localhost/car-repair/");
define("ABSPATH", $_SERVER['DOCUMENT_ROOT'] . "/car-repair/");


error_reporting(1);
define("ADMIN_FOLDER", "admin");


function slugify($text)
{
    // Replace non-letter or digits by hyphen
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // Transliterate to ASCII
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Trim hyphens from start and end
    $text = trim($text, '-');

    // Remove duplicate hyphens
    $text = preg_replace('~-+~', '-', $text);

    // Lowercase
    $text = strtolower($text);

    // Return 'n-a' if empty
    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}


function encryptItNew($input) {
    $key = 'your-secret-key'; // use a secure key
    $iv = substr(hash('sha256', $key), 0, 16);
    $encrypted = openssl_encrypt($input, "AES-256-CBC", $key, 0, $iv);
    return rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');
}

function decryptItNew($input) {
    $key = 'your-secret-key';
    $iv = substr(hash('sha256', $key), 0, 16);
    $input = strtr($input, '-_', '+/');
    $input = base64_decode($input);
    return openssl_decrypt($input, "AES-256-CBC", $key, 0, $iv);
}


//echo "asdasdsad";
//echo decryptIt('MTIzNDU2');
function encryptIt($q)
{

    /*  print $q; die("encryptIt");     
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
   $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );*/

    return (base64_encode($q));
}
function decryptIt($q)
{
    /* print $q; die("decryptIt");
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");*/
    return (base64_decode($q));
}

//	echo  decryptIt( 'MTIzNDU2' );die();
function encryptor($action, $string)
{
    $output = false;

    $encrypt_method = "aes128";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $secret_iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $secret_iv);
    }

    return $output;
}

function pr($data)
{
    // Convert the data to a string representation
    if (is_array($data) || is_object($data)) {
        $formatted_data = print_r($data, true);
    } else {
        $formatted_data = htmlentities($data);
    }

    // Echo the formatted data
    echo "<pre>{$formatted_data}</pre>";
    // die;
}

// function FetchRow($sql) {
//     global $link;
//     $result = mysqli_query($link, $sql);
//     return mysqli_fetch_assoc($result);
// }

function RemoveSpecialChar($str)
{
    $res = str_replace(array(
        '\'',
        '"',
        ',',
        ';',
        '<',
        '>'
    ), ' ', $str);
    return $res;
}

// pr(ABSPATH);
// if (file_exists(ABSPATH . "/modules/cms.php")) {
//     pr('ifff');exit;
// } else {
//     pr('else');exit;
// }

// pr(ABSPATH . "config_setting/database.php");die;

include(ABSPATH . "/config_setting/database.php");
include(ABSPATH . "/config_setting/common_function.php");;
include(ABSPATH . "/modules/cms.php");
include(ABSPATH . "/modules/login.php");


$config['image'] = "upload/image/";
$config['category_thumb'] = "upload/thumb/";
$config['category_large'] = "upload/large/";
$config['category_video'] = "upload/video/";
$config['uploads'] = "uploads/";

$config['display_status'] = array("0" => "Active", "1" => "Inactive");
$config['display_home'] = array("0" => "false", "1" => "true");
$config['sms_type'] = array("0" => "Normal", "1" => "Unicode");
$config['send_type'] = array("0" => "SMS", "1" => "CronJob");
$config['paid_status'] = array("0" => "Hide", "1" => "Show");
$config['gender'] = array("0" => "Male", "1" => "Female");
$config['banner_type'] = array("0" => "Top Silder", "1" => "Bottom Silder", "2" => "Academy Silder");
$config['typeofpurchase'] = array("0" => "Purchase", "1" => "Display");
$config['paper'] = array("1" => "Yes", "2" => "No");
$config['user_type'] = array("0" => "Customer", "3" => "Musician");
$config['type'] = array("1" => "Payment", "2" => "Receipt", "3" => "Car Booking", "4" => "Purchase", "5" => "Sales Account", "6" => "Cost of Sales", "7" => "Expense");
$config['type1'] = array("1" => "Payment", "2" => "Receipt");

$config['payment_type'] = array("1" => "Credit", "2" => "Debit");
$config['payment_by'] = array("0" => "Select Payment Type", "1" => "Supplier", "2" => "Customer", "3" => "Account");
$config['typeofsale'] = array("1" => "Cash", "2" => "Cheque", "3" => "Finance");
$config['m_status'] = array("0" => "Choose one", "1" => "Never Married", "2" => "Divorced", "3" => "Awaiting Divorce", "4" => "Widowed");
$config['source'] = array("0" => "Source", "1" => "Youtube");

$config['disposition'] = array("1" => "Select", "15" => "BOOKING", "24" => "Interested", "25" => "Highly Interested", "26" => "Not Interested", "30" => "Continue", "31" => "Others");
$config['newdisposition'] = array("0" => "Others", "15" => "BOOKING", "24" => "Interested", "25" => "Highly Interested", "26" => "Not Interested", "30" => "Continue", "31" => "Others");
$config['ledlaptop'] = array("0" => "LED", "1" => "LAPTOP");
$config['pagetype'] = array("" => "Select Type", "1" => "Artist", "2" => "Teacher");
$config['services_type'] = array("0" => "Service", "1" => "Tutor", "2" => "Blog");
