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
    <h1 class="text-6xl font-semibold text-white/90 p-3">Place Order</h1>
    <p class="text-white/80">Review your details and confirm your order below.</p>
  </section>

  <div class="flex justify-between gap-20 pt-5 border-t m-20">
    <!-- Delivery Information -->
    <div class="flex flex-col gap-4 w-1/2">
      <div class="text-xl sm:text-2xl my-3 text-sky-600 font-semibold">
        <h2>DELIVERY INFORMATION</h2>
      </div>
      <div class="flex gap-3">
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
          type="text"
          placeholder="First name" />
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
          type="text"
          placeholder="Last name" />
      </div>
      <input
        class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
        type="email"
        placeholder="Email address" />
      <input
        class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
        type="text"
        placeholder="Street" />
      <div class="flex gap-3">
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
          type="text"
          placeholder="City" />
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
          type="text"
          placeholder="State" />
      </div>
      <div class="flex gap-3">
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
          type="number"
          placeholder="Zip code" />
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
          type="text"
          placeholder="Country" />
      </div>
      <input
        class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full"
        type="number"
        placeholder="Phone" />
    </div>

    <!-- Cart Total and Payment Method -->
    <div class="flex flex-col items-start gap-6 mt-8 w-1/3">
      <div
        class="w-full p-4 border-2 border-sky-400 bg-sky-100/50 rounded-lg">
        <h2 class="text-2xl font-bold pb-3 text-sky-600">CART TOTALS</h2>
        <div class="text-lg text-slate-700 space-y-2">
          <div class="flex justify-between">
            <span>Subtotal</span>
            <span>Rs.5200</span>
          </div>
          <div class="flex justify-between">
            <span>Shipping</span>
            <span>Free</span>
          </div>
          <div class="flex justify-between font-semibold mt-2">
            <span>Total</span>
            <span>Rs.5200</span>
          </div>
        </div>
      </div>

      <!-- Payment methods -->
      <div class="mt-8">
        <h2 class="text-xl mb-3 text-sky-600 font-semibold text-left">
          PAYMENT METHOD
        </h2>
        <div class="flex gap-3 items-start">
          <div
            class="flex items-center gap-3 border p-2 px-3 cursor-pointer rounded-md">
            <input
              type="radio"
              name="payment_method"
              value="cod"
              class="cursor-pointer" />
            <span class="text-gray-500 text-sm font-medium mx-4">ONLINE PAYMENT</span>
          </div>
          <div
            class="flex items-center gap-3 border p-2 px-3 cursor-pointer rounded-md">
            <input
              type="radio"
              name="payment_method"
              value="cod"
              class="cursor-pointer" />
            <span class="text-gray-500 text-sm font-medium mx-4">CASH ON DELIVERY</span>
          </div>
        </div>
        <div class="w-full text-start mt-8">
          <button
            onclick="window.location.href='orders.php'"
            class="bg-red-500 text-white px-8 py-3 text-sm font-semibold rounded-md">
            PLACE ORDER
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
</body>

</html>