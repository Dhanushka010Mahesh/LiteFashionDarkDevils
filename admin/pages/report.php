<?php
require_once '../auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php'; ?>

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
            <p class="text-2xl text-green-600">Rs. 6,650</p>
          </div>
          <div>
            <p class="text-lg font-bold">Total Orders</p>
            <p class="text-2xl text-blue-600">01</p>
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

            <tr>
              <td class="border px-4 py-2">1</td>
              <td class="border px-4 py-2">Men's Alan T-Shirt</td>
              <td class="border px-4 py-2">1</td>
              <td class="border px-4 py-2">Rs. 3,250</td>
            </tr>
            <tr>
              <td class="border px-4 py-2">2</td>
              <td class="border px-4 py-2">Men's Casual Coat</td>
              <td class="border px-4 py-2">1</td>
              <td class="border px-4 py-2">Rs. 3,400</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>

    <!-- Download Report Button -->
    <div class="flex justify-end">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Download Report
      </button>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      console.log('Load reports dynamically using AJAX.');
    });

    function downloadReport() {
      alert('Report download initiated.');
    }

    document.querySelector('button').addEventListener('click', downloadReport);
  </script>
</body>

</html>