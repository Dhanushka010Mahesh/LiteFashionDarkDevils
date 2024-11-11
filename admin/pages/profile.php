<?php include_once '../includes/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php'; ?>

<body>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Admin Profile</h1>

    <!-- Profile Information Section -->
    <div class="bg-white shadow-md rounded-md p-4 mb-6">

      <form id="profile-form">
        <div class="mb-4">
          <label for="fullName" class="block text-gray-700 font-bold mb-2">Full Name</label>
          <input
            type="text"
            id="fullName"
            name="fullName"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required />
        </div>
        <div class="mb-4">
          <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required />
        </div>

        <div class="mb-4">
          <label for="admin-email" class="block text-gray-700 font-bold mb-2">Email</label>
          <input
            type="email"
            id="admin-email"
            name="email"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            required />
        </div>

        <div class="mb-4">
          <label
            for="admin-password"
            class="block text-gray-700 font-bold mb-2">Password</label>
          <input
            type="password"
            id="admin-password"
            name="password"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>

        <div class="flex items-center justify-between">
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Save Changes
          </button>
        </div>
      </form>
    </div>

    <!-- Profile Picture Upload Section -->
    <div class="bg-white shadow-md rounded-md p-4">
      <h2 class="text-xl font-semibold mb-4">Profile Picture</h2>

      <div class="flex items-center">
        <img
          src="https://via.placeholder.com/150"
          alt="Profile Picture"
          class="rounded-full w-24 h-24 mr-4" />
        <input
          type="file"
          id="profile-picture"
          name="profile-picture"
          class="block w-full py-2 px-3 border rounded" />
      </div>

      <div class="mt-4">
        <button
          class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Upload New Picture
        </button>
      </div>
    </div>
  </div>

  <script>
    document
      .getElementById('profile-form')
      .addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Profile updated successfully!');
      });

    document
      .getElementById('profile-picture')
      .addEventListener('change', function() {
        alert('Profile picture uploaded successfully!');
      });
  </script>
</body>

</html>