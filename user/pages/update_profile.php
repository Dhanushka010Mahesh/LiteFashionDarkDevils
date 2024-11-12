<?php
include_once '../includes/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerId = $_SESSION['custormerId'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];

    $sql = "UPDATE customers SET C_fullname = :fullname, C_username = :username, C_mobile = :phone WHERE CustermerId = :customerId";
    $stmt = $connection->prepare($sql);

    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':customerId', $customerId);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile.";
    }
}
