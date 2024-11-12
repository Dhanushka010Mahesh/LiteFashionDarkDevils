<?php
session_start();
require_once '../includes/config.php';

$allUserData = [];

?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php'; ?>

<body>
  <?php
  if (isset($_SESSION['email'])) {

    try {
      $userData = $connection->prepare("SELECT * FROM admins WHERE email = :email");
      $userData->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
      $userData->execute();

      $allUserData = $userData->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  ?>

  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Admin Profile</h1>

    <!-- Profile Information Section -->
    <div class="bg-white shadow-md rounded-md p-4 mb-6">
      <form id="postForm">
        <?php if (!empty($allUserData)) : ?>
          <?php foreach ($allUserData as $user) : ?>
            <div class="mb-4">
              <label for="fullName" class="block text-gray-700 font-bold mb-2">Full Name</label>
              <input
                type="text"
                id="fullName"
                name="fullName"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="<?php echo $user->full_name; ?>"
                required />
            </div>
            <div class="mb-4">
              <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="<?php echo $user->username; ?>"
                required />
            </div>
            <div class="mb-4">
              <label for="admin-email" class="block text-gray-700 font-bold mb-2">Email</label>
              <input
                type="email"
                id="admin-email"
                name="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="<?php echo $user->email; ?>"
                required
                disabled />
            </div>

          <?php endforeach; ?>
        <?php else : ?>
          <p>No user data available. Please check if you are logged in.</p>
        <?php endif; ?>
        <div class="flex items-center gap-10">
          <button
            type="submit"
            name="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Save Changes
          </button>
          <!-- Message -->
          <h1 class="text-sky-500 font-semibold text-lg text-center" id="show"></h1>

        </div>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('postForm').addEventListener('submit', postName);

    function postName(e) {
      e.preventDefault();

      let formData = new FormData(document.getElementById('postForm'));

      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'http://localhost/LiteFashionDarkDevils/admin/pages/backend/update_profile.php', true);

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
  </script>
</body>

</html>