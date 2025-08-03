<?php
session_start(); // Optional: if you want to use session for user ID

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tailorstouch";

// Connect to DB
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form values
$description = $_POST['description'] ?? '';
$delivery_option = $_POST['homedelivery'] ?? '';
$user_id = $_GET['user_id'] ?? 0; // or $_SESSION['user_id'] if using login system

// Image processing
$imageData = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
}

// Prepare insert query
$stmt = $conn->prepare("INSERT INTO customize (description, image, delivery_option) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $description, $null, $delivery_option);
$stmt->send_long_data(1, $imageData);

if ($stmt->execute()) {
    // Redirect to confirmation.php with user_id
    header("Location: confirmation.php?user_id=$user_id");
    exit();
} else {
    echo "<h2 style='color: red;'>Error: " . $stmt->error . "</h2>";
}

$stmt->close();
$conn->close();
?>
