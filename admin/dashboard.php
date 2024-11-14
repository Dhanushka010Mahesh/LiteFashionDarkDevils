<?php

require_once 'auth_check.php';

require_once 'includes/config.php';

try {
    // total products
    $sqlProducts = "SELECT COUNT(*) FROM clothproduct";
    $stmtProducts = $connection->query($sqlProducts);
    $totalProducts = $stmtProducts->fetchColumn();

    // total customers
    $sqlCustomers = "SELECT COUNT(*) FROM customers";
    $stmtCustomers = $connection->query($sqlCustomers);
    $totalCustomers = $stmtCustomers->fetchColumn();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lite Fashion Admin Panel</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="layout/css/styles.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="flex">
        <!-- Sidebar -->
        <?php include_once 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="ml-64 flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 backdrop-blur-sm backdrop-filter">
                <header class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
                        <p class="text-gray-500 mt-1">Welcome back, Administrator</p>
                    </div>
                    <div class="flex items-center space-x-4">

                        <a href="#profile" id="profile" class="flex items-center px-4 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </a>
                        <a href="http://localhost/LiteFashionDarkDevils/admin/pages/backend/logout.php" class="flex items-center px-4 py-2 text-gray-700 hover:text-red-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log out
                        </a>
                    </div>
                </header>

                <main id="content-container" class="space-y-6">
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 shadow-sm">
                            <h3 class="text-blue-600 font-semibold">Total Products</h3>
                            <p class="text-2xl font-bold text-blue-600"><?php echo $totalProducts ?></p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-100 shadow-sm">
                            <h3 class="text-green-600 font-semibold">Total Orders</h3>
                            <p class="text-2xl font-bold text-green-600">...</p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg border border-purple-100 shadow-sm">
                            <h3 class="text-purple-600 font-semibold">Total Customers</h3>
                            <p class="text-2xl font-bold text-purple-600"><?php echo $totalCustomers ?></p>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg border border-red-100 shadow-sm">
                            <h3 class="text-red-600 font-semibold">Revenue</h3>
                            <p class="text-2xl font-bold text-red-600">Rs. ...</p>
                        </div>
                    </div>

                    <!-- Welcome Message -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold mb-2">Welcome to the admin dashboard!</h2>
                        <p class="text-blue-100">Manage your products, orders, and users all in one place.</p>
                    </div>
                </main>
            </div>
        </div>
    </div>



    <script>
        $('#profile').click(function(event) {
            event.preventDefault();
            $('#content-container').load(
                'http://localhost/LiteFashionDarkDevils/admin/pages/profile.php'
            );
        });
    </script>
    <script src="http://localhost/LiteFashionDarkDevils/admin/layout/js/script.js"></script>
</body>

</html>