<?php
include("../../system_config.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user ID is set in session
if (!isset($_SESSION['userid'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Get user ID from session
$user_id = $_SESSION['userid'];

// Get action from POST data
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

// Initialize response array
$response = ['status' => 'error', 'message' => 'Invalid action'];

// Define the fields and table
$fields = ['views' => 'view', 'favorites' => 'favorites', 'shares' => 'share'];
$table = 'reg_user';

if (array_key_exists($action, $fields)) {
    $field = $fields[$action];

    // Increment the field in the database
    $sql = "UPDATE $table SET $field = $field + 1 WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        if ($stmt->execute()) {
            // Get the new count
            $sql = "SELECT $field FROM $table WHERE user_id = ?";
            $stmt = $mysqli->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $stmt->bind_result($new_count);
                $stmt->fetch();

                // Update the response array
                $response = ['status' => 'success', 'new_count' => $new_count];
            }
            $stmt->close();
        } else {
            $response['message'] = 'Failed to execute update statement: ' . $stmt->error;
        }
    } else {
        $response['message'] = 'Failed to prepare statement: ' . $mysqli->error;
    }
} else {
    $response['message'] = 'Invalid action specified.';
}

// Return the response as JSON
echo json_encode($response);

