<?php  
  require_once ('../includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php' ?>

<body>
  <!-- navbar -->
  <?php include_once '../includes/navbar.php' ?>

  <?php

if(!isset($_SESSION['username'])){
  echo "<script> window.location.href='http://localhost/LiteFashionDarkDevils/user/'; </script>";
}

  $cartItems=$connection->query("select * from cart where CustermerId='{$_SESSION['custormerId']}'");
  $cartItems->execute();

  $allCartItems=$cartItems->fetchAll(PDO::FETCH_OBJ);
  ?>

  <!-- page header -->
  <section
    id="page-header-about"
    class="flex flex-col py-0 px-20 text-center justify-center">
    <h1 class="text-6xl font-semibold text-white/90 p-3">Cart</h1>
    <p class="text-white/80">Add your coupon code & SAVE upto 60%</p>
  </section>

  <!-- cart items -->
  <section class="py-10 px-20">
    <div class="items-center text-center">
      <div
        class="grid grid-cols-7 px-20 py-3 mx-auto text-lg font-semibold bg-slate-200 mb-1 text-center rounded-md">
        <p>Image</p>
        <p>Product</p>
        <p>Price</p>
        <p>Quantity</p>
        <p>Update</p>
        <p>SubTotal</p>
        <p>Remove</p>
      </div>
      <?php if(count($allCartItems)>0) : ?>
      <?php foreach($allCartItems as $cart) : ?>
      <div
        class="grid grid-cols-7 px-20 py-3 items-center text-center justify-items-center">
        <img src="http://localhost/LiteFashionDarkDevils/admin/uploads/<?php echo $cart->P_image1; ?>" alt="" class="w-20" />
        <p><?php echo $cart->P_name; ?></p>
        <p class="pro_price"><?php echo $cart->P_price; ?></p>
        <input type="number" value="<?php echo $cart->S_qty; ?>" class=" pro_qty w-12 pl-2 border" />
        <button value="<?php echo $cart->S_cartId; ?>" class="btn-update" style="background-color: greenyellow; border-radius:10px; padding:2px;">Save</button>
        <p class="total_price" ><?php echo "RS : ".(($cart->S_qty)*($cart->P_price)); ?></p>
        <button value="<?php echo $cart->S_cartId; ?>" class="btn-delete" ><i class="fa-solid fa-x text-red-600 cursor-pointer"></i></button>
      </div>
      <?php endforeach; ?>
      <?php else : ?>
        <h6 style="color: red;" >no product have</h6>
      <?php endif; ?>

    </div>
  </section>

  <!-- coupon and total amount -->
  <section class="py-10 px-20 mx-20">
    <div class="flex">
      <div class="w-2/3">
        <h2 class="text-lg font-semibold pb-2">Apply Coupon</h2>
        <div class="flex gap-5">
          <input
            type="text"
            placeholder="Enter coupon number"
            class="border-2 border-sky-300 rounded-md py-1 px-2 w-[300px]" />
          <button class="bg-sky-500 text-white py-1 px-6 rounded-md">
            Apply
          </button>
        </div>
      </div>
      <div class="w-1/3 border-2 border-sky-400 bg-sky-100/50 p-8 rounded-lg">
        <h1 class="text-2xl font-bold pb-3">CART TOTALS</h1>
        <div class="w-[300px] text-lg text-slate-700 gap-2">
          <div class="flex justify-between">
            <p>Subtotal</p>
            <p class="full_price">Rs.0.00</p>
          </div>
          <div class="flex justify-between">
            <p>Shipping</p>
            <p>Free</p>
          </div>
          <div class="flex justify-between my-4">
            <p class="font-semibold">Total</p>
            <p class="font-semibold">Rs.0.00</p>
          </div>
          <!-- <button class="bg-red-500 text-white py-2 px-6 rounded-md mt-8">
              Proceed to Checkout
            </button> -->
          <a
            href="place_order.php"
            class="bg-red-500 text-white py-3 px-6 rounded-md mt-8">
            Proceed to Checkout
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
  <script>
    document.querySelectorAll('.pro_qty').forEach(input => {
    input.addEventListener('mouseup', () => {
        const container = input.closest('div');
        
        const proQty = input.value;
        const proPrice = parseFloat(container.querySelector('.pro_price').textContent);
        
        const total = proPrice * proQty;
        const totalPriceEl = container.querySelector('.total_price');
        totalPriceEl.textContent = "RS : " + total;
    });

    document.querySelectorAll('.btn-update').forEach(button => {
    button.replaceWith(button.cloneNode(true)); 
    });

    document.querySelectorAll('.btn-update').forEach(button => {
    button.addEventListener('click', function(e) {
        const id = this.value;
        const container = this.closest('div');
        const proQty = container.querySelector('.pro_qty').value;
        
        fetch("cart_update.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `update=update&id=${id}&pro_qty=${proQty}`
        })
        .then(response => response.text())
        .then(data => {
          alert("Updated");
        })
        .catch(error => {
          alert('Error');
        });
    });

    document.querySelectorAll('.btn-delete').forEach(button => {
    button.replaceWith(button.cloneNode(true)); 
    });
    document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        const id = this.value;
        
        fetch("cart_delete.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `delete=delete&id=${id}`
        })
        .then(response => response.text())
        .then(data => {
          alert("Deleted");
          reload();
        })
        .catch(error => {
          alert('Error');
        });
    });

  });

    
});

calTotalPrice();
function calTotalPrice() {
  setInterval(function() {
    let sum = 0.0;
    
    // Select all elements with the class 'total_price' and calculate the sum
    document.querySelectorAll('.total_price').forEach(element => {
      sum += parseFloat(element.textContent.replace('RS : ', '')) || 0;
    });

    // Update the content of the element with the class 'full_price'
    document.querySelector('.full_price').textContent = 'RS .' + sum.toFixed(2);
  }, 4000);
}

function reload() {
  fetch("cart.php")
    .then(response => response.text())
    .then(html => {
      document.body.innerHTML = html;
    })
    .catch(error => {
      console.error('Error loading content:', error);
    });
}


});

</script>
</body>

</html>