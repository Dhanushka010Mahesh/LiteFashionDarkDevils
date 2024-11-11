<?php
session_start();

require_once '../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitACC'])) {
        // Handle Signup
        $fullName = trim($_POST['fname']);
        $userName = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Check if the email already exists
        $checkEmailQuery = "SELECT email FROM admins WHERE email = :email";
        $stmt = $connection->prepare($checkEmailQuery);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "An account with this email already exists. Please try logging in or use a different email.";
        } else {
            // Password hashing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the data into the admins table
            $sql = "INSERT INTO admins (full_name, username, email, password) 
                    VALUES (:fullName, :userName, :email, :password)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':fullName', $fullName);
            $stmt->bindParam(':userName', $userName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                echo "Account created successfully! <a href='http://localhost/LiteFashionDarkDevils/admin/index.php'>Log in here</a>";
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        }
    } elseif (isset($_POST['submitLogin'])) {
        // Handle Login
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Query to fetch admin data
        $sql = "SELECT * FROM admins WHERE email = :email";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify password
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_name'] = $admin['username'];

                header("Location: http://localhost/LiteFashionDarkDevils/admin/dashboard.php");
                exit();
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No account found with that email!";
        }
    }
}

$connection = null;
