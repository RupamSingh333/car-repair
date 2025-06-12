<?php
print_r($_POST);die;
include("../system_config.php");

// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function handleFileUpload($fileKey, $columnName, $userId) {
    global $link, $config;

    if (!empty($_FILES[$fileKey]["name"]) && $_FILES[$fileKey]["error"] == 0) {
        $getUserByID = getuser_byID($userId);
        $customerNameWithoutSpacesLowercase = strtolower(str_replace(' ', '', $getUserByID['first_name']));
        $phone = empty($getUserByID['user_phone']) ? 'NoPhone' : $getUserByID['user_phone'];
        $imageName = $customerNameWithoutSpacesLowercase . '_' . $phone;

        $file_name = $_FILES[$fileKey]["name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $user_img_name = $imageName . '_' . time() . '_' . $fileKey . "." . $file_ext;
        $path = '../' . $config['image'] . $user_img_name;

        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $path)) {
            // Remove the old image if it exists
            if (!empty($getUserByID[$columnName])) {
                unlink('../' . $config['image'] . $getUserByID[$columnName]);
            }
            $update_sql = "UPDATE customer SET $columnName = ? WHERE user_id = ?";
            $update_stmt = mysqli_prepare($link, $update_sql);
            mysqli_stmt_bind_param($update_stmt, 'si', $user_img_name, $userId);
            mysqli_stmt_execute($update_stmt);
        } else {
            error_log("File upload error for user ID: $userId");
        }
    }
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user ID
    $userId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;
    if ($userId) {
        $userExist = getuser_byID($userId);
        if (!$userExist) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Invalid User ID']);
            exit;
        }
    }

    // Validate and sanitize input fields
    $first_name = sanitizeInput($_POST['first_name']);
    $email = sanitizeInput($_POST['user_email']);
    $phone = sanitizeInput($_POST['user_phone']);
    $user_country = sanitizeInput($_POST['user_country']);
    $user_state = sanitizeInput($_POST['user_state']);
    $user_district = sanitizeInput($_POST['user_district']);
    $user_address = sanitizeInput($_POST['user_address']);
    $user_pincode = sanitizeInput($_POST['user_pincode']);
    $password = sanitizeInput($_POST['user_pass']);
    $hashed_password = !empty($password) ? encryptIt($password) : null;

    // Prepare and execute SQL query
    if ($userId) {
        $sql = "UPDATE reg_user SET first_name=?, user_email=?, user_phone=?, user_country=?, user_state=?, user_district=?, user_address=?, user_pincode=?";
        if ($hashed_password) {
            $sql .= ", user_pass=?";
        }
        $sql .= " WHERE user_id=?";
        $stmt = mysqli_prepare($link, $sql);

        if ($hashed_password) {
            mysqli_stmt_bind_param($stmt, 'sssssssisi', $first_name, $email, $phone, $user_country, $user_state, $user_district, $user_address, $user_pincode, $hashed_password, $userId);
        } else {
            mysqli_stmt_bind_param($stmt, 'ssssssssi', $first_name, $email, $phone, $user_country, $user_state, $user_district, $user_address, $user_pincode, $userId);
        }
    } else {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'User ID is required']);
        exit();
    }

    if (!mysqli_stmt_execute($stmt)) {
        $error_message = mysqli_error($link); // Get the error message
        error_log("SQL Error: $error_message"); // Log the error
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'Update failed. ' . $error_message]);
        exit();
    }

    // Handle file upload
    if (!empty($_FILES['user_logo']['name'])) {
        handleFileUpload("user_logo", "user_logo", $userId);
    }

    // Respond with success message and redirect URL
    $response = ['status' => true, 'message' => 'Your profile has been updated successfully.', 'redirect' => 'profile.php'];
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
