<!DOCTYPE html>
<html lang="en">

<!-- header -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lite Fashion Admin Panel</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="../layout/css/styles.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .content {
      display: none;
    }

    .active {
      display: block;
    }
  </style>
</head>

<body>
  <hr />
  <!-- Initial Display Section -->
  <div id="displayContent" class="content active">
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Order List</h1>

      <!-- Order List Table -->
      <div class="bg-white shadow-md rounded-md overflow-hidden">
        <table class="min-w-full bg-white">
          <thead>
            <tr>
              <th class="py-2 px-4 bg-gray-800 text-white">Order ID</th>
              <th class="py-2 px-4 bg-gray-800 text-white">Customer</th>
              <th class="py-2 px-4 bg-gray-800 text-white">Total Amount</th>
              <th class="py-2 px-4 bg-gray-800 text-white">Status</th>
              <th class="py-2 px-4 bg-gray-800 text-white">Actions</th>
            </tr>
          </thead>
          <tbody id="order-table-body">
            <tr>
              <td class="border px-4 py-2">101</td>
              <td class="border px-4 py-2">John Doe</td>
              <td class="border px-4 py-2">Rs. 150.00</td>
              <td class="border px-4 py-2">
                <select
                  class="bg-blue-500 text-white font-semibold py-1.5 px-3 rounded cursor-pointer focus:outline-none">
                  <option value="processing" selected>Processing</option>
                  <option value="shipped" class="text-white">Shipped</option>
                  <option value="delivered" class="text-white">
                    Delivered
                  </option>
                </select>
              </td>

              <td class="border px-4 py-2">
                <button
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded"
                  onclick="showContent('editContent')">
                  View
                </button>
                <button
                  class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded ml-2"
                  onclick="cancelOrder(101)">
                  Cancel
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Edit Section -->
  <div id="editContent" class="content container mx-auto pb-4 px-4">
    <div class="container mx-auto pb-8 ml-6">
      <!-- Customer Details Section -->
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Customer Details</h2>
      <hr />
      <div class="grid grid-cols-2 gap-4 pt-2">
        <div>
          <p class="font-bold text-gray-700">Customer ID</p>
          <p id="customerId" class="text-gray-600">C123</p>
        </div>
        <div>
          <p class="font-bold text-gray-700">Username</p>
          <p id="customerUsername" class="text-gray-600">john_doe</p>
        </div>
        <div>
          <p class="font-bold text-gray-700">Full Name</p>
          <p id="customerFullName" class="text-gray-600">John Doe</p>
        </div>
        <div>
          <p class="font-bold text-gray-700">Email</p>
          <p id="customerEmail" class="text-gray-600">johndoe@example.com</p>
        </div>
        <div>
          <p class="font-bold text-gray-700">Mobile</p>
          <p id="customerMobile" class="text-gray-600">123456789</p>
        </div>
        <div>
          <p class="font-bold text-gray-700">Address</p>
          <p id="customerAddress" class="text-gray-600">123 Main St, City</p>
        </div>
      </div>
    </div>

    <!-- Order Details Section -->
    <div class="bg-white rounded-lg shadow-lg p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Order Details</h2>
      <div class="overflow-x-auto">
        <table
          class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
          <thead>
            <tr>
              <th class="py-3 px-4 bg-gray-800 text-white text-left">
                Order ID
              </th>
              <th class="py-3 px-4 bg-gray-800 text-white text-left">
                Product ID
              </th>
              <th class="py-3 px-4 bg-gray-800 text-white text-left">
                Product Image
              </th>
              <th class="py-3 px-4 bg-gray-800 text-white text-left">
                Product Name
              </th>
              <th class="py-3 px-4 bg-gray-800 text-white text-left">
                Quantity
              </th>
              <th class="py-3 px-4 bg-gray-800 text-white text-left">Size</th>
              <th class="py-3 px-4 bg-gray-800 text-white text-left">
                Price
              </th>
              <th class="py-3 px-4 bg-gray-800 text-white text-left">
                Total Price
              </th>
            </tr>
          </thead>
          <tbody>
            <!-- Sample Product Row -->
            <tr class="border-b border-gray-200">
              <td class="py-4 px-4">ORD001</td>
              <td class="py-4 px-4">PROD001</td>
              <td class="py-4 px-4">
                <img
                  src="path_to_product_image.jpg"
                  alt="Product Image"
                  class="w-12 h-12 rounded object-cover" />
              </td>
              <td class="py-4 px-4">Product Name 1</td>
              <td class="py-4 px-4">2</td>
              <td class="py-4 px-4">M</td>
              <td class="py-4 px-4">Rs. 25.00</td>
              <td class="py-4 px-4">Rs. 50.00</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td
                colspan="6"
                class="py-3 px-4 text-right font-semibold text-gray-800">
                Total Amount:
              </td>
              <td class="py-3 px-4 font-semibold text-gray-800">Rs. 150.00</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <script>
    function showContent(contentId) {
      // Hide all content sections
      const allContent = document.querySelectorAll('.content');
      allContent.forEach((content) => content.classList.remove('active'));

      // Show the selected content section
      const selectedContent = document.getElementById(contentId);
      selectedContent.classList.add('active');
    }
  </script>
</body>

</html>