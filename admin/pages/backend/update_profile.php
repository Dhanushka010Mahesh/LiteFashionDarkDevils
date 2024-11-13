<?php
session_start();
require_once '../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminId = $_SESSION['admin_id'];
    $fullname = $_POST['fullName'];
    $username = $_POST['username'];
    
    try {
        $sql = "UPDATE admins SET full_name = :fullname, username = :username WHERE admin_id = :adminId";
        $stmt = $connection->prepare($sql);
        
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':adminId', $adminId);
        
        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
