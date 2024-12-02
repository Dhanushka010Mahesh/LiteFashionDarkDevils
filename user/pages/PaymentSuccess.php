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
    if (isset($_SESSION['cus_Id'])) {
        $cus_Id = $_SESSION['cus_Id'];
        try {
            $select_and_insert = "INSERT INTO order_items (OrderId, CartId, qty) SELECT OrderId,S_cartId, S_qty FROM cart as c , orders as o WHERE c.status_items = 'Pending' and o.O_status='Send to Admin' AND o.CustomerId = ? AND c.CustermerId = ? ";
            $All_insert_data_update = "UPDATE cart SET status_items = 'Ordering' WHERE status_items = 'Pending' AND CustermerId = ? ";

            $execute_Insert = $connection->prepare($select_and_insert);
            $execute_Update = $connection->prepare($All_insert_data_update);

            $execute_Insert->execute([$cus_Id, $cus_Id]);
            $execute_Update->execute([$cus_Id]);
            echo "<script>alert('Recorded');</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    }


    ?>

    <section id="page-header" class="flex items-center justify-center text-center h-[410px]">
        <div class="flex flex-col py-10 px-20 text-center bg-green-100 mx-auto rounded-lg">
            <!-- Order completed text -->
            <h2 class="text-3xl font-semibold text-green-700 mb-4">Order Completed</h2>

            <!-- SVG Icon (Checkmark inside a rounded circle) -->
            <div class="w-20 h-20 rounded-full bg-green-700 flex items-center justify-center mb-4 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Payment Successful text -->
            <h1 class="text-4xl font-semibold text-green-700">Payment Successful</h1>
            <p class="text-green-600">Thank you for your order. Below are the details of your purchase.</p>
        </div>
    </section>





    <!-- footer -->
    <?php include_once '../includes/footer.php' ?>
</body>

</html>