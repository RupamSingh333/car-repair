<?php
if (!defined('ABSPATH'))
    die('-1');
define("tbl_user", "reg_user");
// define("tbl_career", "career");
define("tbl_career", "artist_booking");
define("tbl_enquiry", "enquiry");
define("tbl_subscribe", "subscribe");
define("tbl_user_permission", "user_permission");
define("tbl_district", "district");
define("tbl_categories", "categories");
define("tbl_state", "states");
define("tbl_news", "news");
define("tbl_fourm", "fourm");
define("tbl_banner", "banner");
define("tbl_customer", "customer");
define("tbl_gallery", "gallery");
define("tbl_gallery_category", "gallery_category");
define("tbl_contact", "contactus");
define("tbl_admin", "admin");
define("tbl_package", "package");
define("tbl_register_package", "register_package");
define("tbl_listing", "listing");
define("tbl_user_gallery", "user_gallery");
define("tbl_cities", "cities");
define("tbl_reviews", "reviews");
define("tbl_blog_reviews", "blog_reviews");
define("tbl_report", "report");
define("tbl_testimonials", "testimonials");
define("tbl_wallet", "wallet");
define("tbl_lead_manage", "lead_manage");
define("tbl_services", "tbl_services");
define("tbl_destinations", "tbl_destinations");
define("tbl_package_new", "tbl_package");

function getPaymentHistoryByUserId($userId)
{
    if ($userId) {
        $sql = "SELECT wallet.*,package.package_name as subscription_name FROM wallet
        LEFT JOIN package ON package.id = wallet.subscription_id WHERE
        wallet.user_id = $userId ORDER BY wallet.id DESC";
        // pr($sql);die;
        $array = FetchAll($sql);
        return $array;
    } else {
        return null;
    }
}
function getPaymentHistoryByUserIdStatus($userId)
{
    if ($userId) {
        $sql = "SELECT * FROM wallet WHERE user_id = $userId ";
        // pr($sql);die;
        $array = FetchRow($sql);
        return $array;
    } else {
        return null;
    }
}

function isPaymentCompleted($userId)
{
    if ($userId) {
        $sql = "SELECT * FROM wallet WHERE user_id = $userId and payment_status = 'Done'  ORDER BY id DESC";
        $array = FetchRow($sql);
        return $array;
    } else {
        return null;
    }
}

function getWalletDetailsById($Id)
{
    $sql = "select * from " . tbl_wallet . " where id ='" . $Id . "' limit 0,1 ";

    $array = FetchRow($sql);
    return $array;
}
function getWallet_list()
{
    $sql = "SELECT * FROM " . tbl_wallet . " order by id desc";
    // pr($sql);die;
    $array = FetchAll($sql);
    return $array;
}
function getWalletHistoryByCondition($customerName, $razorpay_payment_id, $payment_status, $paymentType, $paymentCategory, $fromDate = null, $toDate = null)
{
    // Base SQL query
    $sql = "SELECT wallet.*, customer.first_name, customer.accountholder_name, customer.bank_accountno, customer.bank_ifsccode, customer.bank_name, customer.upi_id
            FROM " . tbl_wallet . " AS wallet
            INNER JOIN " . tbl_user . " AS customer ON wallet.user_id = customer.user_id
            WHERE 1=1";
    // pr($sql);exit;

    $conditions = array();

    if ($customerName) {
        $conditions[] = "customer.first_name LIKE '%" . addslashes($customerName) . "%'";
    }

    if ($razorpay_payment_id) {
        $conditions[] = "wallet.razorpay_payment_id  LIKE '%" . addslashes($razorpay_payment_id)  . "%'";
    }

    if ($payment_status) {
        $conditions[] = "wallet.payment_status = '" . addslashes($payment_status) . "'";
    }

    if ($paymentType) {
        $conditions[] = "wallet.paymentType = '" . addslashes($paymentType) . "'";
    }

    if ($paymentCategory) {
        $conditions[] = "wallet.paymentCategory = '" . addslashes($paymentCategory) . "'";
    }

    if ($fromDate && $toDate) {
        $conditions[] = "wallet.created_at BETWEEN '" . date('Y-m-d 00:00:00', strtotime($fromDate)) . "' AND '" . date('Y-m-d 23:59:59', strtotime($toDate)) . "'";
    } elseif ($fromDate) {
        $conditions[] = "wallet.created_at >= '" . date('Y-m-d 00:00:00', strtotime($fromDate)) . "'";
    } elseif ($toDate) {
        $conditions[] = "wallet.created_at <= '" . date('Y-m-d 23:59:59', strtotime($toDate)) . "'";
    }

    if (!empty($conditions)) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }

    $sql .= " ORDER BY wallet.id DESC";
    // pr($sql);exit;
    $array = FetchAll($sql);
    return $array;
}

function getAllReviewsByArtistId($artist_id)
{
    if ($artist_id) {
        $sql = "SELECT * FROM reviews WHERE artist_id = $artist_id  ORDER BY review_id ASC";
        $array = FetchAll($sql);
        return $array;
    } else {
        return [];
    }
}

function getAllReviewsByBlogId($blog_id)
{
    if ($blog_id) {
        $sql = "SELECT * FROM blog_reviews WHERE artist_id = $blog_id  ORDER BY review_id ASC";
        $array = FetchAll($sql);
        return $array;
    } else {
        return [];
    }
}
function getAllBlogReviewsByBlogId($blog_id)
{
    if ($blog_id) {
        $sql = "SELECT * FROM blog_reviews WHERE blog_id = $blog_id  ORDER BY review_id ASC";
        $array = FetchAll($sql);
        return $array;
    } else {
        return [];
    }
}


function getRatingByUserId($userId, $artist_id)
{
    if ($userId && $artist_id) {
        $sql = "SELECT * FROM reviews WHERE user_id = $userId AND artist_id = $artist_id  ORDER BY review_id ASC";
        $array = FetchRow($sql);
        return $array;
    } else {
        return null;
    }
}
function getBlogByUserId($userId, $blog_id)
{
    if ($userId && $blog_id) {
        $sql = "SELECT * FROM blog_reviews WHERE user_id = $userId AND blog_id = $blog_id  ORDER BY review_id ASC";
        $array = FetchRow($sql);
        return $array;
    } else {
        return null;
    }
}
function getReportcount($id)
{
    $sql = "SELECT COUNT(*) as report_count FROM report WHERE a_id = $id";
    // pr($sql);die;
    $result = FetchRow($sql); // Assuming FetchRow fetches a single row as an associative array
    return $result['report_count']; // Returning the count of reports
}

function allCityList()
{
    // $sql = "SELECT * FROM " . tbl_cities . "  ORDER BY id asc";
    $sql = "SELECT * FROM " . tbl_cities . " WHERE state_id IN (SELECT id FROM `states`) ORDER BY name ASC";

    $array = FetchAll($sql);
    return $array;
}

function getCityList($stateId = null)
{
    if ($stateId) {
        $sql = "SELECT * FROM " . tbl_cities . " WHERE state_id ='" . $stateId . "' ORDER BY id asc";
        // pr($sql);die;
    } else {
        $sql = "SELECT * FROM " . tbl_cities . " ORDER BY id asc limit 10";
    }
    $array = FetchAll($sql);
    return $array;
}
function getImages($id)
{
    $sql = "SELECT * FROM " . tbl_user_gallery . " WHERE user_id='" . $id . "' limit 0,1";
    // pr($sql);die;
    $array = FetchAll($sql);
    return $array;
}
function getGalleryImages($user_id)
{
    $sql = "SELECT * FROM " . tbl_user_gallery . " WHERE user_id='" . $user_id . "' LIMIT 0,20";
    // pr($sql);die;
    $array = FetchAll($sql);
    return $array;
}
function getGalleryImagesListByUserId($userId)
{

    $sql = "SELECT * FROM " . tbl_user_gallery . " where user_id = " . $userId;
    $result = FetchAll($sql);
    // pr($result);die;
    $userGallery = [];
    foreach ($result as $row) {
        $userGallery[$row['id']] = $row['file_name'];
    }
    return $userGallery;
}
function getReviewListByUserId($userId)
{

    $sql = "SELECT * FROM " . tbl_reviews . " where artist_id = " . $userId;
    $result = FetchAll($sql);
    // pr($result);die;

    return $result;
}
function getBlogReviewListByUserId($blogId)
{

    $sql = "SELECT * FROM " . tbl_blog_reviews . " where blog_id = " . $blogId;
    $result = FetchAll($sql);
    // pr($result);die;

    return $result;
}


function getProfile_list($user_id)
{
    $sql = "SELECT * FROM " . tbl_user . " WHERE user_id='" . $user_id . "' LIMIT 0,20";
    $array = FetchAll($sql);
    return $array;
}
function getReview_list($user_id)
{
    $sql = "SELECT * FROM " . tbl_reviews . " WHERE user_id='" . $user_id . "' LIMIT 0,20";
    $array = FetchAll($sql);
    return $array;
}
function getSubscribe_list()
{
    $sql = "SELECT * FROM " . tbl_subscribe . " order by id desc";
    $array = FetchAll($sql);
    return $array;
}
function getLead_list()
{
    $sql = "SELECT * FROM " . tbl_lead_manage . " order by id desc";
    $array = FetchAll($sql);
    return $array;
}
function getEnquiry_list1()
{
    $sql = "SELECT * FROM " . tbl_enquiry . " order by user_id desc";
    // pr($sql);die;
    $array = FetchAll($sql);
    return $array;
}

function getReport_list()
{
    global $link;

    $sql = "
        SELECT 
            r.id,
            r.user_id, 
            r.a_id, 
            r.status, 
            r.created_at, 
            u.first_name AS user_name, 
            a.first_name AS artist_name
        FROM report AS r
        LEFT JOIN reg_user AS u ON r.user_id = u.user_id
        LEFT JOIN reg_user AS a ON r.a_id = a.user_id
    ";
    // pr($sql);die;

    $array = FetchAll($sql);
    return $array;
}


function getcustomer_byList_dah()
{
    $sql = "select * from " . tbl_customer . " order by  user_id desc limit 0,10 ";
    $array = FetchAll($sql);
    return $array;
}

function getRegPackage_list()
{

    $sql = "SELECT * FROM " . tbl_register_package . " ORDER BY id ASC";

    $array = FetchAll($sql);
    return $array;
}
function getRegPackageAmount()
{

    $sql = "SELECT amount FROM " . tbl_register_package . " ORDER BY id ASC";


    $array = FetchRow($sql);


    return $array['amount'];
}

function getPackage_byID($Id)
{

    $sql = "select * from " . tbl_package . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getRegPackage_byID($Id)
{

    $sql = "select * from " . tbl_register_package . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getSubscribe_byID($Id)
{

    $sql = "select * from " . tbl_subscribe . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getReport_byID($Id)
{

    $sql = "select * from " . tbl_report . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getEnquiry_byID($Id)
{

    $sql = "select * from " . tbl_enquiry . " where user_id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getListing_list()
{

    $sql = "SELECT * FROM " . tbl_listing . " ORDER BY id ASC";

    $array = FetchAll($sql);
    return $array;
}
// function getListing_my_list($user_id)
// {
//     $sql = "SELECT * FROM " . tbl_listing . " WHERE userId ='" . $user_id . "' ORDER BY id ASC";
//     // pr($sql);die;
//     $array = FetchAll($sql, $params);
//     return $array;
// }

function getListing_byID($Id)
{

    $sql = "select * from " . tbl_listing . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getSubscription_byID($Id)
{

    $sql = "select * from " . tbl_package . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}



function getcustomer_byList()
{
    $sql = "select * from " . tbl_customer . " order by  user_id desc ";
    $array = FetchAll($sql);
    return $array;
}
function getcustomer_bycount()
{
    $sql = "SELECT COUNT(user_id)  FROM " . tbl_customer . "";
    $array = FetchAll($sql);
    return $array;
}

function getcontact_byList($limit = null)
{
    if ($limit) {
        $sql = "select * from " . tbl_contact . " order by  contactus_id desc limit 0," . $limit;
    } else {
        $sql = "select * from " . tbl_contact . " order by  contactus_id desc ";
    }
    $array = FetchAll($sql);
    return $array;
}

function getcontact_byID($id)
{

    $sql = "select * from " . tbl_contact . "  where contactus_id = '" . $id . "'";
    $array = FetchRow($sql);
    return $array;
}
function get_gallery_category()
{
    $sql = "select * from " . tbl_gallery_category . " order by  id desc ";
    //echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function get_gallery_category_home()
{
    $sql = "select * from " . tbl_gallery_category . " WHERE cat_status = '0' order by  id asc ";
    //echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}

function get_gallery_category_byID($id)
{
    $sql = "select * from " . tbl_gallery_category . " where id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}


function get_page_gallery_byID($id)
{
    $sql = "select * from " . tbl_gallery . " where gallery_category ='" . $id . "' ";
    $array = FetchAll($sql);
    return $array;
}
function getgallery_list()
{
    $sql = "select * from " . tbl_gallery . " WHERE gallery_status = '0' ORDER BY gallery_id desc ; ";
    $array = FetchAll($sql);
    return $array;
}

function getgallery_listid($id)
{
    if ($id !== "1") {
        $id = "and user_id = " . $id;
    } else {
        $id = "";
    }

    $sql = "select * from " . tbl_gallery . " WHERE gallery_status = '0' $id ORDER BY gallery_id desc ; ";
    $array = FetchAll($sql);
    return $array;
}



function getgallery_lists()
{
    $sql = "select * from " . tbl_gallery . " ORDER BY gallery_id desc";

    $array = FetchAll($sql);
    return $array;
}

function getgallery_ID($id)
{
    $sql = "select * from " . tbl_gallery . " where gallery_id =  '" . $id . "'  limit 0,1";
    //echo $sql;die(); 
    $array = FetchAll($sql);
    return $array;
}

function gallery_byID($id)
{
    $sql = "select * from " . tbl_gallery . " where gallery_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function get_gallery_byID($id)
{
    $sql = "select * from " . tbl_gallery . " where gallery_category='" . $id . "' ";
    $array = FetchAll($sql);
    return $array;
}
function getgallery_count()
{
    $sql = "SELECT COUNT(*) FROM " . tbl_gallery . "";
    //echo $sql;die(); 
    $array = FetchAll($sql);
    return $array;
}

function getcustomer_byID($id)
{
    $sql = "select * from " . tbl_customer . " WHERE user_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getcustomer_list()
{
    $sql = "select * from " . tbl_customer . " ORDER BY user_id desc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function getenquiry_list($id)
{
    $sql = "select customer.*,reg_user.first_name as artiste_name,categories.cat_name as category_name,states.name as state_name, cities.name as district_name from customer 
    LEFT JOIN reg_user ON reg_user.user_id=customer.a_id
    LEFT JOIN categories ON categories.cat_id=customer.cat_id
    LEFT JOIN states ON states.id=customer.user_state
    LEFT JOIN cities ON cities.id=customer.user_district
    WHERE a_id= " . $id;
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function getenquiry_list12($id)
{
    $sql = "select * from " . tbl_customer . " WHERE login_id='" . $id . "' ";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function getenquiry_list_vendor($id)
{
    $sql = "SELECT * FROM " . tbl_enquiry . " WHERE a_id='" . $id . "' ORDER BY enquiry_id DESC";
    $array = FetchAll($sql);
    return $array;
}
function getlead_list_vendor($id)
{
    $sql = "SELECT * FROM " . tbl_lead_manage . "  WHERE artist_id='" . $id . "' ORDER BY id DESC";
    $array = FetchAll($sql);
    return $array;
}

function leadListByVendor($id)
{
    $id = intval($id);

    $sql = "SELECT lm.*,ru.listing
            FROM " . tbl_lead_manage . " lm 
            INNER JOIN reg_user ru ON ru.user_id = lm.artist_id 
            WHERE lm.artist_id = '$id' 
            ORDER BY lm.id DESC";

    $array = FetchAll($sql);
    return $array;
}

function getbanner_byID($id)
{
    $sql = "select * from " . tbl_banner . " where banner_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getbanner_list()
{
    $sql = "select * from " . tbl_banner . " order by  banner_id desc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}

function get_servicesList()
{
    $sql = "select * from " . tbl_services . " order by service_id desc";
    $array = FetchAll($sql);
    return $array;
}

function getActiveServiceList($is_special = null)
{
    if ($is_special) {
        $sql = "select * from " . tbl_services . " where is_special = 'Y' and status = '1' order by service_name ASC";
    } else {
        $sql = "select * from " . tbl_services . " where status = '1' order by service_name ASC";
    }

    $array = FetchAll($sql);
    return $array;
}


function get_service_byID($id)
{
    $sql = "select * from " . tbl_services . " where service_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}

function getDestinationList()
{
    $sql = "select * from " . tbl_destinations . " order by id desc";
    $array = FetchAll($sql);
    return $array;
}


function getActiveDestinationList()
{
    $sql = "select * from " . tbl_destinations . " where status = '1' order by title ASC";
    $array = FetchAll($sql);
    return $array;
}


function getDestinationByID($id)
{
    $sql = "select * from " . tbl_destinations . " where id=" . $id . " limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}

function getPackage_list()
{

    $sql = "SELECT * FROM " . tbl_package_new . " ORDER BY package_id ASC";

    $array = FetchAll($sql);
    return $array;
}

function getActiveSpecialPackageList($is_special = null)
{
    if ($is_special) {
        $sql = "select * from " . tbl_package_new . " where is_special = 'Y' and package_status = '1' order by package_name ASC";
    } else {
        $sql = "select * from " . tbl_package_new . " where package_status = '1' order by package_name ASC";
    }

    $array = FetchAll($sql);
    return $array;
}

function getActivePackageList()
{
    $sql = "SELECT * FROM " . tbl_package_new . " where package_status = '1' ORDER BY package_name ASC";
    // pr($sql);
    // die;
    $array = FetchAll($sql);
    return $array;
}

function getPackagebyID($Id)
{

    $sql = "select * from " . tbl_package_new . " where package_id=" . $Id . " limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}


function getbanner_list_status()
{
    $sql = "select * from " . tbl_banner . " where banner_status = '0' and banner_type = '0' order by  banner_id asc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function getbanner_list_status_bot()
{
    $sql = "select * from " . tbl_banner . " where banner_status = '0' and banner_type = '1' order by  banner_id asc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function getbanner_list_status_botnew()
{
    $sql = "select * from " . tbl_banner . " where banner_status = '0' and banner_type = '2' order by  banner_id asc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function getfourm_byID($id)
{
    $sql = "select * from " . tbl_fourm . " where fourm_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function gettestimonials_byID($id)
{
    $sql = "select * from " . tbl_testimonials . " where id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}

function get_packageList()
{
    $sql = "select * from " . tbl_package . " order by package_id desc";
    $array = FetchAll($sql);
    return $array;
}

function getfourm_byID_Cat($id)
{
    $sql = "select * from " . tbl_fourm . " where cat_id='" . $id . "' order by  fourm_id desc ";
    $array = FetchAll($sql);
    return $array;
}


function getfourm_byID_user($id)
{
    $sql = "select * from " . tbl_fourm . " where user_district='" . $_SESSION['user_district'] . "' order by  fourm_id desc ";
    $array = FetchAll($sql);
    return $array;
}


function getfourm_list()
{
    $sql = "select * from " . tbl_fourm . " order by  fourm_id desc";
    $array = FetchAll($sql);
    return $array;
}
function getTestimonials_list()
{
    $sql = "select * from " . tbl_testimonials . " order by  id desc";
    $array = FetchAll($sql);
    return $array;
}
function getTestimonials_list_status()
{
    $sql = "SELECT * FROM " . tbl_testimonials . " WHERE status = 0 ORDER BY id DESC";
    $array = FetchAll($sql);
    return $array;
}


function getnews_byID($id)
{
    $sql = "select * from " . tbl_news . " where news_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getnews_list()
{
    $sql = "select * from " . tbl_news . " order by  news_id desc";
    $array = FetchAll($sql);
    return $array;
}

function getnews_list_by_dash()
{
    $sql = "select * from " . tbl_news . " order by  news_id desc limit 0,10";
    $array = FetchAll($sql);
    return $array;
}

function getdistrict_byID($id)
{
    $sql = "select * from " . tbl_district . " where district_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getdistrict_list()
{
    $sql = "select * from " . tbl_district . " order by  district_id desc";
    $array = FetchAll($sql);
    return $array;
}

function getState_byID($id)
{
    $sql = "select * from " . tbl_state . " where stateID='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getState_byID12($id)
{
    $sql = "select * from " . tbl_state . " where id='" . $id . "' ";
    $array = FetchRow($sql);
    // pr($array);die;
    return $array;
}

function getCity_byID($id = null)
{
    $sql = "SELECT * FROM " . tbl_cities . " WHERE id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}

function getState_list()
{
    $sql = "SELECT * FROM " . tbl_state . " ORDER BY id ASC";
    $array = FetchAll($sql);
    return $array;
}


function getCategory_byList_byuser($id)
{
    $sql = "select * from " . tbl_categories . " where user_id='" . $id . "'  ";
    $array = FetchAll($sql);
    return $array;
}

function getCategory_bySearch($id)
{
    $sql = "select * from " . tbl_categories . " where cat_name LIKE '%" . $id . "%' ";
    $array = FetchAll($sql);
    return $array;
}
function getCategory_byID($id)
{
    $sql = "select * from " . tbl_categories . " where cat_id='" . $id . "'  limit 0,1 ";
    // pr($sql);die;
    $array = FetchRow($sql);
    return $array;
}
function getCategory_list()
{
    $sql = "select * from " . tbl_categories . " order by  cat_id desc ";
    $array = FetchAll($sql);
    return $array;
}


function getCategory_list_index()
{
    $sql = "select * from " . tbl_categories . " order by  cat_id desc limit 0,6";
    $array = FetchAll($sql);
    return $array;
}

//categories_list_services 10 

function categories_list_services()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0' and p_cat='0' and services_type='0' and dropdown='1'  order by  sort asc limit 10";
    // echo $sql;die;
    $array = FetchAll($sql);
    return $array;
}
//categories_list_tutor 10
function categories_list_tutor()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0' and p_cat='0' and services_type='1' and dropdown='1'  order by  sort asc limit 10";
    $array = FetchAll($sql);
    return $array;
}
//categories_list_blog 10
function categories_list_blog()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0' and p_cat='0' and services_type='2' and dropdown='1'  order by  sort asc limit 10";
    $array = FetchAll($sql);
    return $array;
}
// 

function categories_list()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0' and p_cat='0' and services_type='0'  order by  sort asc ";
    $array = FetchAll($sql);
    return $array;
}
function categories_list_service_type()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0' and p_cat='0' and services_type='1'  order by  sort asc ";
    $array = FetchAll($sql);
    return $array;
}
function categories_list_service_type_blog()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0' and p_cat='0' and services_type='2'  order by  sort asc ";
    $array = FetchAll($sql);
    return $array;
}
function categories_list_user()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0'  order by  sort desc ";
    $array = FetchAll($sql);
    return $array;
}
function getdashuser()
{
    $sql = "select  COUNT(user_id) from " . tbl_user . " ";
    $array = FetchRow($sql);
    return $array;
}
function getdashusertoday($id)
{
    $sql = "select  COUNT(user_id) from " . tbl_user . " WHERE Date(`user_startfrom`)='$id';";
    $array = FetchRow($sql);
    return $array;
}

function getuser_permission_byID($id)
{
    $sql = "select * from " . tbl_user_permission . " where user_id = '" . $id . "'";
    $array = FetchAll($sql);
    return $array;
}

function getuser_byID($id)
{
    $sql = "select * from " . tbl_user . " where user_id = '" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    // pr($array);die;
    return $array;
}
function getcareer_byID($id)
{
    // $sql = "select * from " . tbl_career . " where id = '" . $id . "' limit 0,1 ";
    $sql = "SELECT * FROM " . tbl_career . " WHERE booking_id = '" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getuser_byartist($id)
{

    $sql = "SELECT * FROM " . tbl_user . " WHERE user_id = '" . $id . "' LIMIT 0,1";
    $array = FetchRow($sql);
    // pr($array);die;
    return $array;
}
function getuser_byCustomer($id)
{
    $sql = "SELECT * FROM " . tbl_user . " WHERE user_id = '" . $id . "' LIMIT 0,1";
    $array = FetchRow($sql);
    return $array;
}

// function getArtist_list_by_service()
// {

//     $sql = "SELECT * FROM " . tbl_user . " WHERE user_type = 3 AND cat_type = 0 AND home_show = 1  ORDER BY user_id DESC";


//     // pr($sql);die;
//     $array = FetchAll($sql);
//     return $array;
// }

function updateTransactionStatus($razorpay_order_id, $razorpay_payment_id, $payment_status = null, $paymentMethod)
{
    global $link;
    $sql = "SELECT id FROM wallet WHERE razorpay_order_id = '$razorpay_order_id'";
    $array = FetchRow($sql);

    if ($array) {
        $updateSql = "UPDATE wallet SET payment_status = ?, razorpay_payment_id = ?, payment_method = ? WHERE razorpay_order_id = ?";
        $stmt = mysqli_prepare($link, $updateSql);
        mysqli_stmt_bind_param($stmt, 'ssss', $payment_status, $razorpay_payment_id, $paymentMethod, $razorpay_order_id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    } else {
        return false;
    }
}


function getArtist_list_by_service()
{

    $sql = "SELECT * FROM " . tbl_user . " WHERE user_type = 3 AND cat_type = 0 AND home_show = 1 AND user_status = 0 ORDER BY user_id DESC";


    // pr($sql);die;
    $array = FetchAll($sql);
    return $array;
}
function getArtist_list_by_tutor()
{


    $sql = "SELECT * FROM " . tbl_user . " WHERE user_type = 3 AND cat_type = 1 AND home_show = 1 AND user_status = 0 ORDER BY user_id DESC";

    $array = FetchAll($sql);
    // pr($array);die;
    return $array;
}


function getUserInfoById($user_id)
{
    $sql = "select * from " . tbl_user . " where user_id = " . $user_id . " limit 0,1 ";
    // pr($sql);die;
    $array = FetchRow($sql);
    return $array;
}
function getUserInfoByName($first_name)
{
    $sql = "select * from " . tbl_user . " where first_name = '" . $first_name . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getUserInfoByName12($first_name)
{
    $sql = "select * from " . tbl_user . " where first_name = '" . $first_name . "' limit 0,1 ";
    $array = FetchAll($sql);
    return $array;
}


function getuser_byList_byuser($id)
{
    $sql = "select * from " . tbl_user . " where user_id = '" . $id . "' limit 0,1 ";
    $array = FetchAll($sql);
    return $array;
}
function getuser_byList_bydash()
{
    $sql = "select * from " . tbl_user . " order by  user_id desc limit 0,10";
    $array = FetchAll($sql);
    return $array;
}

function getuser_byList()
{

    // $sql = "select * from " . tbl_user . " order by  user_id desc ";
    $sql = "SELECT * FROM " . tbl_user . " WHERE user_type = 3 ORDER BY user_id DESC";

    // echo  $sql;
    $array = FetchAll($sql);
    return $array;
}

function getcareer_byList()
{
    // $sql = "SELECT * FROM " . tbl_career . " ORDER BY id DESC";
    $sql = "SELECT * FROM " . tbl_career . " ORDER BY booking_id DESC";
    $array = FetchAll($sql);
    return $array;
}



function getCustomerList($limit = null)
{
    if ($limit) {
        $sql = "SELECT * FROM " . tbl_user . " WHERE user_type = 0 ORDER BY user_id DESC LIMIT 0," . $limit;
    } else {
        $sql = "SELECT * FROM " . tbl_user . " WHERE user_type = 0 ORDER BY user_id DESC";
    }
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}

function getuser_byList_byCate($id)
{
    $sql = "select * from " . tbl_user . " where cat_id = '" . $id . "' order by  user_id desc  ";
    $array = FetchAll($sql);
    return $array;
}
function getuser_byList_byCate_dash($id, $type)
{
    $sql = "select * from " . tbl_user . " where cat_id = '" . $id . "' and cat_type = '" . $type . "' and user_status = '0' order by  user_id desc  ";
    $array = FetchAll($sql);
    return $array;
}

function getUserListByCategory($id, $type)
{
    $sql = "SELECT reg_user.*, cities.name as district_name, states.name as state_name
        FROM reg_user
        LEFT JOIN cities ON cities.id = reg_user.user_district
        LEFT JOIN states ON states.id = reg_user.user_state  
        WHERE reg_user.cat_id = " . $id . " and reg_user.cat_type = " . $type . " and reg_user.user_status = 0 ORDER BY reg_user.user_id DESC";
    // pr($sql);
    // exit;
    $array = FetchAll($sql);
    return $array;
}


function updateFavoriteCount($userId)
{
    // Assuming you have a database connection $conn
    global $conn;

    // Get the current favorite count
    $query = "SELECT favorites FROM reg_user WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();
    $currentCount = $row[0];

    // Increase the count by 1
    $newCount = $currentCount + 1;

    // Update the favorite count in the database
    $updateQuery = "UPDATE reg_user SET favorites = ? WHERE user_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ii", $newCount, $userId);
    $updateStmt->execute();

    return $newCount;
}
