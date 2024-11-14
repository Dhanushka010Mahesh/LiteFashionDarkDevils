<?php
require_once '../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $productId = $_POST['ProductId'];
        $P_name = $_POST['P_name'];
        $P_categoryId = $_POST['P_categoryId'];
        $P_price = $_POST['P_price'];
        $P_quantity = $_POST['P_quantity'];
        $P_description = $_POST['P_description'];
        $P_status = $_POST['P_status'];
        
        // Check if size checkboxes are set
        $P_small = isset($_POST['P_small']) ? 1 : 0;
        $P_medium = isset($_POST['P_medium']) ? 1 : 0;
        $P_large = isset($_POST['P_large']) ? 1 : 0;
        $P_extraLarge = isset($_POST['P_extraLarge']) ? 1 : 0;

        $sql = "UPDATE clothproduct SET P_name = :P_name, P_categoryId = :P_categoryId, P_price = :P_price, 
                P_quantity = :P_quantity, P_description = :P_description, P_status = :P_status,
                P_small = :P_small, P_medium = :P_medium, P_large = :P_large, P_extraLarge = :P_extraLarge
                WHERE ProductId = :ProductId";

        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':P_name', $P_name);
        $stmt->bindParam(':P_categoryId', $P_categoryId);
        $stmt->bindParam(':P_price', $P_price);
        $stmt->bindParam(':P_quantity', $P_quantity);
        $stmt->bindParam(':P_description', $P_description);
        $stmt->bindParam(':P_status', $P_status);
        $stmt->bindParam(':P_small', $P_small);
        $stmt->bindParam(':P_medium', $P_medium);
        $stmt->bindParam(':P_large', $P_large);
        $stmt->bindParam(':P_extraLarge', $P_extraLarge);
        $stmt->bindParam(':ProductId', $productId);

        if ($stmt->execute()) {
            echo "Product updated successfully.";
        } else {
            echo "Failed to update product.";
        }
    } catch (PDOException $e) {
        echo "Error updating product: " . $e->getMessage();
    }
}
?>
