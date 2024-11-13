<?php
session_start();

require __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

include '../../includes/config.php';

try {
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['submitACC'])) {
        $fullName = $_POST['fullName'];
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $checkUser = $conn->prepare("SELECT * FROM customers WHERE C_email = :email");
        $checkUser->bindParam(":email", $email);
        $checkUser->execute();

        if ($checkUser->rowCount() == 0) {
            $otpCode = rand(100000, 999999);

            $insertUser = $conn->prepare(
                "INSERT INTO customers (C_fullname, C_username, C_email, C_hashpassword, otp_code) VALUES (:fullName, :userName, :email, :password, :otpCode)"
            );
            $insertUser->bindParam(":fullName", $fullName);
            $insertUser->bindParam(":userName", $userName);
            $insertUser->bindParam(":email", $email);
            $insertUser->bindParam(":password", $password);
            $insertUser->bindParam(":otpCode", $otpCode);

            if ($insertUser->execute()) {
                // Send OTP
                $resendApiKey = $_ENV['RESEND_API_KEY'];

                $resend = Resend::client($resendApiKey);

                try {
                    $resend->emails->send([
                        'from' => 'litefashion@zhake.live',
                        'to' => [$email],
                        'subject' => 'Account Verification - Your OTP Code',
                        'html' => '<strong>Your OTP Code is: ' . $otpCode . '</strong>',
                    ]);
                } catch (Exception $e) {
                    error_log("Email sending failed: " . $e->getMessage());
                    echo "Failed to send verification email. Please try again later.";
                    exit();
                }

                $_SESSION['email'] = $email;
                header('Location: signup_verify_otp_form.php');
                exit();
            } else {
                echo "Error: " . $insertUser->errorInfo()[2];
            }
        } else {
            echo "Email already exists.";
        }
    }

    // OTP Verification process
    if (isset($_POST['SubmitOTP'])) {
        $otpCode = $_POST['otpCode'];
        $email = $_SESSION['email'];

        // Check OTP
        $checkOTP = $conn->prepare(
            "SELECT * FROM customers WHERE C_email = :email AND otp_code = :otpCode AND is_verified = 0"
        );
        $checkOTP->bindParam(":email", $email);
        $checkOTP->bindParam(":otpCode", $otpCode);
        $checkOTP->execute();

        if ($checkOTP->rowCount() > 0) {
            // Update the user as verified
            $updateUser = $conn->prepare("UPDATE customers SET is_verified = 1 WHERE C_email = :email");
            $updateUser->bindParam(":email", $email);

            if ($updateUser->execute()) {
                header('Location: http://localhost/LiteFashionDarkDevils/user/');
                exit();
            } else {
                echo "Error: " . $updateUser->errorInfo()[2];
            }
        } else {
            echo "Invalid OTP or the account is already verified.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
