 <footer id="footer" class="footer">
     <!-- <div class="container">
         <div class="row">
             <div class="col-12">
                 <?php
                    echo "<pre>";
                    print_r($html_menu_main);
                    echo "</pre>";
                    ?>
             </div>
         </div>
     </div> -->

     <div class="footer-newsletter">
         <div class="container">
             <div class="row justify-content-center text-center">
                 <div class="col-lg-6">
                     <h4>Liên hệ với chúng tôi</h4>
                     <p>Tổ chức các giải đấu thể thao uy tín, chuyên nghiệp và sáng tạo để phù hợp với đơn vị của bạn</p>
                     <form action="https://bootstrapmade.com/content/demo/FlexStart/forms/newsletter.php" method="post"
                         class="php-email-form">
                         <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Đăng ký"></div>
                         <div class="loading">Loading</div>
                         <div class="error-message"></div>
                         <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                     </form>
                 </div>
             </div>
         </div>
     </div>

     <div class="container footer-top">
         <div class="row gy-4">
             <div class="col-lg-4 col-md-6 footer-about">
                 <a href="#" class="d-flex align-items-center">
                     <span class="sitename">Sportzone</span>
                 </a>
                 <div class="footer-contact pt-3">
                     <?php echo isset($info_infomation_none['content']) ? $info_infomation_none['content'] : '' ?>
                 </div>
             </div>

             <div class="col-lg-2 col-md-3 footer-links  ">
                 <h4>Danh mục</h4>
                 <ul>
                     <ul>
                         <?php foreach ($menu_in_footer as $value) : ?>
                             <li>
                                 <i class="bi bi-chevron-right "></i><a href="<?php echo $value['lurl'] ?>"><?php echo $value['lname'] ?></a>
                             </li>
                         <?php endforeach ?>
                     </ul>
                 </ul>
             </div>

             <div class="col-lg-2 col-md-3 footer-links">
                 <h4>Dịch vụ</h4>
                 <ul>
                     <?php if (isset($array_menu_services) && !empty($array_menu_services)): ?>
                         <?php foreach ($array_menu_services as $service): ?>
                             <li>
                                 <i class="bi bi-chevron-right"></i>
                                 <a href="<?php echo $service['lurl'] ?>">
                                     <?php echo $service['lname'] ?>
                                 </a>
                             </li>
                         <?php endforeach ?>
                     <?php endif ?>
                 </ul>
             </div>

             <div class="col-lg-4 col-md-12">
                 <h4>Follow Us</h4>

                 <div class="social-links d-flex">
                     <a href="<?php echo $twitter_page ?>"><i class="bi bi-twitter-x"></i></a>
                     <a href="<?php echo $facebook_fanpage ?>"><i class="bi bi-facebook"></i></a>
                     <a href="<?php echo $instagram_page ?>"><i class="bi bi-instagram"></i></a>
                     <a href="<?php echo $linkedin_page ?>"><i class="bi bi-linkedin"></i></a>
                 </div>
             </div>

         </div>
     </div>

     <div class="container copyright text-center mt-4">
         <p>© <span>Copyright</span> <strong class="px-1 sitename">Sports Zone</strong> <span>All Rights Reserved</span>
         </p>
         <div class="credits">
             <!-- All the links in the footer should remain intact. -->
             <!-- You can delete the links only if you've purchased the pro version. -->
             <!-- Licensing information: https://bootstrapmade.com/license/ -->
             <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
             Designed by <a href="#">Nhất Kiến Văn Company</a>
         </div>
     </div>

 </footer>