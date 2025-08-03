<?php
session_start();
ob_start();
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'] ?? '';
    $trend = $_POST['trend'] ?? '';
    $material = $_POST['material'] ?? '';
    $color = $_POST['color'] ?? '';
    $measurementOption = $_POST['measurementOption'] ?? '';
    $user_id = $_SESSION['user_id'] ?? null;

    if (empty($category) || empty($trend) || empty($material) || empty($color) || empty($measurementOption) || !$user_id) {
        echo "Please complete all fields and make sure you're logged in.";
        exit();
    }

    // Insert order
    $stmt = $conn->prepare("INSERT INTO orders (category, trend, material, color, measurement_option, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $category, $trend, $material, $color, $measurementOption, $user_id);

    if ($stmt->execute()) {
        if ($measurementOption === "provide") {
            header("Location: measurement.php?trend=" . urlencode($trend));
            exit();
        } elseif ($measurementOption === "homeVisit") {
            header("Location: homevisit.php");
            exit();
        } else {
            echo "Order placed successfully!";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

ob_end_flush();
?>
