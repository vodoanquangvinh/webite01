<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo">Admin<span>WatchIT</span></a>

      <nav class="navbar">
         <a href="../admin/dashboard.php">TRANG CHỦ</a>
         <a href="../admin/products.php">SẢN PHẨM</a>
         <a href="../admin/placed_orders.php">ĐƠN HÀNG</a>
         <a href="../admin/admin_accounts.php">QUẢN TRỊ</a>
         <a href="../admin/users_accounts.php">NGƯỜI DÙNG</a>
         <a href="../admin/messages.php">TIN NHẮN</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="../admin/admin_search.php"><i class="fas fa-search"></i></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">cập nhật tài khoản</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">đăng ký</a>
            <a href="../admin/admin_login.php" class="option-btn">đăng nhập</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('bạn có chắc là đăng xuất khỏi Website không?');">đăng xuất</a> 
      </div>

   </section>

   <div id="backtop"> 
      <i class="fa-solid fa-chevron-up fa-2xl"></i>
   </div>
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
   <script>
      $(document).ready(function(){
         $(window).scroll(function(){
               if($(this).scrollTop()){
                  $('#backtop').fadeIn();
               }
               else
               {
                  $('#backtop').fadeOut();
               }
         });
         $('#backtop').click(function(){
               $('html, body').animate({scrollTop: 0}, 400);
         });
      });
   </script>

</header>