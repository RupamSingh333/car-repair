<?php
include $_SERVER['DOCUMENT_ROOT'] . '/system_config.php';

$action = get_safe_get('action');
$url_return = $_SERVER['HTTP_REFERER'] ?? 'index.php'; // fallback

// pr($_POST);
// exit;
switch ($action) {
	case "save":
		$field = array();

		// Get the data ID (for update purposes)
		$primary_value = get_safe_post('data_id');

		// Fetch the existing data for the primary value to compare
		$existing_data = getcontact_byID($primary_value); // Assuming a function to fetch existing data by ID

		// Common fields for all forms
		$field['name'] = get_safe_post('name') ?: $existing_data['name'];
		$field['email'] = get_safe_post('email') ?: $existing_data['email'];
		$field['telephone'] = get_safe_post('telephone') ?: $existing_data['telephone'];
		$field['comment'] = get_safe_post('comment') ?: $existing_data['comment'];
		$field['destination_date_time'] = get_safe_post('destination_date_time') ?: date('Y-m-d H:i:s', strtotime($existing_data['destination_date_time']));
		$field['destination'] = get_safe_post('destination') ?: $existing_data['destination'];

		// Fields for booking or cab booking
		$field['hotel'] = get_safe_post('hotel') ?: $existing_data['hotel'];
		$field['rooms'] = get_safe_post('rooms') ?: $existing_data['rooms'];
		$field['nights_days'] = get_safe_post('nights_days') ?: $existing_data['nights_days'];

		$field['cab'] = get_safe_post('cab') ?: $existing_data['cab'];
		$field['days'] = get_safe_post('days') ?: $existing_data['days'];
		$field['status'] = get_safe_post('status'); // Example status for cab booking
		$field['form_type'] = get_safe_post('form_type'); // Example status for cab booking

		// Get form type (booking, contact, cab_booking)
		$form_type = get_safe_post('form_type');
		// pr($form_type);exit;
		// Conditional fields based on form type
		if ($form_type == 'cab_booking') {
			$_SESSION['msg'] = "Your cab booking has been successfully received. We will contact you shortly.";
		} elseif ($form_type == 'contact') {
			$_SESSION['msg'] = "Thank you for contacting us! We will get back to you as soon as possible.";
		} elseif ($form_type == 'hotel_booking') {
			$_SESSION['msg'] = "Your booking request has been successfully submitted. We will confirm your booking shortly.";
		} else {
			$_SESSION['msg'] = "Invalid form submission.";
			$_SESSION['msg_type'] = "danger"; // This could be an error if form_type is not valid
			break;
		}

		// pr($field);exit;

		// Save the updated data
		$output = save_command(tbl_contact, $field, "contactus_id", $primary_value);
		$_SESSION['msg_type'] = "success"; // Set message type to success if save command is successful

		break;

	case "del":
		$primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output = del_command(tbl_contact, "contactus_id", $primary_value, false);
		$_SESSION['msg'] = $output;
		$_SESSION['msg_type'] = "success";
		break;

	case "status":
		if (isset($_GET['id'])) {
			$id = urlencode(decryptIt($_GET['id']));
			$row = getcontact_byID($id);
			$st = $row['status'];
		}
		$status = ($st == "0") ? 1 : 0;
		$field['status'] = $status;
		$primary_value = $id;
		$output = save_command(tbl_contact, $field, "contactus_id", $primary_value);
		$_SESSION['msg'] = $output;
		$_SESSION['msg_type'] = "success";
		break;

	default:
		$_SESSION['msg'] = "Invalid action specified.";
		$_SESSION['msg_type'] = "danger"; // Set message type to error if action is invalid
		break;
}

header("Location: " . $url_return);
exit;
