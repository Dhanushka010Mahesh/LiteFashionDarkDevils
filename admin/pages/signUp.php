<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php'; ?>

<body class="flex justify-center bg-gray-100">
    <div class="popup-contentLog bg-white rounded-xl shadow-lg w-1/3 my-10">
        <div class="p-10 space-y-4">
            <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 text-center">
                Create Admin Account
            </h1>
            <form class="space-y-4 md:space-y-6" method="POST" action="http://localhost/LiteFashionDarkDevils/admin/pages/backend/sign-up.php">

                <!-- Full Name -->
                <div>
                    <label for="fullName" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                    <input type="text" name="fullName" id="fullName" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter your full name" required>
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter username" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="••••••••" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="submitACC" class="w-full text-white bg-gray-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create Account</button>

                <!-- Redirect to Sign In -->
                <p class="text-sm font-light text-gray-500 text-center mt-5">
                    Already have an account?
                    <a href="../index.php" class="font-medium text-primary-600 hover:underline">Sign In</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>