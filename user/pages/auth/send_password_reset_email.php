<?php
require __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

include '../../includes/config.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    try {
        $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM customers WHERE C_email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $otpCode = rand(100000, 999999);

            $sql = "UPDATE customers SET otp_code = :otp_code WHERE C_email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':otp_code', $otpCode, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                require __DIR__ . '/../../vendor/autoload.php';
                $resendApiKey = $_ENV['RESEND_API_KEY'];
                $resend = Resend::client($resendApiKey);

                $resend->emails->send([
                    'from' => 'charith@zhake.live',
                    'to' => [$email],
                    'subject' => 'Password Reset - Your OTP Code',
                    'html' => '<strong>Your OTP Code is: ' . $otpCode . '</strong>',
                ]);

                header("Location: enter_password_reset_otp.php?email=" . urlencode($email));
                exit;
            } else {
                echo "Error updating OTP.";
            }
        } else {
            echo "Email not found.";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
