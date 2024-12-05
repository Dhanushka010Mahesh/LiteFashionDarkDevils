<?php
require_once '../auth_check.php';
require('../includes/config.php');

// Initialize variables
$totalSales = 0;
$totalOrders = 0;
$productReport = [];

try {
    // Fetch total sales and orders
    $salesQuery = "
        SELECT 
            SUM(oi.qty * cp.P_price) AS total_sales, 
            COUNT(DISTINCT o.OrderId) AS total_orders
        FROM orders o
        INNER JOIN order_items oi ON o.OrderId = oi.OrderId
        INNER JOIN cart c ON oi.CartId = c.S_cartId
        INNER JOIN clothproduct cp ON c.ProductId = cp.ProductId";
    $salesStmt = $connection->prepare($salesQuery);
    $salesStmt->execute();
    $salesResult = $salesStmt->fetch(PDO::FETCH_ASSOC);

    if ($salesResult) {
        $totalSales = $salesResult['total_sales'];
        $totalOrders = $salesResult['total_orders'];
    }

    // Fetch product report
    $productQuery = "
        SELECT 
            cp.ProductId,
            cp.P_name,
            SUM(oi.qty) AS units_sold,
            SUM(oi.qty * cp.P_price) AS revenue
        FROM order_items oi
        INNER JOIN cart c ON oi.CartId = c.S_cartId
        INNER JOIN clothproduct cp ON c.ProductId = cp.ProductId
        GROUP BY cp.ProductId, cp.P_name";
    $productStmt = $connection->prepare($productQuery);
    $productStmt->execute();
    $productReport = $productStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error fetching data: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php'; ?>
<!-- Add jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<body>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Reports</h1>

    <!-- Sales and Orders Report Section -->
    <div class="mb-6">
      <h2 class="text-xl font-semibold mb-3">Sales and Orders</h2>
      <div class="bg-white shadow-md rounded-md p-4">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-lg font-bold">Total Sales</p>
            <p class="text-2xl text-green-600">Rs. <?= number_format($totalSales, 2) ?></p>
          </div>
          <div>
            <p class="text-lg font-bold">Total Orders</p>
            <p class="text-2xl text-blue-600"><?= $totalOrders ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Report Section -->
    <div class="mb-6">
      <h2 class="text-xl font-semibold mb-3">Product Report</h2>
      <div class="bg-white shadow-md rounded-md p-4">
        <table class="min-w-full bg-white">
          <thead>
            <tr>
              <th class="py-2 px-4 bg-gray-800 text-white">Product ID</th>
              <th class="py-2 px-4 bg-gray-800 text-white">Product Name</th>
              <th class="py-2 px-4 bg-gray-800 text-white">Units Sold</th>
              <th class="py-2 px-4 bg-gray-800 text-white">Revenue</th>
            </tr>
          </thead>
          <tbody id="product-report-table">
            <?php if (!empty($productReport)): ?>
              <?php foreach ($productReport as $product): ?>
                <tr>
                  <td class="border px-4 py-2"><?= $product['ProductId'] ?></td>
                  <td class="border px-4 py-2"><?= htmlspecialchars($product['P_name']) ?></td>
                  <td class="border px-4 py-2"><?= $product['units_sold'] ?></td>
                  <td class="border px-4 py-2">Rs. <?= number_format($product['revenue'], 2) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="border px-4 py-2 text-center" colspan="4">No data available</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Download Report Button -->
    <div class="flex justify-end">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="downloadReport()">
        Download Report
      </button>
    </div>
  </div>

  <script>
    function downloadReport() {
      // Create new jsPDF instance
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();

      // Add title
      doc.setFontSize(18);
      doc.text('Sales Report', 14, 20);

      // Add total sales and orders
      doc.setFontSize(12);
      doc.text(`Total Sales: ${document.querySelector('.text-green-600').innerText}`, 14, 30);
      doc.text(`Total Orders: ${document.querySelector('.text-blue-600').innerText}`, 14, 40);

      // Get product report data
      const productTable = document.getElementById('product-report-table');
      const rows = Array.from(productTable.getElementsByTagName('tr'));
      
      const tableData = {
        head: [['Product ID', 'Product Name', 'Units Sold', 'Revenue']],
        body: rows.map(row => {
          const cells = Array.from(row.getElementsByTagName('td'));
          return cells.map(cell => cell.innerText);
        })
      };

      // Add product report table
      doc.setFontSize(14);
      doc.text('Product Report', 14, 50);
      
      doc.autoTable({
        startY: 55,
        head: tableData.head,
        body: tableData.body,
        theme: 'grid',
        styles: {
          fontSize: 10,
          cellPadding: 3
        },
        headStyles: {
          fillColor: [51, 51, 51],
          textColor: 255
        }
      });

      // Add footer
      const currentDate = new Date().toLocaleDateString();
      doc.setFontSize(10);
      doc.text(`Generated on: ${currentDate}`, 14, doc.internal.pageSize.height - 10);

      // Save the PDF
      doc.save('sales_report.pdf');
    }
  </script>
</body>

</html>
