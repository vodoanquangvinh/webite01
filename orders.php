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
   <title>orders</title>
   <link rel="icon" type="image/x-icon" href="../website01/images/watch-icon.png"/>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">đơn hàng đã đặt</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">vui lòng đăng nhập để xem đơn hàng đã đặt</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>thời gian: <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>họ tên: <span><?= $fetch_orders['name']; ?></span></p>
      <p>địa chỉ email: <span><?= $fetch_orders['email']; ?></span></p>
      <p>số điện thoại: <span><?= $fetch_orders['number']; ?></span></p>
      <p>địa chỉ: <span><?= $fetch_orders['address']; ?></span></p>
      <p>phương thức thanh toán: <span><?= $fetch_orders['method']; ?></span></p>
      <p>sản phẩm: <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>tổng cộng: <span><?= number_format($fetch_orders['total_price'], 0, ',', '.'); ?> VND</span></p>
      <p>trạng thái thanh toán: <span style="color:<?php if($fetch_orders['payment_status'] == 'đang xử lý đơn hàng'){ 
                                                            echo 'red'; 
                                                            }else{
                                                               if($fetch_orders['payment_status'] == 'đơn hàng bị hủy'){
                                                                  echo 'orange';
                                                               }else{
                                                                  echo 'green';
                                                               }  
                                                               }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">chưa có đơn hàng nào được đặt</p>';
      }
      }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>