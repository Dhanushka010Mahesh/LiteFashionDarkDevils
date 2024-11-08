<?php
require_once '../includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lite Fashion Admin Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="http://localhost/LiteFashionDarkDevils/admin/layout/css/styles.css" />
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
  <div id="displayContent" class="content active">
    <div class="overflow-x-auto">
      <h1 class="text-2xl font-bold mb-4">Product List</h1>
      <table class="min-w-full bg-white rounded-lg overflow-hidden">
        <thead>
          <tr>
            <th class="py-2 px-4 bg-gray-800 text-white">ID</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Image</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Product Name</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Category</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Price</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Quantity</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Sizes</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Status</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Actions</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <?php
          try {
            $query = $connection->query("SELECT * FROM clothproduct");

            while ($product = $query->fetch(PDO::FETCH_ASSOC)) {
              $sizes = [];
              if ($product['P_small']) $sizes[] = 'S';
              if ($product['P_medium']) $sizes[] = 'M';
              if ($product['P_large']) $sizes[] = 'L';
              if ($product['P_extraLarge']) $sizes[] = 'XL';

              echo "<tr>
                <td class='border px-4 py-2'>{$product['ProductId']}</td>
                <td class='border px-4 py-2'>
                  <img src='http://localhost/LiteFashionDarkDevils/admin/uploads/{$product['P_image1']}' alt='Product Image' style='width: 50px; height: auto;' />
                </td>
                <td class='border px-4 py-2'>{$product['P_name']}</td>
                <td class='border px-4 py-2'>{$product['P_categoryId']}</td>
                <td class='border px-4 py-2'>Rs. {$product['P_price']}</td>
                <td class='border px-4 py-2'>{$product['P_quantity']}</td>
                <td class='border px-4 py-2'>" . implode(', ', $sizes) . "</td>
                <td class='border px-4 py-2'>" . ($product['P_status'] == '1' ? 'Active' : 'Inactive') . "</td>
                <td class='border px-4 py-2'>
                  <div class='flex'>
                    <button class='bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded' onclick=\"showContent('editContent')\">Edit</button>
                    <button class='bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded ml-2' onclick=\"deleteProduct({$product['ProductId']})\">Delete</button>
                  </div>
                </td>
              </tr>";
            }
          } catch (PDOException $e) {
            echo "<tr><td colspan='10' class='border px-4 py-2 text-red-500'>Error loading products</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Edit Section -->
  <div id="editContent" class="content container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Update Product</h1>
    <form
      action="/update-product"
      method="POST"
      enctype="multipart/form-data"
      class="flex flex-col h-full">
      <div class="grid grid-cols-2 gap-10 flex-grow">
        <!-- Left Side -->
        <div class="flex flex-col justify-between">
          <div>
            <div class="mb-4">
              <label for="P_name" class="block text-gray-700 font-bold mb-2">Product Name</label>
              <input
                type="text"
                id="P_name"
                name="P_name"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                required />
            </div>

            <div class="mb-4">
              <label
                for="P_categoryId"
                class="block text-gray-700 font-bold mb-2">Category</label>
              <select
                id="P_categoryId"
                name="P_categoryId"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                required>
                <option value="">Select Category</option>
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="kids">Kids</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="P_price" class="block text-gray-700 font-bold mb-2">Price</label>
              <input
                type="number"
                step="0.01"
                id="P_price"
                name="P_price"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                required />
            </div>

            <div class="mb-4">
              <label
                for="P_quantity"
                class="block text-gray-700 font-bold mb-2">Quantity</label>
              <input
                type="number"
                id="P_quantity"
                name="P_quantity"
                value="1"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                required />
            </div>

            <div class="mb-4">
              <label
                for="P_description"
                class="block text-gray-700 font-bold mb-2">Description</label>
              <textarea
                id="P_description"
                name="P_description"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                rows="4"></textarea>
            </div>
          </div>
        </div>

        <!-- Right Side -->
        <div class="flex flex-col justify-between">
          <div>
            <div class="mb-4">
              <label for="P_image1" class="block text-gray-700 font-bold mb-2">Image 1</label>
              <input
                type="file"
                id="P_image1"
                name="P_image1"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" />
            </div>

            <div class="mb-4">
              <label for="P_image2" class="block text-gray-700 font-bold mb-2">Image 2</label>
              <input
                type="file"
                id="P_image2"
                name="P_image2"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" />
            </div>

            <div class="mb-4">
              <label for="P_image3" class="block text-gray-700 font-bold mb-2">Image 3</label>
              <input
                type="file"
                id="P_image3"
                name="P_image3"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" />
            </div>

            <div class="mb-4">
              <label for="P_image4" class="block text-gray-700 font-bold mb-2">Image 4</label>
              <input
                type="file"
                id="P_image4"
                name="P_image4"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" />
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 font-bold mb-2">Sizes</label>
              <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    id="P_small"
                    name="P_small"
                    value="S"
                    class="form-checkbox" />
                  <span class="ml-2">Small</span>
                </label>
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    id="P_medium"
                    name="P_medium"
                    value="M"
                    class="form-checkbox" />
                  <span class="ml-2">Medium</span>
                </label>
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    id="P_large"
                    name="P_large"
                    value="L"
                    class="form-checkbox" />
                  <span class="ml-2">Large</span>
                </label>
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    id="P_extraLarge"
                    name="P_extraLarge"
                    value="XL"
                    class="form-checkbox" />
                  <span class="ml-2">Extra Large</span>
                </label>
              </div>
            </div>

            <div class="mb-4">
              <label for="P_status" class="block text-gray-700 font-bold mb-2">Status</label>
              <select
                id="P_status"
                name="P_status"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-end mt-4">
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-colors duration-200">
          Update Product
        </button>
      </div>
    </form>
  </div>

  <script src="http://localhost/LiteFashionDarkDevils/admin/layout/js/script.js"></script>
  <script>
    function showContent(contentId) {
      document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
      document.getElementById(contentId).classList.add('active');
    }

    function deleteProduct(productId) {
      if (confirm('Are you sure you want to delete this product?')) {
        window.location.href = `delete-product.php?ProductId=${productId}`;
      }
    }
  </script>
</body>

</html>