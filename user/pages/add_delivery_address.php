<?php
include_once '../includes/config.php';
session_start();

if (!isset($_SESSION['username'])) {
    die("Error: User is not logged in.");
}

$username = $_SESSION['username'];
$query = "SELECT CustermerId FROM customers WHERE C_username = :username";
$stmt = $connection->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    die("Error: Could not retrieve user data.");
}

$custermer_id = $result['CustermerId'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];

    try {
        $sql = "INSERT INTO delivery_address (CustermerId, first_name, last_name, street, city, state, zip_code, country, phone)
            VALUES (:custermer_id, :first_name, :last_name, :street, :city, :state, :zip_code, :country, :phone)";

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':custermer_id', $custermer_id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':zip_code', $zip_code);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':phone', $phone);

        if ($stmt->execute()) {
            echo "Address added successfully!";
        } else {
            echo "Error adding address.";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "You already have address. Go to profile and update your existing address.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
