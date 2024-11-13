<?php
include_once '../includes/config.php';

session_start();

if (!isset($_SESSION['username'])) {
    die("Error: User is not logged in.");
}

$userData = $connection->query("SELECT * FROM customers WHERE CustermerId='{$_SESSION['custormerId']}'");
$userData->execute();

$allUserData = $userData->fetchAll(PDO::FETCH_OBJ);
$custermer_id = $allUserData[0]->CustermerId; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];

    $sql = "UPDATE delivery_address
            SET first_name = :first_name, last_name = :last_name, street = :street, city = :city,
                state = :state, zip_code = :zip_code, country = :country, phone = :phone
            WHERE CustermerId = :custermer_id";

    $stmt = $connection->prepare($sql);

    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':zip_code', $zip_code);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':custermer_id', $custermer_id);

    if ($stmt->execute()) {
        echo "Address updated successfully!";
    } else {
        echo "Error updating address: " . implode(" ", $stmt->errorInfo());
    }
}
