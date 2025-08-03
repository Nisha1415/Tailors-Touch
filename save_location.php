<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in.");
}

$user_id = $_SESSION['user_id'];

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tailorstouchdb";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$gender = $_POST['gender'];
$time_slot = $_POST['time_slot'];
$address_option = $_POST['address_option'];
$delivery_address = isset($_POST['delivery_address']) ? $_POST['delivery_address'] : "";

// Determine address to save
if ($address_option === "same") {
    // Get default address from users table
    $sql = "SELECT address FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($saved_address);
    $stmt->fetch();
    $stmt->close();
    $final_address = $saved_address;
} else {
    $final_address = $delivery_address;
}

// Insert into homevisits table
$sql = "INSERT INTO homevisits (user_id, gender, time_slot, address) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $gender, $time_slot, $final_address);

if ($stmt->execute()) {
    echo "<script>alert('Home visit scheduled successfully.'); window.location.href='trendsnext.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
