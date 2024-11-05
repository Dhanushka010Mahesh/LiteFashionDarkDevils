<?php
session_start(); // Start session
session_unset(); // Remove all session variables
session_destroy();// Destroy the session

// Redirect to the login page after logging out
echo "<script> window.location.href='http://localhost/LiteFashionDarkDevils/user/'; </script>";
exit();
