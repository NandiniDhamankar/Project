<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['otp'];

    if ($otp == $_SESSION['otp']) {
        echo json_encode(['status' => 'success', 'message' => 'OTP verified successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid OTP']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
