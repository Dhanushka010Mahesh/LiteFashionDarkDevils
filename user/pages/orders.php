<?php
require_once '../includes/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php'; ?>

<body>
  <!-- navbar -->
  <?php include_once '../includes/navbar.php'; ?>

  <!-- page header -->
  <section
    id="page-header-about"
    class="flex flex-col py-0 px-20 text-center justify-center">
    <h1 class="text-6xl font-semibold text-white/90 p-3">My Orders</h1>
    <p class="text-white/80">Track your orders and view order details.</p>
  </section>

  <?php
  // Check if the user is logged in
  if (!isset($_SESSION['cus_Id'])) {
    echo "Please log in to view your orders.";
    exit();
  }

  $customerId = $_SESSION['cus_Id'];

  try {
    // Fetch orders for the logged-in user
    $orderQuery = "
    SELECT 
        o.OrderId, 
        o.O_fullName, 
        o.O_status, 
        o.O_payment_method,
        SUM(oi.qty * cp.P_price) AS total_order_amount
    FROM 
        orders o
    JOIN 
        order_items oi ON o.OrderId = oi.OrderId
    JOIN 
        cart c ON oi.CartId = c.S_cartId
    JOIN 
        clothproduct cp ON c.ProductId = cp.ProductId
    WHERE 
        o.CustomerId = :customerId
    GROUP BY 
        o.OrderId, 
        o.O_fullName, 
        o.O_status, 
        o.O_payment_method
    ORDER BY 
        o.OrderId DESC
    ";

    $orderStmt = $connection->prepare($orderQuery);
    $orderStmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
    $orderStmt->execute();
    $orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);

    // Function to fetch order items
    function getOrderItems($connection, $orderId)
    {
      $itemQuery = "
        SELECT 
            cp.ProductId,
            cp.P_name, 
            cp.P_image1,
            oi.qty, 
            cp.P_price
        FROM 
            order_items oi
        JOIN 
            cart c ON oi.CartId = c.S_cartId
        JOIN 
            clothproduct cp ON c.ProductId = cp.ProductId
        WHERE 
            oi.OrderId = :orderId
        ";

      $itemStmt = $connection->prepare($itemQuery);
      $itemStmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
      $itemStmt->execute();
      return $itemStmt->fetchAll(PDO::FETCH_ASSOC);
    }
  } catch (PDOException $e) {
    echo "Error fetching orders: " . $e->getMessage();
    exit();
  }
  ?>

  <!-- Orders List -->
  <section class="py-10 px-20">
    <div class="flex flex-col gap-6">
      <?php if (empty($orders)): ?>
        <div class="text-center text-gray-500">
          No orders found.
        </div>
      <?php else: ?>
        <?php foreach ($orders as $order): ?>
          <!-- Single Order -->
          <div class="p-6 border border-gray-300 rounded-lg shadow-sm">
            <div class="flex justify-between mb-4">
              <div class="text-lg font-semibold text-sky-600">Order #<?php echo htmlspecialchars($order['OrderId']); ?></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <?php
              $orderItems = getOrderItems($connection, $order['OrderId']);
              foreach ($orderItems as $item):
              ?>
                <!-- Order Item -->
                <div class="flex items-center gap-4">
                  <img
                    src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo htmlspecialchars($item['P_image1'], ENT_QUOTES, 'UTF-8'); ?>"
                    alt="<?php echo htmlspecialchars($item['P_name'], ENT_QUOTES, 'UTF-8'); ?>"
                    width="60px"
                    class="mb-1"
                    id="main-image" />
                  <div>
                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($item['P_name']); ?></p>
                    <p class="text-gray-500">Quantity: <?php echo htmlspecialchars($item['qty']); ?></p>
                    <p class="text-gray-500">Price: Rs.<?php echo number_format($item['P_price'], 2); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="flex justify-between mt-6">
              <div>
                <p class="text-lg font-semibold">Total: Rs.<?php echo number_format($order['total_order_amount'], 2); ?></p>
              </div>
              <div class="
                <?php
                switch ($order['O_status']) {
                  case 'Processing':
                    echo 'text-yellow-500';
                    break;
                  case 'Shipped':
                    echo 'text-blue-500';
                    break;
                  case 'Delivered':
                    echo 'text-green-500';
                    break;
                  default:
                    echo 'text-gray-500';
                }
                ?> 
                font-semibold"><?php echo htmlspecialchars($order['O_status']); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>

  <!-- footer -->
  <?php include_once '../includes/footer.php'; ?>

  <script src="../layout/js/script.js"></script>
</body>

</html>