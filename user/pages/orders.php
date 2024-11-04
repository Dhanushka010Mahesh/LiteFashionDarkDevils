<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php' ?>

<body>
  <!-- navbar -->
  <?php include_once '../includes/navbar.php' ?>

  <!-- page header -->
  <section
    id="page-header-about"
    class="flex flex-col py-0 px-20 text-center justify-center">
    <h1 class="text-6xl font-semibold text-white/90 p-3">My Orders</h1>
    <p class="text-white/80">Track your orders and view order details.</p>
  </section>

  <!-- Orders List -->
  <section class="py-10 px-20">
    <div class="flex flex-col gap-6">
      <!-- Single Order -->
      <div class="p-6 border border-gray-300 rounded-lg shadow-sm">
        <div class="flex justify-between mb-4">
          <div class="text-lg font-semibold text-sky-600">Order #12345</div>
          <div class="text-sm text-gray-500">Placed on 2024-10-28</div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Order Item -->
          <div class="flex items-center gap-4">
            <img src="../layout/images/products/f6.jpg" alt="Product Image" class="w-20 h-20 object-cover rounded-md" />
            <div>
              <p class="text-gray-800 font-medium">Summer T-Shirt</p>
              <p class="text-gray-500">Quantity: 1</p>
              <p class="text-gray-500">Price: Rs.1300</p>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <img src="../layout/images/products/f8.jpg" alt="Product Image" class="w-20 h-20 object-cover rounded-md" />
            <div>
              <p class="text-gray-800 font-medium">Summer T-Shirt</p>
              <p class="text-gray-500">Quantity: 1</p>
              <p class="text-gray-500">Price: Rs.1300</p>
            </div>
          </div>
        </div>
        <div class="flex justify-between mt-6">
          <div>
            <p class="text-lg font-semibold">Total: Rs.2600</p>
          </div>
          <div class="text-sky-500 font-semibold">Status: Shipped</div>
        </div>
      </div>

      <!-- Another Order -->
      <div class="p-6 border border-gray-300 rounded-lg shadow-sm">
        <div class="flex justify-between mb-4">
          <div class="text-lg font-semibold text-sky-600">Order #12346</div>
          <div class="text-sm text-gray-500">Placed on 2024-10-25</div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="flex items-center gap-4">
            <img src="../layout/images/products/f7.jpg" alt="Product Image" class="w-20 h-20 object-cover rounded-md" />
            <div>
              <p class="text-gray-800 font-medium">Casual Shirt</p>
              <p class="text-gray-500">Quantity: 1</p>
              <p class="text-gray-500">Price: Rs.1500</p>
            </div>
          </div>
        </div>
        <div class="flex justify-between mt-6">
          <div>
            <p class="text-lg font-semibold">Total: Rs.1500</p>
          </div>
          <div class="text-yellow-500 font-semibold">Status: Processing</div>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
</body>

</html>