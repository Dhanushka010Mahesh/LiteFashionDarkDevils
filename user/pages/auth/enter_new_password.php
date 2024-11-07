<?php
include '../../includes/config.php';

$message = '';

if (isset($_GET['email']) && isset($_POST['new_password'])) {
    $email = $_GET['email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    try {
        $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE customers SET C_hashpassword = :new_password, otp_code = NULL WHERE C_email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':new_password', $new_password);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $message = "Password reset successfully.<br> <a href='http://localhost/LiteFashionDarkDevils/user/' class='text-blue-600 underline'>Go to Home Page</a>";
        } else {
            $message = "Error updating password.";
        }
    } catch (PDOException $e) {
        $message = "Connection failed: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="text-center bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6">Reset Password</h1>
        <form action="" method="POST" class="space-y-4">
            <input type="password" name="new_password" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Enter new password" required>
            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 py-3 px-6 rounded-lg font-medium">Reset Password</button>
        </form>
        <?php if (!empty($message)): ?>
            <div class="mt-4 text-gray-700">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
