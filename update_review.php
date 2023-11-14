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

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $rating = $_POST['rating'];
   $rating = filter_var($rating, FILTER_SANITIZE_STRING);

   $update_review = $conn->prepare("UPDATE `reviews` SET rating = ?, title = ?, description = ? WHERE id = ?");
   $update_review->execute([$rating, $title, $description, $get_id]);

   $success_msg[] = 'đánh giá đã được cập nhật!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update review</title>

   <link rel="icon" type="image/x-icon" href="../website01/images/watch-icon.png"/>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="account-form">

   <?php
      $select_review = $conn->prepare("SELECT * FROM `reviews` WHERE id = ? LIMIT 1");
      $select_review->execute([$get_id]);
      if($select_review->rowCount() > 0){
         while($fetch_review = $select_review->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post">
      <h3>chỉnh sửa đánh giá của bạn</h3>
      <p class="placeholder">tiêu đề đánh giá<span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="nhập tiêu đề" class="box" value="<?= $fetch_review['title']; ?>">
      <p class="placeholder">nội dung đánh giá</p>
      <textarea name="description" class="box" placeholder="nhập nội dung đánh giá" maxlength="1000" cols="30" rows="10"><?= $fetch_review['description']; ?></textarea>
      <p class="placeholder">đánh giá sao<span>*</span></p>
      <select name="rating" class="box" required>
         <option value="<?= $fetch_review['rating']; ?>"><?= $fetch_review['rating']; ?></option>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="sửa đánh giá" name="submit" class="btn">
      <a href="view_post.php?get_id=<?= $fetch_review['post_id']; ?>" class="option-btn">quay về</a>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">đã xảy ra lỗi!</p>';
      }
   ?>

</section>

<!-- update reviews section ends -->

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>