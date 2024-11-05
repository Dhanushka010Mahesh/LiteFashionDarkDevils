
<?php
  
  require_once ('../includes/config.php');
?>
<?php
  $categories=$connection->query("select * from clothProduct where P_status=1");
  $categories->execute();

  $allCategories=$categories->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<?php  
  include_once ('../includes/header.php');
?>
<body>

  <!-- navbar -->
<?php 
  include_once ('../includes/navbar.php');
?>

  <!-- page header -->
  <section
    id="page-header-products"
    class="flex flex-col py-0 px-20 text-center justify-center">
    <h1 class="text-6xl font-semibold text-white/90 p-3">#StayHome</h1>
    <p class="text-white/80">Save more with Up to 60% Off - All Fashions</p>
  </section>

  <!-- products section -->
  <section id="products" class="py-8 px-20 mt-5">
    <div class="text-center">
      <h2 class="text-5xl font-bold">Products</h2>
      <p class="text-lg text-slate-500">
        Summer Collection New Modern Design
      </p>
    </div>

    
    <!-- products container-->
    <div class="flex justify-between py-5 flex-wrap">
    <?php foreach($allCategories as $category) : ?>
      <div
        class="w-[23%] min-w-64 py-2 px-3 border-2 rounded-md shadow-md mt-4 mx-0 cursor-pointer hover:shadow-xl"
        onclick="window.location.href='single_product.php?id=<?php echo ($category->ProductId);?>'">
        <img src="http://localhost/LiteFashionDarkDevils/user/layout/images/products/<?php echo $category->P_image1; ?>" alt="" />
        <div class="flex justify-between py-3 relative">
          <div class="px-2">
            <span class="text-lg text-slate-500">adidas</span>
            <p class="text-xl font-bold"> </p><?php echo $category->P_name; ?> </p>
            <div class="text-yellow-400 text-sm">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <p class="text-red-400 font-bold"><?php echo $category->P_price; ?></p>
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
      <?Php endforeach;  ?>
      
    </div>
    
      
  </section>

  <!-- pagination -->
  <section id="pagination" class="py-8 px-20 text-center">
    <div>
      <a href="#" class="bg-sky-500 text-white py-3 px-5 rounded-md">1</a>
      <a href="#" class="bg-sky-500 text-white py-3 px-5 rounded-md">2</a>
      <a href="#" class="bg-sky-500 text-white py-3 px-5 rounded-md"><i class="fa-solid fa-arrow-right-long"></i></a>
    </div>
  </section>

  <!-- banner -->
  <section id="banner" class="py-10 px-20">
    <div
      class="flex flex-col text-center items-center text-white bg-sky-400/90 py-7 px-8 rounded-md">
      <p class="text-xl mb-1">Fast Delivery</p>
      <h2 class="text-5xl font-bold mb-2">
        Up to <span>60% Off</span> - All Fashions
      </h2>
      <button
        class="py-2 px-4 border-2 font-semibold rounded-md hover:text-sky-400 hover:bg-white/90">
        Explore More
      </button>
    </div>
  </section>

  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
</body>

</html>