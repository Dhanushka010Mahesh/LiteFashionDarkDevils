<?php
require_once '../../includes/config.php';

if (isset($_POST['P_name'])) {
    try {
        $productName = $_POST['P_name'];
        $categoryId = $_POST['P_categoryId'];
        $price = $_POST['P_price'];
        $quantity = $_POST['P_quantity'];
        $description = $_POST['P_description'];
        $status = $_POST['P_status'];

        // Sizes - check if selected
        $small = isset($_POST['P_small']) ? '1' : 0;
        $medium = isset($_POST['P_medium']) ? '1' : 0;
        $large = isset($_POST['P_large']) ? '1' : 0;
        $extraLarge = isset($_POST['P_extraLarge']) ? '1' : 0;

        //  image uploads
        $imagePaths = ['P_image1.jpg', 'P_image2.jpg', 'P_image3.jpg', 'P_image4.jpg'];
        for ($i = 1; $i <= 4; $i++) {
            $imageKey = 'P_image' . $i;
            if (isset($_FILES[$imageKey]) && $_FILES[$imageKey]['error'] === UPLOAD_ERR_OK) {
                $imageName = basename($_FILES[$imageKey]['name']);
                $targetFilePath = '../../uploads/' . $imageName;
                if (move_uploaded_file($_FILES[$imageKey]['tmp_name'], $targetFilePath)) {
                    $imagePaths[$i - 1] = $imageName; // Update image path in the array
                } else {
                    echo "Error uploading image $i.";
                }
            }
        }

        $stmt = $connection->prepare("INSERT INTO clothproduct 
            (P_name, P_categoryId, P_price, P_quantity, P_image1, P_image2, P_image3, P_image4, 
             P_description, P_small, P_medium, P_large, P_extraLarge, P_status) 
            VALUES (:name, :category_id, :price, :quantity, :image1, :image2, :image3, :image4, 
             :description, :small, :medium, :large, :extra_large, :status)");

        $stmt->bindParam(':name', $productName);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':image1', $imagePaths[0]);
        $stmt->bindParam(':image2', $imagePaths[1]);
        $stmt->bindParam(':image3', $imagePaths[2]);
        $stmt->bindParam(':image4', $imagePaths[3]);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':small', $small);
        $stmt->bindParam(':medium', $medium);
        $stmt->bindParam(':large', $large);
        $stmt->bindParam(':extra_large', $extraLarge);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            echo "Product added successfully.";
        } else {
            echo "Failed to add product.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
