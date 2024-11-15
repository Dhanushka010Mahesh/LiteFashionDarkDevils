<?php
require_once('../includes/config.php');
?>
<?php

if (isset($_POST['submit'])) {
  $userid = trim($_POST['U_id']);
  $clothid = trim($_POST['P_id']);
  $name = trim($_POST['P_name']);
  $image = trim($_POST['P_image']);
  $qty = trim($_POST['P_qty']);
  $price = trim($_POST['P_price']);
  $size = trim($_POST['P_size']);

  if (empty($userid)) {
    echo "first login";
  } else {
    $insertdata = $connection->prepare("insert into cart(ProductId,CustermerId,P_name,P_price,P_image1,S_qty,S_size) 
          values(:ProductId, :CustermerId, :P_name, :P_price, :P_image1 , :S_qty , :S_size)");

    $insertdata->execute([
      ":ProductId" => $clothid,
      ":CustermerId" => $userid,
      ":P_name" => $name,
      ":P_price" => $price,
      ":P_image1" => $image,
      ":S_qty" => $qty,
      ":S_size" => $size
    ]);
  }
}

if (isset($_GET['id'])) {
  $productID = trim($_GET['id']);
  $singleProduct = $connection->query("select * from clothProduct where P_status=1 and ProductId='$productID'");
  $singleProduct->execute();
  $oneClothData = $singleProduct->fetch(PDO::FETCH_OBJ);


  $reletedCloth = $connection->query("select * from clothProduct where P_status=1 and P_categoryId='$oneClothData->P_categoryId' and ProductId != '$productID' LIMIT 4");
  $reletedCloth->execute();
  $allReletedCloth = $reletedCloth->fetchAll(PDO::FETCH_OBJ);
} else {

}

?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php' ?>

<body>
  <!-- navbar -->
  <?php include_once '../includes/navbar.php' ?>

  <?php
  if (isset($_GET['id'])) {
    if (isset($_SESSION['cus_Id'])) {
      $isCartAdded = $connection->query("select * from cart where ProductId='{$_GET['id']}' and CustermerId='{$_SESSION['cus_Id']}'");
      $isCartAdded->execute();
    }
  }
  ?>

  <!-- product details section -->
  <section id="product-details" class="py-8 px-40 mt-5 flex">
    <div class="w-[40%] mr-12">
      <img
        src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $oneClothData->P_image1; ?>"
        width="100%"
        class="mb-1"
        id="main-image" />
      <div class="flex justify-between gap-1">
        <img
          src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $oneClothData->P_image1; ?>"
          width="100%"
          class="cursor-pointer small-image" />

        <img
          src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $oneClothData->P_image2; ?>"
          width="100%"
          class="cursor-pointer small-image" />

        <img
          src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $oneClothData->P_image3; ?>"
          width="100%"
          class="cursor-pointer small-image" />

        <img
          src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $oneClothData->P_image4; ?>"
          width="100%"
          class="cursor-pointer small-image" />
      </div>
    </div>
    <!-- details -->
    <div class="w-[50%]">
      <p class="text-sm text-slate-600 font-semibold pt-5 pb-3">
        <?php echo ($oneClothData->P_categoryId); ?>
      </p>
      <p class="text-5xl font-bold"><?php echo $oneClothData->P_name; ?></p>
      <h2 class="text-3xl font-bold pb-3 text-red-600">Rs. <?php echo $oneClothData->P_price; ?></h2>
      <form method="POST" id="form-data">

        <input class="form-control" type="hidden" name="P_id" value="<?php echo $oneClothData->ProductId; ?>" required><br>
        <input class="form-control" type="hidden" name="U_id" value="<?php echo ((isset($_SESSION['cus_username'])) ? $_SESSION['cus_Id'] : ''); ?>" required><br>
        <input class="form-control" type="hidden" name="P_name" value="<?php echo $oneClothData->P_name; ?>" required><br>
        <input class="form-control" type="hidden" name="P_price" value="<?php echo $oneClothData->P_price; ?>" required><br>
        <input class="form-control" type="hidden" name="P_image" value="<?php echo $oneClothData->P_image1; ?>" required><br>
        <select name="P_size"
          class="form-control block py-1 px-5 mb-2 bg-sky-100 border-2 border-sky-300 rounded-sm mb-4">
          <?php if ($oneClothData->P_small == 1) : ?>
            <option value="Small">Small</option>
          <?php endif; ?>
          <?php if ($oneClothData->P_medium) : ?>
            <option value="Medium">Medium</option>
          <?php endif; ?>
          <?php if ($oneClothData->P_large) : ?>
            <option value="Large">Large</option>
          <?php endif; ?>
          <?php if ($oneClothData->P_extraLarge) : ?>
            <option value="Extra Large">Extra Large</option>
          <?php endif; ?>

        </select>
        <input type="number" name="P_qty" value="<?php echo $oneClothData->P_quantity; ?>"
          class="form-control w-12 focus:outline-none border-slate-400 rounded-sm border-2 p-1 mr-3" required />
        <?php if (isset($_SESSION['cus_username'])) : ?>
          <?php if ($isCartAdded->rowCount() > 0) : ?>

            <button class="btn-insert py-2 px-5 bg-sky-500 text-white rounded-sm" type="submit" name="submit" disabled>Added to Cart</button>
          <?php else : ?>
            <button class="btn-insert py-2 px-5 bg-sky-500 text-white rounded-sm" type="submit" name="submit">Add to Cart</button>
          <?php endif; ?>
        <?php else: ?>
          <h5 style="color: red;">Frist login website</h5>
        <?php endif; ?>

      </form>
      <h2 class="text-xl font-semibold pb-1 mt-8">Product Details</h2>
      <span class="text-slate-600"><?php echo $oneClothData->P_description; ?></span>
    </div>
  </section>

  <!-- related products section -->
  <section id="feature-products" class="py-8 px-20 mt-5">
    <div class="text-center">
      <h2 class="text-5xl font-bold">Feature Products</h2>
      <p class="text-lg text-slate-500">
        Summer Collection New Modern Design
      </p>
    </div>
    <div class="flex justify-between py-5 flex-wrap">
      <?php foreach ($allReletedCloth as $reletedCloth) : ?>
        <div
          class="w-[23%] min-w-64 py-2 px-3 border-2 rounded-md shadow-md mt-4 mx-0 cursor-pointer hover:shadow-xl"
          onclick="window.location.href='single_product.php?id=<?php echo ($reletedCloth->ProductId); ?>'">
          <img src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $reletedCloth->P_image1; ?>" alt="" />
          <div class="flex justify-between py-3 relative">
            <div class="px-2">
              <span class="text-lg text-slate-500"><?php echo ($reletedCloth->P_categoryId); ?></span>
              <p class="text-xl font-bold"><?php echo $reletedCloth->P_name; ?></p>
              <div class="text-yellow-400 text-sm">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
              <p class="text-red-400 font-bold">Rs. <?php echo $reletedCloth->P_price; ?></p>
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

  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Check if elements exist for debugging
      const form = document.getElementById("form-data");
      const btnInsert = document.querySelector(".btn-insert");

      if (!form || !btnInsert) {
        console.error("Form or button element not found.");
        return;
      }

      // Prevent the user from entering 0 or less than 0 value
      document.querySelectorAll(".form-control").forEach(function(input) {
        input.addEventListener("input", function() {
          let value = input.value.replace(/^(0*)/, "");
          input.value = value || 1;
        });
      });

      // Prevent page reload on form submit
      btnInsert.addEventListener("click", function(e) {
        e.preventDefault();

        let formData = new FormData(form);
        formData.append('submit', 'submit');

        fetch("Single_product.php?id=<?php echo $_GET['id']; ?>", {
            method: "POST",
            body: formData
          })
          .then(response => response.text())
          .then(data => {
            console.log("Server response:", data); 
            alert("Product added to cart");

                // Disable the add to cart button and change its text
                btnInsert.innerHTML = "<i class='addCss'></i>Added to Cart";
                btnInsert.disabled = true;
                //LoadRef();
            })
            .catch(error => console.error("Fetch error:", error));
        });
    });
    function LoadRef() {
  fetch("single_product.php")
    .then(response => response.text())
    .then(html => {
      document.body.innerHTML = html;
    })
    .catch(error => {
      console.error('Error loading content:', error);
    });
}
</script>


</body>

</html>