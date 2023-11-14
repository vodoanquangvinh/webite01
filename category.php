<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <link rel="icon" type="image/x-icon" href="../website01/images/watch-icon.png"/>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

         <div class="pro-container">

            <div class="pro-box">
               <img src="images/apple-logo.png" alt="">
               <a href="category.php?category=apple" class="btn">apple</a> 
            </div>

            <div class="pro-box">
               <img src="images/garmin-logo.png" alt=""> 
               <a href="category.php?category=garmin" class="btn">garmin</a> 
            </div>

            <div class="pro-box">
               <img src="images/amazfit-logo.png" alt=""> 
               <a href="category.php?category=amazfit" class="btn">amazfit</a> 
            </div>

            <div class="pro-box">
               <img src="images/huawei-logo.png" alt=""> 
               <a href="category.php?category=huawei" class="btn">huawei</a> 
            </div>

            <div class="pro-box">
               <img src="images/samsung-logo.png" alt=""> 
               <a href="category.php?category=samsung" class="btn">samsung</a> 
            </div>

            <div class="pro-box">
               <img src="images/soundpeats-logo.png" alt="">
               <a href="category.php?category=soudpeats" class="btn">soudpeats</a>  
            </div>

            <div class="pro-box">
               <img src="images/xiaomi-logo.png" alt="">  
               <a href="category.php?category=xiaomi" class="btn">xiaomi</a>
            </div>

         </div>

   <h1 class="heading">phân loại</h1>

   <div class="box-show">
   <?php
      $category = $_GET['category'];
      echo '<form class="show"> <a>Nhãn hiệu: </a>'.$category.'</form>';
   ?>
   </div>
   
   <div class="box-container">
   <?php
     $category = $_GET['category'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$category}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
         <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
         <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
         <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
         <div class="name"><?= $fetch_product['name']; ?></div>
         <div class="flex">
            <div class="price"><span>Giá: </span><?= number_format($fetch_product['price'], 0, ',', '.'); ?><span> VND</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
         </div>
         <input type="submit" value="thêm vào giỏ hàng" class="btn" name="add_to_cart">
      </form>
   <?php
      }
   }else{
      echo '<p class="empty">không có sản phẩm nào</p>';
   }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>