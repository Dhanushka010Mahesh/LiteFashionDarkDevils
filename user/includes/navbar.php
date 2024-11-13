<?php
session_start();
//require(dirname(dirname(__FILE__))."./config.php");
//require('./user/includes/config.php');

$cartCount=$connection->query("select count(*) as numOfCloth from cart where CustermerId='{$_SESSION['custormerId']}'");
$cartCount->execute();
$numOfCart=$cartCount->fetch(PDO::FETCH_OBJ);
?>
<section
    id="header"
    class="bg-slate-200 shadow-lg shadow-cyan-500/30 px-5 z-10 sticky top-0 left-0">
    <div class="flex justify-between">
        <div class="flex gap-10">
            <div>
                <a href="http://localhost/LiteFashionDarkDevils/user/index.php"><img
                        src="http://localhost/LiteFashionDarkDevils/user/layout/images/lite_fashion.png"
                        width="150px"
                        alt="logo"
                        class="logo" /></a>
            </div>
            <div
                id="navbar"
                class="flex p-5 text-lg gap-5 font-semibold text-sky-600">
                <p><a class="active" href="http://localhost/LiteFashionDarkDevils/user/index.php">Home</a></p>
                <p><a href="http://localhost/LiteFashionDarkDevils/user/pages/list_products.php">Products</a></p>
                <p><a href="http://localhost/LiteFashionDarkDevils/user/pages/about.php">About</a></p>
                <p><a href="http://localhost/LiteFashionDarkDevils/user/pages/contact.php">Contact</a></p>
            </div>
        </div>

        <div class="flex p-5 text-xl text-sky-600 gap-10">

            <i onclick="popup()" href="javascript:void(0)" class="cursor-pointer"><?php echo ((isset($_SESSION['email'])) ? $_SESSION['email'] : 'Login'); ?></i>
            <a href="javascript:void(0)" onclick="popup()">
                <img
                    src="http://localhost/LiteFashionDarkDevils/user/layout/images/profiles/<?php echo isset($_SESSION['image']) ? htmlspecialchars($_SESSION['image'], ENT_QUOTES, 'UTF-8') : 'cImage2.png'; ?>"
                    width="25"
                    height="20"
                    alt="Profile">
            </a>

            <?php if (isset($_SESSION['email'])) : ?>
                <a href="http://localhost/LiteFashionDarkDevils/user/pages/cart.php"><i class="fa-solid fa-cart-shopping hover:text-sky-400"><span style="color: red;"><?php echo  $numOfCart->numOfCloth; ?></span></i></a>
            <?php endif; ?>
        </div>
    </div>

    <!-- login popup -->
    <div id="dropdownMenu" class="hidden absolute dropdown-menu right-0 pt-4">

        <?php if (isset($_SESSION['email'])) : ?>
            <div class="flex flex-col gap-2 w-36 py-3 px-5 bg-slate-100 text-gray-500 rounded">
                <a href="http://localhost/LiteFashionDarkDevils/user/pages/profile.php" class="cursor-pointer hover:text-black">My Profile</a>
                <a href="http://localhost/LiteFashionDarkDevils/user/pages/orders.php" class="cursor-pointer hover:text-black">Orders</a>
                <a href="http://localhost/LiteFashionDarkDevils/user/pages/auth/logout.php" class="cursor-pointer hover:text-black">Logout</a>
            </div>
            <!-- 
            <a href="http://localhost/LiteFashionDarkDevils/user/pages/signIn.php" class="cursor-pointer hover:text-black">Login</a>
            <a href="http://localhost/LiteFashionDarkDevils/user/pages/signUp.php" class="cursor-pointer hover:text-black">Register</a>
            
        -->
        <?php else : ?>

            <div class="popup-contentLog  bg-white rounded-xl shadow-lg mr-3">
                <div class="p-10 space-y-4">
                    <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900">
                        Sign In to your Account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="http://localhost/LiteFashionDarkDevils/user/pages/auth/signin_data_send.php">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="your email" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500">Remember me</label>
                                </div>
                            </div>
                            <a href="http://localhost/LiteFashionDarkDevils/user/pages/auth/forgot_password_form.php" class="text-sm font-medium text-primary-600 hover:underline">Forgot password?</a>
                        </div>
                        <button type="submit" name="submit" class="w-full text-white bg-gray-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign In</button>
                        <p class="text-sm font-light text-gray-500">
                            Don’t have an account yet? <a href="http://localhost/LiteFashionDarkDevils/user/pages/auth/signup_form.php" class="font-medium text-primary-600 hover:underline" onclick="loadContent('Components', 'SignUp','left-content')">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        <?php endif;  ?>
    </div>
</section>