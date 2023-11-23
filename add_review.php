<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:home.php');
}

if(isset($_POST['submit'])){

   if($user_id != ''){
      $id = create_unique_id();
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $description = $_POST['description'];
      $description = filter_var($description, FILTER_SANITIZE_STRING);
      $rating = $_POST['rating'];
      $rating = filter_var($rating, FILTER_SANITIZE_STRING);

      $verify_review = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ? AND user_id = ?");
      $verify_review->execute([$get_id, $user_id]);

      if($verify_review->rowCount() > 0){
         $warning_msg[] = 'Bạn đã thêm đánh giá trước đó!';
      }else{
         $add_review = $conn->prepare("INSERT INTO `reviews`(id, post_id, user_id, rating, title, description) VALUES(?,?,?,?,?,?)");
         $add_review->execute([$id, $get_id, $user_id, $rating, $title, $description]);
         $success_msg[] = 'Đã thêm đánh giá!';
      }

   }else{
      $warning_msg[] = 'Vui lòng đăng nhập!';
   }
}

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add review</title>

   <link rel="icon" type="image/x-icon" href="../website01/images/watch-icon.png"/>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- add review section starts  -->

<section class="account-form">

   <form action="" method="post">
      <h3>đánh giá của bạn</h3>
      <p class="placeholder">tiêu đề đánh giá<span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="nhập tiêu đề của bạn" class="box">
      <p class="placeholder">nội dung đánh giá</p>
      <textarea name="description" class="box" placeholder="nhập nội dung đánh giá của bạn" maxlength="1000" cols="30" rows="10"></textarea>
      <p class="placeholder">đánh giá sao<span>*</span></p>
      <select name="rating" class="box" required>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="gửi đánh giá" name="submit" class="btn">
      <a href="view_post.php?get_id=<?= $get_id; ?>" class="option-btn">quay về</a>
   </form>

</section>

<!-- add review section ends -->


<!-- custom js file link  -->
<?php include 'components/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>