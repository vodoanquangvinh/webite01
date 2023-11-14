<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'địa chỉ email đã dùng rồi';
   }else{
      if($pass != $cpass){
         $message[] = 'mật khẩu xác nhận không chính xác';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'bạn đã đăng ký thành công, hãy đăng nhập ngay';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="icon" type="image/x-icon" href="../website01/images/watch-icon.png"/>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>đăng ký</h3>
      <input type="text" name="name" required placeholder="nhập tên người dùng" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="nhập địa chỉ email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="nhập mật khẩu" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="xác nhận lại mật khẩu" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="đăng ký" class="btn" name="submit">
      <p>bạn đã có tài khoản?</p>
      <a href="user_login.php" class="option-btn">đăng nhập</a>
   </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>