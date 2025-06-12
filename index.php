<?php
include "app/config.php";
date_default_timezone_set('asia/calcutta');
$browser_t = "web";
$split = explode("?", $page_name);
// print_r($split);die;
if ($page_name == '') {
	$index = "active";
	// print_r($index);die;
	include $browser_t . '/index.php';
} elseif ($page_name == 'index') {
	$index = "active";
	include $browser_t . '/index.php';
} elseif ($page_name == 'privacy-policy') {
	$index = "active";
	include $browser_t . '/privacy-policy.php';
} elseif ($page_name == 'term-condition') {
	$index = "active";
	include $browser_t . '/term-condition.php';
} elseif ($page_name == 'faq') {
	$index = "active";
	include $browser_t . '/faq.php';
} elseif ($split[0] == 'packages') {
	$services = "active";
	include $browser_t . '/packages/index.php';
} elseif ($split[0] == 'destinations') {
	$services = "active";
	include $browser_t . '/destinations/index.php';
} elseif ($page_name == 'services') {
	$services = "active";
	include $browser_t . '/services.php';
} elseif ($page_name == 'booking') {
	$services = "active";
	include $browser_t . '/booking.php';
} elseif ($page_name == 'team') {
	$services = "active";
	include $browser_t . '/team.php';
} elseif ($page_name == 'testimonial') {
	$services = "active";
	include $browser_t . '/testimonial.php';
} elseif ($page_name == 'Gallery') {
	$gallery = "active";
	include $browser_t . '/gallery.php';
} elseif ($page_name == 'about') {
	$about = "active";
	include $browser_t . '/about.php';
} elseif ($split[0] == 'contact-submit') {
	$services = "active";
	// print_r($_POST);die;
	include __DIR__ . '/admin/action/contact.php';
} elseif ($split[0] == 'booking-submit') {
	$services = "active";
	// print_r($_POST);die;
	include __DIR__ . '/admin/action/contact.php';
} elseif ($split[0] == 'cab-booking-submit') {
	$services = "active";
	// print_r($_POST);die;
	include __DIR__ . '/admin/action/contact.php';
} elseif ($page_name == 'contact') {
	$contact = "active";
	include $browser_t . '/contact.php';
} elseif ($page_name == 'packages') {
	$contact = "active";
	include $browser_t . '/package.php';
} elseif ($page_name == 'kashmirfamilytour') {
	$contact = "active";
	include $browser_t . '/kashmirfamilytour.php';
} elseif ($page_name == 'srinagar') {
	$contact = "active";
	include $browser_t . '/srinagar.php';
} elseif ($page_name == 'tourpackages') {
	$contact = "active";
	include $browser_t . '/tourpackages.php';
} elseif ($page_name == 'hotelbookings') {
	$contact = "active";
	include $browser_t . '/hotelbookings.php';
} elseif ($page_name == 'cabs') {
	$contact = "active";
	include $browser_t . '/cabs.php';
} elseif ($page_name == 'trekkingservice') {
	$contact = "active";
	include $browser_t . '/trekkingservice.php';
} else {
	http_response_code(404);
	include $browser_t . '/404.php';
}
