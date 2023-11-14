<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['flat'] .', '. $_POST['street'] .' , '. $_POST['pin_code'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'đặt hàng thành công';
   }else{
      $message[] = 'không có sản phẩm trong giỏ hàng';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>đơn hàng của bạn</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>[<?= 'Giá: '.number_format($fetch_cart['price'], 0, ',', '.').' VND x Số lượng: '. $fetch_cart['quantity']; ?>]</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">không có sản phẩm trong giỏ hàng</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">tổng cộng: <span><?= number_format($grand_total, 0, ',', '.'); ?> VND</span></div>
      </div>

      <h3>thông tin đặt hàng</h3>

      <div class="flex">
         <div class="inputBox">
            <span>họ và tên:</span>
            <input type="text" name="name" placeholder="nhập họ và tên" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>số điện thoại:</span>
            <input type="number" name="number" placeholder="nhập số điện thoại" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>địa chỉ email:</span>
            <input type="email" name="email" placeholder="nhập địa chỉ email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>phương thức thanh toán:</span>
            <select name="method" class="box" required>
               <option value="thanh toán khi nhận hàng">thanh toán khi nhận hàng</option>
               <option value="thanh toán qua thẻ tín dụng">qua thẻ tín dụng</option>
               <option value="ví điện tử momo">ví momo</option>
               <option value="thanh toán qua ZaloPay">zalopay</option>
            </select>
         </div>
         <div class="inputBox">
            <span>địa chỉ nhà:</span>
            <input type="text" name="flat" placeholder="nhập địa chỉ nhà" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>tên đường:</span>
            <input type="text" name="street" placeholder="nhập tên đưởng" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>khu vực:</span>
            <input type="text" name="pin_code" placeholder="nhập khu vực" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>xã, phường:</span>
            <input type="text" name="city" placeholder="nhập xã, phường" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>quận, huyện:</span>
            <input type="text" name="state" placeholder="nhập quận, huyện" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>tỉnh, thành phố:</span>
            <input type="text" name="country" placeholder="nhập tỉnh, thành phố" class="box" maxlength="50" required>
         </div>
         
      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="đặt hàng">

   </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>