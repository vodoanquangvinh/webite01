<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" placeholder="tìm kiếm tại đây" maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>

<section class="show-products">

   <h1 class="heading">sản phẩm đã thêm</h1>

   <div class="product-display">

   <table class="product-display-table">
      <thead>
         <tr>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Tùy chỉnh</th>
         </tr>
      </thead>

      <?php
        if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'"); //Phan theo bang name
            $select_products->execute();
            if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>

         <tr>
            <td class="name"><input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>"><?= $fetch_products['name']; ?></td>
            <td class="price"><span><?= number_format($fetch_products['price'], 0, ',', '.'); ?></span> VND</td>
            <td><img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" height="100" alt=""></td>
            <td class="details"><span><?= $fetch_products['details']; ?></span></td>
            <td>
               <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn-pro">Cập nhật</a>
               <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn-pro" onclick="return confirm('Bạn có chắc chắn xóa sản phẩm hay không?');">xóa</a>
            </td>
         </tr>

      <?php
            }
         }else{
            echo '<p class="empty">không có sản phẩm nào được thêm ở đây!</p>';
         }
    }
      ?>

   </table>
   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>