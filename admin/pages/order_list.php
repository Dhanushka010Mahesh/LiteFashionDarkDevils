<?php
require_once '../auth_check.php';
require('../includes/config.php');

// Fetch orders with details from the database
$query = "
  SELECT 
    o.OrderId,
    o.CustomerId,
    o.O_fullName,
    o.O_emailAddress,
    o.O_street,
    o.O_city,
    o.O_province,
    o.O_zip_code,
    o.O_country,
    o.O_phone_number,
    o.O_payment_method,
    o.O_status,
    oi.qty AS order_qty,
    c.ProductId,
    c.P_name,
    c.P_price,
    c.P_image1,
    cp.P_categoryId,
    cp.P_quantity AS product_quantity,
    cp.P_image2,
    cp.P_image3,
    cp.P_image4,
    cp.P_description,
    cp.P_small,
    cp.P_medium,
    cp.P_large,
    cp.P_extraLarge,
    cp.P_status AS product_status
  FROM orders o
  JOIN order_items oi ON o.OrderId = oi.OrderId
  JOIN cart c ON oi.CartId = c.S_cartId
  JOIN clothproduct cp ON c.ProductId = cp.ProductId
";

$OrdersList = $connection->query($query);
$OrdersList->execute();
$allOrderList = $OrdersList->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Details - Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">
  <div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Order Details</h1>

    <!-- Orders List -->
    <?php foreach ($allOrderList as $order) : ?>
      <div class="bg-white rounded-lg border border-gray-300 shadow-md p-6 mb-6">
        <!-- Order Header -->
        <div class="flex justify-between items-center">
          <h2 class="text-lg font-semibold text-gray-800">Order #<?php echo $order->OrderId; ?> - <?php echo $order->O_fullName; ?></h2>
          <div class="flex space-x-2">
            <button
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm transition"
              onclick="toggleOrderDetails('details-<?php echo $order->OrderId; ?>')">
              View Details
            </button>
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm transition">Cancel</button>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4 text-sm text-gray-700">
          <div>
            <p class="mb-1.5"><strong>Email:</strong> <?php echo $order->O_emailAddress; ?></p>
            <p class="mb-1.5"><strong>Phone:</strong> <?php echo $order->O_phone_number; ?></p>
            <p class="mb-1.5"><strong>Payment Method:</strong> <?php echo $order->O_payment_method; ?></p>
            <p class="mb-1.5"><strong>Status:</strong>
              <select
                class="px-2 py-1 rounded text-white cursor-pointer focus:outline-none 
                <?php echo ($order->O_status === 'Completed') ? 'bg-green-500' : 'bg-sky-500'; ?>"
                onchange="updateOrderStatus(<?php echo $order->OrderId; ?>, this.value)">
                <option value="Send to Admin" <?php echo ($order->O_status === 'Send to Admin') ? 'selected' : ''; ?>>Send to Admin</option>
                <option value="Processing" <?php echo ($order->O_status === 'Processing') ? 'selected' : ''; ?>>Processing</option>
                <option value="Shipped" <?php echo ($order->O_status === 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
                <option value="Completed" <?php echo ($order->O_status === 'Completed') ? 'selected' : ''; ?>>Completed</option>
              </select>
            </p>
          </div>
          <div>
            <p><strong>Address:</strong></p>
            <p><?php echo $order->O_street; ?></p>
            <p><?php echo $order->O_city; ?>, <?php echo $order->O_province; ?></p>
            <p><?php echo $order->O_country; ?> - <?php echo $order->O_zip_code; ?></p>
          </div>
        </div>

        <!-- Order Details -->
        <div id="details-<?php echo $order->OrderId; ?>" class="hidden mt-6">
          <h3 class="text-md font-semibold text-gray-600 mb-4">Product Details</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="border rounded-lg p-4 flex items-center space-x-4 bg-gray-50">
              <div>
                <p class="font-semibold"><?php echo $order->P_name; ?></p>
                <p class="text-sm text-gray-600"><strong>ID:</strong> <?php echo $order->ProductId; ?></p>
                <p class="text-sm text-gray-600"><strong>Price:</strong> Rs. <?php echo $order->P_price; ?></p>
                <p class="text-sm text-gray-600"><strong>Quantity:</strong> <?php echo $order->order_qty; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <script>
    function toggleOrderDetails(orderId) {
      const details = document.getElementById(orderId);
      details.classList.toggle('hidden');
    }

    function updateOrderStatus(orderId, status) {
      fetch(`update_order_status.php?orderId=${orderId}&status=${status}`, {
          method: 'GET',
        })
        .then(response => response.text())
        .then(data => {
          alert('Order status updated successfully!');
        })
        .catch(error => {
          alert('Error updating order status.');
          console.error('Error:', error);
        });
    }
  </script>
</body>

</html>