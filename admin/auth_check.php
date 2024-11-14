<?php
session_start();

// Check admin logged in or not
if (!isset($_SESSION['admin_id'])) {
    header("Location: http://localhost/LiteFashionDarkDevils/admin/index.php");
    exit();
}
