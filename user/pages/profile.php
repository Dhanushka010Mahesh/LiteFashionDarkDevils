<?php include_once '../includes/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php' ?>

<body>
  <!-- navbar -->
  <?php include_once '../includes/navbar.php' ?>

  <?php

  if (!isset($_SESSION['username'])) {
    echo "<script> window.location.href='http://localhost/LiteFashionDarkDevils/user/'; </script>";
  }

   // Fetch customer data 
  $userData = $connection->query("select * from customers where CustermerId='{$_SESSION['custormerId']}'");
  $userData->execute();
  $allUserData = $userData->fetchAll(PDO::FETCH_OBJ);

  // Fetch delivery address 
  $addressData = $connection->prepare("SELECT * FROM delivery_address WHERE CustermerId = :custermerId");
  $addressData->bindParam(':custermerId', $_SESSION['custormerId']);
  $addressData->execute();
  $addressData = $addressData->fetch(PDO::FETCH_OBJ);
  ?>

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
      <form id="postForm" class="space-y-5">
        <?php foreach ($allUserData as $user) : ?>
          <div>
            <label for="fullname" class="block text-gray-700 font-medium">Full Name</label>
            <input
              type="text"
              id="fullname"
              name="fullname"
              class="block w-full p-3 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50"
              value="<?php echo $user->C_fullname; ?>"
              required />
          </div>
          <div>
            <label for="username" class="block text-gray-700 font-medium">Username</label>
            <input
              type="text"
              id="username"
              name="username"
              class="block w-full p-3 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50"
              value="<?php echo $user->C_username; ?>"
              required />
          </div>
          <div>
            <label for="email" class="block text-gray-700 font-medium">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              class="block w-full p-3 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50"
              value="<?php echo $user->C_email; ?>"
              required
              disabled />
          </div>
          <div>
            <label for="phone" class="block text-gray-700 font-medium">Phone</label>
            <input
              type="text"
              id="phone"
              name="phone"
              class="block w-full p-3 mt-1 text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50"
              value="<?php echo $user->C_mobile; ?>" />
          </div>
        <?php endforeach; ?>
        <!-- submit -->
        <button
          type="submit"
          name="submit"
          class="block w-full py-3 px-5 text-white bg-sky-500 rounded-lg font-medium hover:bg-sky-700 transition">
          Save Changes
        </button>
        <!-- Message -->
        <h1 class="text-sky-500 font-semibold text-lg text-center" id="show"></h1>

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
          <a class="py-2 px-4 text-sm font-medium text-center text-white bg-sky-500 rounded-lg hover:bg-sky-700 transition w-[80px]" href="http://localhost/LiteFashionDarkDevils/user/pages/auth/forgot_password_form.php">Update</a>
        </li>
      </ul>
    </div>
  </section>

  <!-- Delivery Information -->
  <div class="flex justify-center items-center py-10">
    <form id="postForm2" class="flex flex-col gap-4 w-1/2 bg-white shadow-lg rounded-lg p-8">
      <h2 class="text-3xl font-bold text-slate-800 mb-5">Update Delivery Information</h2>

      <div class="flex gap-3">
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50"
          type="text"
          name="first_name"
          placeholder="First name"
          value="<?php echo isset($addressData->first_name) ? $addressData->first_name : ''; ?>" />
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50"
          type="text"
          name="last_name"
          placeholder="Last name"
          value="<?php echo isset($addressData->last_name) ? $addressData->last_name : ''; ?>" />
      </div>

      <input
        class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50"
        type="text"
        name="street"
        placeholder="Street"
        value="<?php echo isset($addressData->street) ? $addressData->street : ''; ?>" />

      <div class="flex gap-3">
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50"
          type="text"
          name="city"
          placeholder="City"
          value="<?php echo isset($addressData->city) ? $addressData->city : ''; ?>" />
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50"
          type="text"
          name="state"
          placeholder="State"
          value="<?php echo isset($addressData->state) ? $addressData->state : ''; ?>" />
      </div>

      <div class="flex gap-3">
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50"
          type="number"
          name="zip_code"
          placeholder="Zip code"
          value="<?php echo isset($addressData->zip_code) ? $addressData->zip_code : ''; ?>" />
        <input
          class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50"
          type="text"
          name="country"
          placeholder="Country"
          value="<?php echo isset($addressData->country) ? $addressData->country : ''; ?>" />
      </div>

      <input
        class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50"
        type="number"
        name="phone"
        placeholder="Phone"
        value="<?php echo isset($addressData->phone) ? $addressData->phone : ''; ?>" />

      <!-- submit -->
      <button
        type="submit"
        name="submit"
        class="block w-full py-3 px-5 text-white bg-sky-500 rounded-lg font-medium hover:bg-sky-700 transition">
        Save Changes
      </button>

      <!-- Message -->
      <h1 class="text-sky-500 font-semibold text-lg text-center" id="show2"></h1>
    </form>
  </div>


  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
  <script>
    document.getElementById('postForm').addEventListener('submit', postName);
    document.getElementById('postForm2').addEventListener('submit', postName2);

    /* profile update */
    function postName(e) {
      e.preventDefault();

      let formData = new FormData(document.getElementById('postForm'));

      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'update_profile.php', true);

      xhr.onload = function() {
        if (xhr.status === 200) {
          console.log(this.responseText);
          document.getElementById('show').innerHTML = this.responseText;
        } else {
          console.error('Error in form submission');
        }
      };

      xhr.send(formData);
    }

    /* delivery address update */
    function postName2(e) {
      e.preventDefault();

      let formData = new FormData(document.getElementById('postForm2'));

      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'update_delivery_address.php', true);

      xhr.onload = function() {
        if (xhr.status === 200) {
          console.log(this.responseText);
          document.getElementById('show2').innerHTML = this.responseText;
        } else {
          console.error('Error in form submission');
        }
      };

      xhr.send(formData);
    }
  </script>
</body>

</html>