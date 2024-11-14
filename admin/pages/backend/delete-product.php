<?php
require_once '../../includes/config.php';

if (isset($_POST['ProductId'])) {
    $productId = $_POST['ProductId'];

    try {
        // First delete related entries in `cart`
        $stmt = $connection->prepare("DELETE FROM cart WHERE ProductId = :ProductId");
        $stmt->bindParam(':ProductId', $productId, PDO::PARAM_STR);
        $stmt->execute();

        // Then delete the product in `clothproduct`
        $stmt = $connection->prepare("DELETE FROM clothproduct WHERE ProductId = :ProductId");
        $stmt->bindParam(':ProductId', $productId, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Product deleted successfully.";
        } else {
            echo "Failed to delete product.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>



