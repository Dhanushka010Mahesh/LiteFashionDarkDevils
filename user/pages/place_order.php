<?php
include_once '../includes/config.php';

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php' ?>

<body>
    <!-- navbar -->
    <?php include_once '../includes/navbar.php' ?>

    <?php
if (!isset($_SESSION['cus_username'])) {
    header('Location: http://localhost/LiteFashionDarkDevils/user/');
    exit;
}

  $ownerDetails = $connection->query("select C_fullname,C_email,C_street,C_city,C_province,C_zipCode,C_mobile from customers where C_status='1' and CustermerId='{$_SESSION['cus_Id']}'");
  $ownerDetails->execute();
  $ownerDetailsSelect = $ownerDetails->fetch(PDO::FETCH_OBJ);
 

?>

    <!-- page header -->
    <section id="page-header-about" class="flex flex-col py-0 px-20 text-center justify-center">
        <h1 class="text-6xl font-semibold text-white/90 p-3">Place Order</h1>
        <p class="text-white/80">Review your details and confirm your order below.</p>
    </section>

    <!-- Order Form -->
    <div>
        <div class="flex justify-between gap-20 pt-5 border-t m-20">
            <!-- Delivery Information -->
            <form id="postForm" class="flex flex-col gap-4 w-1/2" action="./auth/Delivary_Checkout.php" method="POST">
                <div class="text-xl sm:text-2xl my-3 text-sky-600 font-semibold">
                    <h2>DELIVERY INFORMATION</h2>
                </div>
                <div class="flex gap-3">
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="cus_full_name" placeholder="Full name" value="<?php echo $_SESSION['cus_fullname']; ?>" />
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="email" name="cus_email_address" placeholder="Email Address" value="<?php echo htmlspecialchars($ownerDetailsSelect->C_email ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                </div>
                <div class="flex gap-3">
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="cus_street" placeholder="Street" value="<?php echo htmlspecialchars($ownerDetailsSelect->C_street ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="cus_city" placeholder="City" value="<?php echo htmlspecialchars($ownerDetailsSelect->C_city ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                </div>
                <div class="flex gap-3">
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="cus_province" placeholder="Province" value="<?php echo htmlspecialchars($ownerDetailsSelect->C_province ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="cus_country" placeholder="Country" value="<?php echo 'Sri Lanka'; ?>" />
                </div>
                <div class="flex gap-3">
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="number" name="cus_zip_code" placeholder="Zip code" value="<?php echo htmlspecialchars($ownerDetailsSelect->C_zipCode ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="number" name="cus_phone_number" placeholder="Phone" value="<?php echo htmlspecialchars($ownerDetailsSelect->C_mobile ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                </div>                
                <div class="flex gap-3">
                        <div class="flex items-center h-5">
                            <input id="remember" name="update_delivery_data" value="updateData" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500">Update Delivery Information</label>
                        </div>
                </div>

                <!-- Payment methods -->
                <div class="mt-8">
                    <h2 class="text-xl mb-3 text-sky-600 font-semibold text-left">PAYMENT METHOD</h2>
                    <div class="flex gap-3 items-start">
                        <div class="flex items-center gap-3 border p-2 px-3 cursor-pointer rounded-md hover:bg-sky-100">
                            <input type="radio" name="payment_method" value="onlinePay" id="payment-online" class="cursor-pointer" />
                            <label for="payment-online" class="text-gray-500 text-sm font-medium mx-4">ONLINE PAYMENT</label>
                        </div>
                        <div class="flex items-center gap-3 border p-2 px-3 cursor-pointer rounded-md hover:bg-sky-100">
                            <input type="radio" name="payment_method" value="cashOnDelivery" id="payment-cod" class="cursor-pointer" />
                            <label for="payment-cod" class="text-gray-500 text-sm font-medium mx-4">CASH ON DELIVERY</label>
                        </div>
                    </div>
                    <div class="flex gap-5 items-center w-full text-start mt-8">
                        <button type="submit" name="order_data_submit" class="bg-red-500 text-white px-8 py-3 text-sm font-semibold rounded-md">PLACE ORDER</button>
                    </div>
                </div>
            </form>

            <!-- Cart Total and Payment Method -->
            <form method='POST' class="flex flex-col items-start gap-6 mt-8 w-1/3">
                <div class="w-full p-4 border-2 border-sky-400 bg-sky-100/50 rounded-lg">
                    <h2 class="text-2xl font-bold pb-3 text-sky-600">CART TOTALS</h2>
                    <div class="text-lg text-slate-700 space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span><?php echo "Rs : ".$_SESSION['total_price_cart']; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="flex justify-between font-semibold mt-2">
                            <span>Total</span>
                            <span><?php echo "Rs : ".($_SESSION['total_price_cart']); ?></span>
                        </div>
                    </div>
                </div>

                
            </form>
        </div>
    </div>

    <!-- footer -->
    <?php include_once '../includes/footer.php' ?>

    <script src="../layout/js/script.js"></script>
    <!-- <script>
        document.getElementById('postForm').addEventListener('submit', postName);

        function postName(e) {
            e.preventDefault();

            let formData = new FormData(document.getElementById('postForm'));

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_delivery_address.php', true);

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
    </script> -->
</body>

</html>