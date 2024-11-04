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
    <h1 class="text-6xl font-semibold text-white/90 p-3">Profile</h1>
    <p class="text-white/80">View and update your personal information and order history.</p>
  </section>

  <!-- Profile Details -->
  <section class="py-10 px-20 mx-10">
    <div class="max-w-screen-md mx-auto bg-white shadow-lg rounded-lg p-10">
      <h2 class="text-3xl font-bold text-slate-800 mb-5">Profile Information</h2>
      <form class="space-y-5">
        <div>
          <label for="username" class="block text-gray-700 font-medium">Username</label>
          <input
            type="text"
            id="username"
            class="block w-full p-3 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50"
            placeholder="Alex Martin"
            required />
        </div>
        <div>
          <label for="email" class="block text-gray-700 font-medium">Email</label>
          <input
            type="email"
            id="email"
            class="block w-full p-3 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50"
            placeholder="alex.martin@example.com"
            required />
        </div>
        <div>
          <label for="phone" class="block text-gray-700 font-medium">Phone</label>
          <input
            type="text"
            id="phone"
            class="block w-full p-3 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50"
            placeholder="+94 77 123 4567" />
        </div>
        <button
          type="submit"
          class="block w-full py-3 px-5 text-white bg-sky-500 rounded-lg font-medium hover:bg-sky-700 transition">
          Save Changes
        </button>
      </form>
    </div>
  </section>

  <!-- Account Settings -->
  <section class="py-10 px-20 mx-10">
    <div class="max-w-screen-md mx-auto bg-white shadow-lg rounded-lg p-10">
      <h2 class="text-3xl font-bold text-slate-800 mb-5">Account Settings</h2>
      <ul class="space-y-5">
        <li class="flex items-center justify-between">
          <span class="text-lg font-medium text-gray-700">Change Password</span>
          <button class="py-2 px-4 text-sm font-medium text-white bg-sky-500 rounded-lg hover:bg-sky-700 transition">
            Update
          </button>
        </li>
        <li class="flex items-center justify-between">
          <span class="text-lg font-medium text-gray-700">Address Details</span>
          <button class="py-2 px-4 text-sm font-medium text-white bg-sky-500 rounded-lg hover:bg-sky-700 transition">
            Edit
          </button>
        </li>
        <li class="flex items-center justify-between">
          <span class="text-lg font-medium text-gray-700">Payment Methods</span>
          <button class="py-2 px-4 text-sm font-medium text-white bg-sky-500 rounded-lg hover:bg-sky-700 transition">
            Manage
          </button>
        </li>
      </ul>
    </div>
  </section>

  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
</body>

</html>