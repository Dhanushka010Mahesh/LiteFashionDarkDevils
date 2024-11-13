<?php
session_start();
include_once '../includes/config.php';

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();


if (!isset($_SESSION['username'])) {
    header('Location: http://localhost/LiteFashionDarkDevils/user/');
    exit;
}

$customerId = $_SESSION['custormerId'];

// Fetch existing delivery address
$addressDataQuery = $connection->prepare("SELECT * FROM delivery_address WHERE CustermerId = :customerId LIMIT 1");
$addressDataQuery->bindParam(':customerId', $customerId);
$addressDataQuery->execute();
$addressData = $addressDataQuery->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stripe_secret_key = $_ENV['STRIPE_SECRET_KEY'];
    \Stripe\Stripe::setApiKey($stripe_secret_key);

    try {
        $checkout_session = \Stripe\Checkout\Session::create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'lkr',
                        'unit_amount' => 250000,
                        'product_data' => [
                            'name' => 'T-shirt'
                        ]
                    ]
                ],
                [
                    'quantity' => 2,
                    'price_data' => [
                        'currency' => 'lkr',
                        'unit_amount' => 30000,
                        'product_data' => [
                            'name' => 'Hat'
                        ]
                    ]
                ],
            ],
            'success_url' => 'http://localhost/LiteFashionDarkDevils/user/pages/orders.php',
            'cancel_url' => 'http://localhost/LiteFashionDarkDevils/user/pages/place_order.php',
        ]);

        http_response_code(303);
        header('Location: ' . $checkout_session->url);
        exit;
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo 'Error creating Checkout Session: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php' ?>

<body>
    <!-- navbar -->
    <?php include_once '../includes/navbar.php' ?>

    <!-- page header -->
    <section id="page-header-about" class="flex flex-col py-0 px-20 text-center justify-center">
        <h1 class="text-6xl font-semibold text-white/90 p-3">Place Order</h1>
        <p class="text-white/80">Review your details and confirm your order below.</p>
    </section>

    <!-- Order Form -->
    <div>
        <div class="flex justify-between gap-20 pt-5 border-t m-20">
            <!-- Delivery Information -->
            <form id="postForm" class="flex flex-col gap-4 w-1/2">
                <div class="text-xl sm:text-2xl my-3 text-sky-600 font-semibold">
                    <h2>DELIVERY INFORMATION</h2>
                </div>
                <div class="flex gap-3">
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="first_name" placeholder="First name" value="<?php echo $addressData['first_name'] ?? ''; ?>" />
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="last_name" placeholder="Last name" value="<?php echo $addressData['last_name'] ?? ''; ?>" />
                </div>
                <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="street" placeholder="Street" value="<?php echo $addressData['street'] ?? ''; ?>" />
                <div class="flex gap-3">
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="city" placeholder="City" value="<?php echo $addressData['city'] ?? ''; ?>" />
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="state" placeholder="State" value="<?php echo $addressData['state'] ?? ''; ?>" />
                </div>
                <div class="flex gap-3">
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="number" name="zip_code" placeholder="Zip code" value="<?php echo $addressData['zip_code'] ?? ''; ?>" />
                    <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="text" name="country" placeholder="Country" value="<?php echo $addressData['country'] ?? ''; ?>" />
                </div>
                <input class="border border-gray-300 rounded-md py-1.5 px-3.5 w-full bg-gray-50" type="number" name="phone" placeholder="Phone" value="<?php echo $addressData['phone'] ?? ''; ?>" />
                <div class="flex gap-5 items-center w-full text-start">
                    <button type="submit" name="submit" class="bg-sky-500 text-white px-5 py-3 text-sm font-semibold rounded-md">Add Address</button>
                    <!-- Message -->
                    <h1 class="text-sky-500 font-semibold text-lg text-center" id="show"></h1>
                </div>
            </form>

            <!-- Cart Total and Payment Method -->
            <form method='POST' class="flex flex-col items-start gap-6 mt-8 w-1/3">
                <div class="w-full p-4 border-2 border-sky-400 bg-sky-100/50 rounded-lg">
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
                    <h2 class="text-xl mb-3 text-sky-600 font-semibold text-left">PAYMENT METHOD</h2>
                    <div class="flex gap-3 items-start">
                        <div class="flex items-center gap-3 border p-2 px-3 cursor-pointer rounded-md hover:bg-sky-100">
                            <input type="radio" name="payment_method" value="online" id="payment-online" class="cursor-pointer" />
                            <label for="payment-online" class="text-gray-500 text-sm font-medium mx-4">ONLINE PAYMENT</label>
                        </div>
                        <div class="flex items-center gap-3 border p-2 px-3 cursor-pointer rounded-md hover:bg-sky-100">
                            <input type="radio" name="payment_method" value="cod" id="payment-cod" class="cursor-pointer" />
                            <label for="payment-cod" class="text-gray-500 text-sm font-medium mx-4">CASH ON DELIVERY</label>
                        </div>
                    </div>
                    <div class="flex gap-5 items-center w-full text-start mt-8">
                        <button type="submit" name="submit" class="bg-red-500 text-white px-8 py-3 text-sm font-semibold rounded-md">PLACE ORDER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- footer -->
    <?php include_once '../includes/footer.php' ?>

    <script src="../layout/js/script.js"></script>
    <script>
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
    </script>
</body>

</html>