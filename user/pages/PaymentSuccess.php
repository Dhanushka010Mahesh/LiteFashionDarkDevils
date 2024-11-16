<?php

    require('../includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php' ?>

<body>
  <!-- navbar -->
  <?php include_once '../includes/navbar.php' ?>

<?php
        if(isset($_SESSION['cus_Id'])){
            $cus_Id = $_SESSION['cus_Id'];
            try{    
                $select_and_insert="INSERT INTO order_items (OrderId, CartId, qty) SELECT OrderId,S_cartId, S_qty FROM cart as c , orders as o WHERE c.status_items = 'Pending' and o.O_status='Send to Admin' AND o.CustomerId = ? AND c.CustermerId = ? ";
                $All_insert_data_update="UPDATE cart SET status_items = 'Ordering' WHERE status_items = 'Pending' AND CustermerId = ? ";
                
                $execute_Insert=$connection->prepare($select_and_insert);
                $execute_Update=$connection->prepare($All_insert_data_update);

                $execute_Insert->execute([$cus_Id, $cus_Id]);
                $execute_Update->execute([$cus_Id]);
                echo "<script>alert('Recorded');</script>";
            } catch (PDOException $e) {
                echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
            }
        }

        
?>

    <h1>Payment Success</h1>



    
  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>
</body>
</html>