<?php

include 'components/connect.php';

session_start();

if (isset($_COOKIE['emailid']) && isset($_COOKIE['password'])) {
   $emailid = $_COOKIE['emailid'];
   $password = $_COOKIE['password'];
}else
{
   $emailid = $password = "";
}

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      if(isset($_REQUEST['rememberMe']))
      {
         setcookie('emailid', $_REQUEST['email'], time() + 60*60); //luu cookie trong 1 gio
         setcookie('password', $_REQUEST['pass'], time() + 60*60); //luu cookie trong 1 gio
      }else
      {
         setcookie('emailid', $_REQUEST['email'], time() - 10);
         setcookie('password', $_REQUEST['pass'], time() - 10);
      }
      header('location:home.php');
   }else{
      $message[] = 'tên đăng nhập hoặc mật khẩu không chính xác';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
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
      <h3>đăng nhập</h3>
      <input type="email" name="email" required placeholder="nhập địa chỉ email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?php echo  $emailid; ?>">
      <input type="password" name="pass" required placeholder="nhập mật khẩu" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?php echo  $password; ?>">
      <div class="check">
         <label><input type="checkbox" name="rememberMe"> Nhớ với tôi</label>
         <a href="forgot_password.php">Quên mật khẩu?</a>
      </div>
      <input type="submit" value="đăng nhập" class="btn" name="submit">
      <p>bạn chưa có tài khoản?</p>
      <a href="user_register.php" class="option-btn">đăng ký</a>
   </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>