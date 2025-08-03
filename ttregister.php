<?php
session_start();

// Database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    
    

    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User already exists
        $_SESSION['message'] = "User already exists. Please log in.";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, address,phone) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param("sssss", $fullName, $email, $password, $address,$phone);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful! You can now log in.";
        } else {
            $_SESSION['message'] = "Registration failed! Please try again.";
        }
    }
    header("Location:signupsignin.php ");
    $stmt->close();
    $conn->close();
    exit();
}
?>
