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
    <h1 class="text-6xl font-semibold text-white/90 p-3">Cart</h1>
    <p class="text-white/80">Add your coupon code & SAVE upto 60%</p>
  </section>

  <!-- cart items -->
  <section class="py-10 px-20">
    <div class="items-center text-center">
      <div
        class="grid grid-cols-6 px-10 py-3 mx-auto text-lg font-semibold bg-slate-200 mb-1 text-center rounded-md">
        <p>Image</p>
        <p>Product</p>
        <p>Price</p>
        <p>Quantity</p>
        <p>SubTotal</p>
        <p>Remove</p>
      </div>
      <div
        class="grid grid-cols-6 px-10 py-3 items-center text-center justify-items-center">
        <img src="../layout/images/products/f6.jpg" alt="" class="w-20" />
        <p>Summer T-Shirt</p>
        <p>Rs.1300</p>
        <input type="number" value="1" class="w-12 pl-2 border" />
        <p>Rs.2600</p>
        <p><i class="fa-solid fa-x text-red-600 cursor-pointer"></i></p>
      </div>
      <div
        class="grid grid-cols-6 px-10 py-3 items-center text-center justify-items-center">
        <img src="../layout/images/products/f8.jpg" alt="" class="w-20" />
        <p>Summer T-Shirt</p>
        <p>Rs.1300</p>
        <input type="number" value="1" class="w-12 pl-2 border" />
        <p>Rs.2600</p>
        <p><i class="fa-solid fa-x text-red-600 cursor-pointer"></i></p>
      </div>
    </div>
  </section>

  <!-- coupon and total amount -->
  <section class="py-10 px-20 mx-20">
    <div class="flex">
      <div class="w-2/3">
        <h2 class="text-lg font-semibold pb-2">Apply Coupon</h2>
        <div class="flex gap-5">
          <input
            type="text"
            placeholder="Enter coupon number"
            class="border-2 border-sky-300 rounded-md py-1 px-2 w-[300px]" />
          <button class="bg-sky-500 text-white py-1 px-6 rounded-md">
            Apply
          </button>
        </div>
      </div>
      <div class="w-1/3 border-2 border-sky-400 bg-sky-100/50 p-8 rounded-lg">
        <h1 class="text-2xl font-bold pb-3">CART TOTALS</h1>
        <div class="w-[300px] text-lg text-slate-700 gap-2">
          <div class="flex justify-between">
            <p>Subtotal</p>
            <p>Rs.5200</p>
          </div>
          <div class="flex justify-between">
            <p>Shipping</p>
            <p>Free</p>
          </div>
          <div class="flex justify-between my-4">
            <p class="font-semibold">Total</p>
            <p class="font-semibold">Rs.5200</p>
          </div>
          <!-- <button class="bg-red-500 text-white py-2 px-6 rounded-md mt-8">
              Proceed to Checkout
            </button> -->
          <a
            href="place_order.php"
            class="bg-red-500 text-white py-3 px-6 rounded-md mt-8">
            Proceed to Checkout
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
</body>

</html>