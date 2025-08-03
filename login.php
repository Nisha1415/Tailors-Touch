<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Admin login check
    $admin_email = "admin@gmail.com";
    $admin_password = "admin123";

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['user_name'] = "Admin"; 
        header("Location: admin.php");
        exit();
    }

    // Query to fetch user data
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Since you're using plain text, compare directly
        if ($password === $user['password']) { 
            // ✅ Store all necessary user data in session
            $_SESSION['user_id'] = $user['user_id'];       // Needed for order insert
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_email'] = $user['email']; 

            header("Location: trends.html");
            exit();
        } else {
            $_SESSION['message'] = "Invalid password!";
            header("Location: signupsignin.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "User not found. Please register.";
        header("Location: signupsignin.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
