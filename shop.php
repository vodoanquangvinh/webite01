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
   <title>shop</title>

   <link rel="icon" type="image/x-icon" href="../website01/images/watch-icon.png"/>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"charset="utf-8"></script>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">
   <h1 class="heading">sản phẩm mới nhất</h1>

<div class="container">

   <div class="box-container" style="display: none">
   
   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`"); 
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
      echo '<p class="empty">không có sản phẩm nào ở đây</p>';
   }
   ?>

   </div>

   <div class="pagination">
         <li class="page-item previous-page disable"><a class="page-link" href="#">Trước</a></li>
         <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
         <li class="page-item dots"><a class="page-link" href="#">...</a></li>
         <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
         <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
         <li class="page-item dots"><a class="page-link" href="#">...</a></li>
         <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
         <li class="page-item next-page"><a class="page-link" href="#">Sau</a></li>
   </div>


 </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

   <script type="text/javascript">
   function getPageList(totalPages, page, maxLength) {
      function range(start, end) {
         return Array.from(Array(end - start + 1), (_, i) => i +start);
      }

   var sideWidth = maxLength < 9 ? 1 : 2;
   var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
   var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;

   if(totalPages <= maxLength){
      return range(1, totalPages);
   }

   if(page <= maxLength - sideWidth - 1 - rightWidth){
      return range(1, maxLength - sideWidth -1).concat(0, range(totalPages - sideWidth +1, totalPages));
   }

   if(page >= totalPages - sideWidth  - 1 - rightWidth){
      return range(1, sideWidth).concat(0, range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
   }

   return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
   }

   $(function(){
      var numberOfItems = $(".box-container .box").length;
      var limitPerPage = 12;
      var totalPages = Math.ceil(numberOfItems / limitPerPage);
      var paginationSize = 7;
      var currentPage;

      function showPage(whichPage){
         if(whichPage < 1 || whichPage > totalPages) return false;

         currentPage = whichPage;

         $(".box-container .box").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();

         $(".pagination li").slice(1, -1).remove();

         getPageList(totalPages, currentPage, paginationSize).forEach(item => {
               $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots")
               .toggleClass("active", item === currentPage).append($("<a>").addClass("page-link")
               .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-page");
         });

         $(".previous-page").toggleClass("disable", currentPage === 1);
         $(".next-page").toggleClass("disable", currentPage === totalPages);
         return true;
      }

      $(".pagination").append(
         $("<li>").addClass("page-item").addClass("previous-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Trước")),
         $("<li>").addClass("page-item").addClass("next-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Sau"))
      );

      $(".box-container").show();
      showPage(1);

      $(document).on("click", ".pagination li.current-page:not(.active)",function(){
         return showPage(+$(this).text());
      });

      $(".next-page").on("click", function(){
         return showPage(currentPage + 1);
      });

      $(".previous-page").on("click", function(){
         return showPage(currentPage - 1);
      });
   });
   </script>

</body>
</html>