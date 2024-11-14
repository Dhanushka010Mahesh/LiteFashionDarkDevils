<?php
require_once '../auth_check.php';

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
      <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-4">Product List</h1>
        <!-- Message -->
        <h1 class="text-sky-500 font-semibold text-lg mr-20" id="show"></h1>
      </div>
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
          ?>
              <tr>
                <td class="border px-4 py-2"><?= $product['ProductId']; ?></td>
                <td class="border px-4 py-2">
                  <img src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?= $product['P_image1']; ?>" alt="Product Image" style="width: 50px; height: auto;" />
                </td>
                <td class="border px-4 py-2"><?= $product['P_name']; ?></td>
                <td class="border px-4 py-2"><?= $product['P_categoryId']; ?></td>
                <td class="border px-4 py-2">Rs. <?= $product['P_price']; ?></td>
                <td class="border px-4 py-2"><?= $product['P_quantity']; ?></td>
                <td class="border px-4 py-2"><?= implode(', ', $sizes); ?></td>
                <td class="border px-4 py-2"><?= $product['P_status'] == '1' ? 'Active' : 'Inactive'; ?></td>
                <td class='border px-4 py-2'>
                  <div class='flex'>
                    <a href="http://localhost/LiteFashionDarkDevils/admin/pages/update_product.php?product_id=<?= $product['ProductId']; ?>" class='bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded'>Edit</a>
                    <form id="postForm">
                      <input type="hidden" name="ProductId" value="<?php echo $product['ProductId']; ?>">
                      <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded ml-2 deleteBtn" data-id="<?= $product['ProductId']; ?>">Delete</button>
                    </form>
                  </div>
                </td>

              </tr>
          <?php
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
    

  </div>

  <script>
    function showContent(contentId) {
      document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
      document.getElementById(contentId).classList.add('active');
    }

    document.querySelectorAll('.deleteBtn').forEach(button => {
      button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');

        // Confirm before deletion
        if (confirm("Are you sure you want to delete this product?")) {
          const formData = new FormData();
          formData.append('ProductId', productId);

          const xhr = new XMLHttpRequest();
          xhr.open('POST', 'http://localhost/LiteFashionDarkDevils/admin/pages/backend/delete-product.php', true);

          xhr.onload = function() {
            if (xhr.status === 200) {
              document.getElementById('show').innerHTML = xhr.responseText;
              setTimeout(() => location.reload(), 1000); // Reload page after deletion
            } else {
              console.error('Error in form submission');
            }
          };

          xhr.send(formData);
        }
      });
    });
  </script>
  <script src="http://localhost/LiteFashionDarkDevils/admin/layout/js/script.js"></script>
</body>

</html>