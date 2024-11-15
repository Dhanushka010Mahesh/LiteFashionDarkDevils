<?php require_once ('../../includes/config.php'); ?>

<?php
if (!isset($_POST['update'])) {
    echo "Update key not set";
} else {
    // Process the data
    $id = $_POST['id'];
    $pro_qty = $_POST['pro_qty'];

    $update=$connection->prepare("update cart set S_qty='$pro_qty' where S_cartId='$id'");
    $update->execute();
}
?>
