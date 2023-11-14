<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'trạng thái thanh toán được cập nhật';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="orders">

<h1 class="heading">đặt hàng</h1>

<div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Thời gian đặt hàng: <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Tên người dùng: <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Số điện thoại: <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Địa chỉ: <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Tổng sản phẩm: <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Tổng giá tiền: <span><?= number_format($fetch_orders['total_price'], 0, ',', '.'); ?> VND</span> </p>
      <p> phương thức thanh toán: <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="đang xử lý đơn hàng">đang xử lý đơn hàng</option>
            <option value="đã chuẩn bị hàng">đã chuẩn bị hàng</option>
            <option value="đang vận chuyển">đang vận chuyển</option>
            <option value="đang giao hàng">đang giao hàng</option>
            <option value="giao hàng thành công">giao hàng thành công</option>
            <option value="đơn hàng bị hủy">đơn hàng bị hủy</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="cập nhật" class="option-btn" name="update_payment">
         <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('bạn có chắc chắn xóa đơn hàng không?');">xóa</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">chưa có đơn hàng nào được đặt!</p>';
      }
   ?>

</div>

</section>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>