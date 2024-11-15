<?php require_once ('../../includes/config.php'); ?>

<?php
if (!isset($_POST['delete'])) {
    echo "Update key not set";
} else {
    // Process the data
    $id = $_POST['id'];
    echo "<script>alert('invalid '+$id);</script>";
    $update=$connection->prepare("delete from cart where S_cartId='$id'");
    $update->execute();
}
?>