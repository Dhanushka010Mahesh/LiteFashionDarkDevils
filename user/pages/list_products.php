<?php
require_once('../includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once('../includes/header.php');
?>

<body>
  <!-- Navbar -->
  <?php include_once('../includes/navbar.php'); ?>

  <!-- Page header -->
  <section id="page-header-products" class="flex flex-col py-0 px-20 text-center justify-center">
  </section>

  <!-- Title -->
  <div class="text-center pt-8 pb-4">
    <h2 class="text-5xl font-bold">ALL Products</h2>
    <p class="text-lg text-slate-500">Summer Collection New Modern Design</p>
  </div>

  <!-- Main Content Section -->
  <div class="flex py-8 px-20 space-x-8">

    <!-- Filter Sidebar -->
    <aside class="w-1/5 p-6 bg-gray-100 rounded-lg shadow-md">
      <!-- Search Form -->
      <form id="search-form" class="mb-6">
        <input
          type="text"
          id="search-input"
          class="w-full p-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-500"
          placeholder="Search products..." />
      </form>

      <!-- Category Filters -->
      <div>
        <h5 class="text-xl font-semibold mb-4 pl-2">Categories</h5>
        <div id="category-buttons" class="space-y-2">
          <button class="filter-btn w-full text-center font-bold text-left p-2 rounded-md text-gray-800 bg-gray-200 hover:bg-gray-300" data-category="all">All</button>

          <?php

          $categories = $connection->query("
        SELECT DISTINCT c.CategoryId, c.C_name
        FROM clothProduct p
        JOIN category c ON p.P_categoryId = c.CategoryId
        WHERE p.P_status = 1
    ");

          while ($row = $categories->fetch(PDO::FETCH_ASSOC)) {
            echo "<button class='filter-btn text-center font-bold w-full text-left p-2 rounded-md text-gray-800 bg-gray-200 hover:bg-gray-300' data-category='{$row['CategoryId']}'>
                {$row['C_name']}
              </button>";
          }
          ?>
        </div>

      </div>
    </aside>

    <!-- Products Section -->
    <section id="products" class="flex-1">

      <!-- Sort Dropdown -->
      <div class="flex justify-end mb-6">
        <select id="sort-options" class="p-2 border rounded-md">
          <option value="default">Sort by: Default</option>
          <option value="low-to-high">Price: Low to High</option>
          <option value="high-to-low">Price: High to Low</option>
        </select>
      </div>

      <!-- Products Container -->
      <div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php
        $query = "SELECT * FROM clothProduct WHERE P_status = 1";
        $products = $connection->query($query);
        foreach ($products as $product):
        ?>
          <div
            class="p-4 border rounded-md shadow hover:shadow-lg transition duration-200 cursor-pointer"
            onclick="window.location.href='single_product.php?id=<?php echo $product['ProductId']; ?>'">
            <img src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $product['P_image1']; ?>" alt="<?php echo $product['P_name']; ?>" class="w-full h-64 object-cover rounded-md" />
            <div class="mt-4">
              <span class="block text-gray-600"><?php echo $product['P_categoryId']; ?></span>
              <h3 class="text-lg font-semibold"><?php echo $product['P_name']; ?></h3>
              <p class="text-red-400 font-bold">$<?php echo $product['P_price']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <?php include_once '../includes/footer.php'; ?>

  <script src="../layout/js/script.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const searchInput = document.getElementById('search-input');
      const categoryButtons = document.querySelectorAll('.filter-btn');
      const sortOptions = document.getElementById('sort-options');

      function fetchProducts(queryParams = '') {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `fetch_products.php?${queryParams}`, true);
        xhr.onload = function() {
          if (this.status === 200) {
            document.getElementById('products-container').innerHTML =
              this.responseText;
          }
        };
        xhr.send();
      }

      searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value;
        fetchProducts(`search=${searchTerm}`);
      });

      categoryButtons.forEach((button) => {
        button.addEventListener('click', () => {
          const category = button.getAttribute('data-category');
          fetchProducts(`category=${category}`);
        });
      });

      sortOptions.addEventListener('change', () => {
        const sortOrder = sortOptions.value;
        fetchProducts(`sortOrder=${sortOrder}`);
      });
    });
  </script>
</body>

</html>