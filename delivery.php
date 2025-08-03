<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailorstouchdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from session
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("User not logged in.");
}

// Get form data
$description = $_POST['description'] ?? '';
$delivery_option = $_POST['homedelivery'] ?? '';

if (empty($delivery_option)) {
    die("Please select a delivery option.");
}

// Handle file upload
$image_path = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = basename($_FILES['image']['name']);
    $targetFile = $targetDir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $image_path = $targetFile;
    } else {
        die("Failed to upload image.");
    }
}

// Insert into customize table
$stmt = $conn->prepare("INSERT INTO customize (user_id, order_id, description, image_path, delivery_option) VALUES (?, ? ,?, ?, ?)");
$stmt->bind_param("issss", $user_id, $order_id, $description, $image_path, $delivery_option);

if ($stmt->execute()) {
    echo "Customization saved successfully!";
    header("Location: confirmation.php?order_id=" . $conn->insert_id);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
