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

<body class="flex justify-center bg-gray-100">
    <div class="popup-contentLog bg-white rounded-xl shadow-lg w-1/3 my-10">
        <div class="p-10 space-y-4">
            <!-- Tab Navigation -->
            <div class="flex justify-center space-x-6 rounded-xl">
                <button id="loginTab" class="tab-button text-sm font-semibold text-gray-800 border-b-2 border-transparent hover:border-blue-500 hover:text-blue-500 py-3 px-6 transition-all duration-300">
                    Sign In
                </button>
                <button id="signupTab" class="tab-button text-sm font-semibold text-gray-800 border-b-2 border-transparent hover:border-gray-500 hover:text-gray-500 py-3 px-6 transition-all duration-300">
                    Sign Up
                </button>
            </div>


            <!-- Login Form -->
            <div id="loginForm" class="form-container">
                <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 text-center my-5">
                    Admin Login
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="http://localhost/LiteFashionDarkDevils/admin/pages/backend/signUp.php">
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

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500">
                            <label for="remember" class="ml-2 text-sm text-gray-900">Remember me</label>
                        </div>
                        <a href="forgot_password_form.php" class="text-sm font-medium text-primary-600 hover:underline">Forgot password?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submitLogin" class="w-full text-white bg-gray-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign In</button>
                </form>
            </div>

            <!-- Signup Form -->
            <div id="signupForm" class="form-container hidden">
                <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 text-center my-5">
                    Create Admin Account
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="http://localhost/LiteFashionDarkDevils/admin/pages/backend/signUp.php">
                    <!-- Full Name -->
                    <div>
                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                        <input type="text" name="fname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter your full name" required>
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="lname" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="lname" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter username" required>
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

                    <!-- Submit -->
                    <button type="submit" name="submitACC" class="w-full text-white bg-gray-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create Account</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginTab').addEventListener('click', () => {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('signupForm').classList.add('hidden');
        });

        document.getElementById('signupTab').addEventListener('click', () => {
            document.getElementById('signupForm').classList.remove('hidden');
            document.getElementById('loginForm').classList.add('hidden');
        });
    </script>
</body>

</html>