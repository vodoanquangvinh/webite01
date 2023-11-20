<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="icon" type="image/x-icon" href="../website01/images/watch-icon.png"/>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>Tại sao bạn nên lựa chọn WatchIT?</h3>
         <p>Bởi vì chúng tôi là một Website cung cấp toàn diện về nhu cầu mua sắm của khách hàng. Tất cả các sản phẩm đồng hồ thông minh mà chúng tôi cung cấp đều đảm bảo chính sách bảo hàng 100%. Cho phép khách hàng kiểm tra sản phẩm trước khi nhận hàng. Đặc biệt, chúng tôi có chính sách đổi trả lên đến 12 tháng.</p>
         <a href="contact.php" class="btn">liên hệ</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">đánh giá từ phía khách hàng</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/01-avatar.jpg" alt="">
         <p>Chính sách bảo hành của WatchIT khiến tôi rất hài lòng, sản phẩm chính hãng, giá thành hợp lý. Tìm kiếm theo giá rất thích hợp luôn nhe.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nguyễn Thị Xuân Lan</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/02-avatar.jpg" alt="">
         <p>Giao hàng siêu nhanh, đổi trả trong 24 giờ, nhân viên tư vấn nhiệt tình. Giao hàng tận nơi sản phẩm rất là oke luôn.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Lê Long Phú</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/03-avatar.jpg" alt="">
         <p>Trang Web có phân loại sản phẩm theo các hãng khác nhau khiến mình rất thích. Sẽ giới thiệu bạn bè đến ủng hộ shop nhiều hơn.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nguyễn Văn Thạnh</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/04-avatar.jpg" alt="">
         <p>Phải nói là siêu ưng luôn, đồng hồ siêu xịn, giao hàng nhanh mới đặt hôm qua thì hôm nay đã có hàng. Chấm 10 điểm cho shop.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Trần Hào</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/05-avatar.jpg" alt="">
         <p>Không có gì bàn cãi hết, sản phẩm quá tuyệt vời, lần đầu tiên mua tại WatchIT nhưng thất rất oke luôn nha.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Lê Trần Thảo Vy</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/06-avatar.jpg" alt="">
         <p>Sản phẩm của Website luôn cập nhật mẫu mã mới, dễ lựa chọn và có nhiều sản phẩm phù hợp với giá tiền, lại còn được freeship nữa chứ.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nguyễn Trọng Tín</h3>
      </div>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>