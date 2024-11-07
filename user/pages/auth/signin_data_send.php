<?php
session_start();

include '../../includes/config.php';

try {
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SESSION['username'])) {
        echo "<script> window.location.href='http://localhost/LiteFashionDarkDevils/user/'; </script>";
        exit;
    }

    if (isset($_POST['submit'])) {
        if (empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
            echo "<script>alert('Missing value');</script>";
        } else {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

            $sql = "SELECT * FROM customers WHERE C_email = :email AND is_verified = 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $user['C_hashpassword'])) {
                    $_SESSION['username'] = $user['C_username'];
                    $_SESSION['email'] = $user['C_email'];
                    $_SESSION['mobile'] = $user['C_mobile'];
                    $_SESSION['address'] = $user['C_address'];
                    $_SESSION['image'] = $user['C_image'];
                    $_SESSION['custormerId'] = $user['CustermerId'];
                    $_SESSION['full_name'] = $user['C_fullname'];

                    if (isset($_POST['remember'])) {
                        setcookie('user_email', $email, time() + (86400 * 30), "/");
                    }

                    echo "<script> window.location.href='http://localhost/LiteFashionDarkDevils/user/'; </script>";
                    exit;
                } else {
                    echo "<script>
                        alert('Invalid email or password.');
                        window.location.href='http://localhost/LiteFashionDarkDevils/user/';
                    </script>";
                }
            } else {
                echo "<script>alert('Account does not exist or is not verified.');
                window.location.href='http://localhost/LiteFashionDarkDevils/user/';
                </script>";
            }
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
