<?php
session_start();

// Function to generate random OTP
function generateOTP() {
    return rand(100000, 999999);
}

// Function to send OTP via SMS API (implement this function as per your SMS provider)
function sendOTP($mobileNumber, $otp) {
    // Example of sending OTP (you need to replace this with actual implementation)
    // $response = file_get_contents("https://smsapi.example.com/send?to=$mobileNumber&message=$otp");
    return true; // Assume the OTP is sent successfully
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobileNumber = $_POST['mobileNumber'];
    
    if (preg_match('/^\d{10}$/', $mobileNumber)) {
        $otp = generateOTP();
        $_SESSION['otp'] = $otp;
        $_SESSION['mobileNumber'] = $mobileNumber;

        if (sendOTP($mobileNumber, $otp)) {
            echo json_encode(['status' => 'success', 'message' => 'OTP sent successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send OTP']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid mobile number']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
