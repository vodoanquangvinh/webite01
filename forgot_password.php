<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if (isset($_POST['submit']) == true) {
   $email = $_POST['email'];
   $conn = new PDO("mysql:host=localhost;dbname=tech_db;charset=utf8", "root", "");
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $sql = "SELECT * FROM users WHERE email = ?";
   $stmt = $conn->prepare($sql); //tao 1 prepare stement
   $stmt->execute([$email]);
   $count = $stmt->rowCount();
   if ($count == 0) {
      $message[] = 'Email bạn không có trên hệ thống, vui lòng kiểm tra lại email hoặc đăng ký tài khoản';
      //$error = "Email bạn không có trong cơ sở dữ liệu"; // error message
   }
   else {
      $passnew = substr( md5( rand(0,999999)), 0, 8);
      $sql = "UPDATE users SET password = ? WHERE email = ?";
      $stmt = $conn->prepare($sql); //tao 1 prepare stement
      $stmt->execute([$passnew, $email]);  
      $kq = SendPass($email, $passnew);
      if ($kq==true){
         header("Location:user_login.php");
      }
      else{

      }
   }
}

function SendPass($email, $passnew) {
   require "PHPMailer-master/src/PHPMailer.php"; 
   require "PHPMailer-master/src/SMTP.php"; 
   require 'PHPMailer-master/src/Exception.php'; 
   $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
   try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug
        $mail->isSMTP();  
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'vodoanquangvinh@gmail.com'; // SMTP username
        $mail->Password = 'boozvhswiqzfmfoj';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to               
        $mail->setFrom('vodoanquangvinh@gmail.com', 'Vo Doan Quang Vinh' ); 
        $mail->addAddress($email); 
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Thư gửi lại mật khẩu';
        $noidungthu = "<p>Bạn nhận được thư này, do bạn hoặc ai đó đã yêu cầu cấp lại mật khẩu từ Website WatchIT</p>
            Mật khẩu của bạn là: {$passnew}
         "; 
        $mail->Body = $noidungthu;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        return true;
   } catch (Exception $e) {
        return false;
   }
}
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>forgot password</title>
      <link rel="icon" type="image/x-icon" href="../website01/images/watch-icon.png"/>
      
      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">

   </head>

   <body>
      
      <?php include 'components/user_header.php'; ?>

      <section class="form-container">

         <form action="#" method="post">
            <h3>quên mật khẩu</h3>
            <input value="<?php if (isset($email)==true) echo $email?>" type="email" name="email" required placeholder="nhập địa chỉ email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id="email">
            <input type="submit" value="Gửi yêu cầu" class="btn" name="submit">
            <p>bạn có muốn trở về đăng nhập hoặc đăng ký?</p>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">đăng ký</a>
               <a href="user_login.php" class="option-btn">đăng nhập</a>
            </div>
         </form>

      </section>

      <?php include 'components/footer.php'; ?>

      <script src="js/script.js"></script>

   </body>

</html>