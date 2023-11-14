<footer class="footer">

   <section class="grid">

      <div class="box">
         <h3>truy cập nhanh</h3>
         <a href="home.php"> <i class="fa-solid fa-quote-right"></i> Trang chủ</a>
         <a href="about.php"> <i class="fa-solid fa-quote-right"></i> Về chúng tôi</a>
         <a href="shop.php"> <i class="fa-solid fa-quote-right"></i> Mua hàng</a>
         <a href="contact.php"> <i class="fa-solid fa-quote-right"></i> Liên hệ</a>
      </div>

      <div class="box">
         <h3>liên kết</h3>
         <a href="user_login.php"> <i class="fa-solid fa-quote-right"></i> Đăng nhập</a>
         <a href="user_register.php"> <i class="fa-solid fa-quote-right"></i> Đăng ký</a>
         <a href="cart.php"> <i class="fa-solid fa-quote-right"></i> Giỏ hàng</a>
         <a href="orders.php"> <i class="fa-solid fa-quote-right"></i> Đơn hàng</a>
      </div>

      <div class="box">
         <h3>liên hệ với chúng tôi</h3>
         <a href="tel:0949332107"><i class="fa-solid fa-tty"></i> 0949.332.107</a>
         <a href="tel:0332148867"><i class="fa-solid fa-square-phone"></i> 0332.148.867</a>
         <a href="mailto:vodoanquangvinh@gmail.com"><i class="fas fa-envelope"></i> quangvinh@gmail.com</a>
         <a href="https://www.google.com/ctu"><i class="fa-solid fa-map-location"></i> cantho, vietnam </a>
      </div>

      <div class="box">
         <h3>theo dõi chúng tôi</h3>
         <a href="#"><i class="fa-brands fa-facebook"></i>facebook</a>
         <a href="#"><i class="fa-brands fa-twitter"></i>twitter</a>
         <a href="#"><i class="fab fa-instagram"></i>instagram</a>
         <a href="#"><i class="fab fa-google"></i>google</a>
      </div>

   </section>
   
   <div class="credit">BẠN CẦN ĐỒNG HỒ, THẬT MAY MẮN VÌ CHÚNG TÔI LÀ <span>NGƯỜI BÁN THỜI GIAN</span></div>

   <div id="container-chat">
      <a href="contact.php" class="fa-solid fa-message fa-bounce fa-2xl"></a>
   </div>

   <div id="container-phone">
         <a href="contact.php" class="fa-solid fa-phone fa-shake fa-2xl"></a>
   </div>
   
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

</footer>