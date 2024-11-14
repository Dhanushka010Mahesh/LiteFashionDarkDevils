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
            <p class="text-lg font-bold">Total Sales:</p>
            <p class="text-2xl text-green-600">Rs. 15,200</p>
          </div>
          <div>
            <p class="text-lg font-bold">Total Orders:</p>
            <p class="text-2xl text-blue-600">120</p>
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
              <td class="border px-4 py-2">Wireless Headphones</td>
              <td class="border px-4 py-2">50</td>
              <td class="border px-4 py-2">Rs. 2,500</td>
            </tr>
            <tr>
              <td class="border px-4 py-2">2</td>
              <td class="border px-4 py-2">Smartwatch</td>
              <td class="border px-4 py-2">75</td>
              <td class="border px-4 py-2">Rs. 3,750</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>

    <!-- Feedback Report Section -->
    <div class="mb-6">
      <h2 class="text-xl font-semibold mb-3">Customer Feedback</h2>
      <div class="bg-white shadow-md rounded-md p-4">
        <p>Total Feedback Received: <span class="text-blue-600 font-bold">85</span></p> <!-- Placeholder -->
        <p>Positive Feedback: <span class="text-green-600 font-bold">60</span></p> <!-- Placeholder -->
        <p>Negative Feedback: <span class="text-red-600 font-bold">25</span></p> <!-- Placeholder -->
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