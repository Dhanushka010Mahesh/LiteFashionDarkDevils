<?php
require_once('./includes/config.php');
?>
<?php
$categories1 = $connection->query("select * from clothProduct where P_status='1' and P_categoryId='C001' LIMIT 4");
$categories1->execute();
$menCloth = $categories1->fetchAll(PDO::FETCH_OBJ);

$categories2 = $connection->query("select * from clothProduct where P_status='1' and P_categoryId='C002' LIMIT 4");
$categories2->execute();
$womenCloth = $categories2->fetchAll(PDO::FETCH_OBJ);

$categories3 = $connection->query("select * from clothProduct where P_status='1' and P_categoryId='C003' LIMIT 4");
$categories3->execute();
$kidsCloth = $categories3->fetchAll(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lite Fashion</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="layout/css/styles.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <!-- navbar -->
  <?php include_once 'includes/navbar.php' ?>

  <!-- hero section -->
  <section
    id="hero"
    class="flex flex-col py-0 px-20 flex-start justify-center">
    <h4 class="text-lg font-semibold mb-2 ml-1 text-slate-700">
      Unbeatable Offers
    </h4>
    <h2 class="text-5xl font-semibold">Super value deals</h2>
    <h1 class="text-6xl font-semibold text-sky-500">Across All Products</h1>
    <p>Maximize your savings with coupons and huge discounts!</p>
    <a
      href="pages/list_products.php"
      class="flex justify-start shop-button text-sky-500 hover:text-sky-400 font-semibold cursor-pointer mt-5">
      Shop Now
    </a>
  </section>

  <!-- feature section -->
  <section
    id="feature"
    class="flex py-20 px-20 gap-10 justify-between text-sky-500 bg-slate-200/40 rounded-sm font-semibold">
    <div class="feature-box">
      <img src="layout/images/features/f1.png" alt="" class="p-5" />
      <p class="text-sky-500 bg-sky-200/40 rounded-sm font-semibold">
        Free Shipping
      </p>
    </div>
    <div class="feature-box">
      <img src="layout/images/features/f2.png" alt="" class="p-5" />
      <p class="text-sky-500 bg-sky-200/40 rounded-sm font-semibold">
        Online Order
      </p>
    </div>
    <div class="feature-box">
      <img src="layout/images/features/f3.png" alt="" class="p-5" />
      <p class="text-sky-500 bg-sky-200/40 rounded-sm font-semibold">
        Save Money
      </p>
    </div>
    <div class="feature-box">
      <img src="layout/images/features/f4.png" alt="" class="p-5" />
      <p class="text-sky-500 bg-sky-200/40 rounded-sm font-semibold">
        Promotions
      </p>
    </div>
    <div class="feature-box">
      <img src="layout/images/features/f5.png" alt="" class="p-5" />
      <p class="text-sky-500 bg-sky-200/40 rounded-sm font-semibold">
        Happy Sell
      </p>
    </div>
    <div class="feature-box">
      <img src="layout/images/features/f6.png" alt="" class="p-5" />
      <p class="text-sky-500 bg-sky-200/40 rounded-sm font-semibold">
        24/7 Service
      </p>
    </div>
  </section>



  <!-- men products section -->
  <section id="feature-products" class="py-8 px-20 mt-5">
    <h2 class="text-5xl font-bold  text-center">Men Category</h2>
    <p class="text-lg text-slate-500  text-center">Summer Collection New Modern Design</p>
    <div class="flex justify-between py-5 flex-wrap">
      <?php foreach ($menCloth as $men) : ?>
        <div
          class="w-[23%] min-w-64 py-2 px-3 border-2 rounded-md shadow-md mt-4 mx-0 cursor-pointer hover:shadow-xl"
          onclick="window.location.href='./pages/single_product.php?id=<?php echo ($men->ProductId); ?>'">
          <img src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $men->P_image1; ?>" alt="" />
          <div class="flex justify-between py-3 relative">
            <div class="px-2">
              <span class="text-lg text-slate-500">adidas</span>
              <p class="text-xl font-bold"><?php echo $men->P_name; ?></p>
              <div class="text-yellow-400 text-sm">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
              <p class="text-red-400 font-bold"><?php echo $men->P_price; ?></p>
            </div>
            <div>
              <a href="#">
                <div
                  class="h-11 w-11 bg-slate-200 rounded-full flex items-center justify-center absolute right-2 bottom-4">
                  <i
                    class="fa-solid fa-cart-arrow-down text-xl text-sky-500"></i>
                </div>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- women products section -->
  <section id="feature-products" class="py-8 px-20 mt-5">
    <h2 class="text-5xl font-bold  text-center">Women Category</h2>
    <p class="text-lg text-slate-500  text-center">Summer Collection New Modern Design</p>
    <div class="flex justify-between py-5 flex-wrap">
      <?php foreach ($womenCloth as $women) : ?>
        <div
          class="w-[23%] min-w-64 py-2 px-3 border-2 rounded-md shadow-md mt-4 mx-0 cursor-pointer hover:shadow-xl"
          onclick="window.location.href='./pages/single_product.php?id=<?php echo ($women->ProductId); ?>'">
          <img src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $women->P_image1; ?>" alt="" />
          <div class="flex justify-between py-3 relative">
            <div class="px-2">
              <span class="text-lg text-slate-500">adidas</span>
              <p class="text-xl font-bold"><?php echo $women->P_name; ?></p>
              <div class="text-yellow-400 text-sm">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
              <p class="text-red-400 font-bold"><?php echo $women->P_price; ?></p>
            </div>
            <div>
              <a href="#">
                <div
                  class="h-11 w-11 bg-slate-200 rounded-full flex items-center justify-center absolute right-2 bottom-4">
                  <i
                    class="fa-solid fa-cart-arrow-down text-xl text-sky-500"></i>
                </div>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- kids products section -->
  <section id="feature-products" class="py-8 px-20 mt-5">
    <h2 class="text-5xl font-bold  text-center">Kids Category</h2>
    <p class="text-lg text-slate-500  text-center">Summer Collection New Modern Design</p>
    <div class="flex justify-between py-5 flex-wrap">
      <?php foreach ($kidsCloth as $kids) : ?>
        <div
          class="w-[23%] min-w-64 py-2 px-3 border-2 rounded-md shadow-md mt-4 mx-0 cursor-pointer hover:shadow-xl"
          onclick="window.location.href='./pages/single_product.php?id=<?php echo ($kids->ProductId); ?>'">
          <img src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $kids->P_image1; ?>" alt="" />
          <div class="flex justify-between py-3 relative">
            <div class="px-2">
              <span class="text-lg text-slate-500">adidas</span>
              <p class="text-xl font-bold"><?php echo $kids->P_name; ?></p>
              <div class="text-yellow-400 text-sm">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
              <p class="text-red-400 font-bold"><?php echo $kids->P_price; ?></p>
            </div>
            <div>
              <a href="#">
                <div
                  class="h-11 w-11 bg-slate-200 rounded-full flex items-center justify-center absolute right-2 bottom-4">
                  <i
                    class="fa-solid fa-cart-arrow-down text-xl text-sky-500"></i>
                </div>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>


  <!-- banner -->
  <section id="banner" class="py-8 px-20">
    <div
      class="flex flex-col text-center items-center text-white bg-sky-400/90 py-7 px-8 rounded-md">
      <p class="text-xl mb-1">Fast Delivery</p>
      <h2 class="text-5xl font-bold mb-2">
        Up to <span>60% Off</span> - All Fashions
      </h2>
      <a
        href="http://localhost/LiteFashionDarkDevils/user/pages/list_products.php"
        class="py-2 px-4 border-2 font-semibold rounded-md hover:text-sky-400 hover:bg-white/90">
        Explore More
      </a>
    </div>
  </section>

  <!-- footer -->
  <?php include_once 'includes/footer.php' ?>

  <script src="layout/js/script.js"></script>
</body>

</html>