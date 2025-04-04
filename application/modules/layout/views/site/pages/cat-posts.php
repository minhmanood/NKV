 <main class="main">

     <!-- Page Title -->
     <div class="page-title">
         <div class="heading">
             <div class="container">
                 <div class="row d-flex justify-content-center text-center">
                     <img src="image/Frame 276.png" class="img-fluid animated" alt="">
                 </div>
             </div>
         </div>
         <nav class="breadcrumbs">
             <div class="container">
                 <ol>
                     <li><a href="index.html">Home</a></li>
                     <li class="current">Blog</li>
                 </ol>
             </div>
         </nav>
     </div><!-- End Page Title -->

     <div class="container">
         <div class="row">

             <div class="col-lg-8">

                 <!-- Blog Posts Section -->
                 <section id="blog-posts" class="blog-posts section">

                     <div class="container">

                         <div class="row gy-4">

                             <?php echo isset($rows) ? $rows : ''; ?>
                         </div>
                 </section><!-- /Blog Posts Section -->


                 <!-- Blog Pagination Section -->
                 <section id="blog-pagination" class="blog-pagination section">

                     <div class="container">
                         <div class="d-flex justify-content-center">
                             <ul>
                                 <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                                 <li><a href="#">1</a></li>
                                 <li><a href="#" class="active">2</a></li>
                                 <li><a href="#">3</a></li>
                                 <li><a href="#">4</a></li>
                                 <li>...</li>
                                 <li><a href="#">10</a></li>
                                 <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
                             </ul>
                         </div>
                     </div>

                 </section>
                 <!-- /Blog Pagination Section -->

             </div>

             <div class="col-lg-4 sidebar">

                 <div class="widgets-container">

                     <!-- Search Widget -->
                     <div class="search-widget widget-item">

                         <h3 class="widget-title">Search</h3>
                         <form action="">
                             <input type="text">
                             <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                         </form>

                     </div><!--/Search Widget -->

                     <!-- Categories Widget -->
                     <div class="categories-widget widget-item">

                         <h3 class="widget-title">Danh mục</h3>
                         <ul class="mt-3">
                             <li><a href="#">Thể thao <span>(25)</span></a></li>
                             <li><a href="#">Sự kiện <span>(12)</span></a></li>
                             <li><a href="#">Khai trương<span>(5)</span></a></li>
                             <li><a href="#">Tất niên<span>(22)</span></a></li>

                         </ul>

                     </div><!--/Categories Widget -->

                     <!-- Recent Posts Widget -->
                     <div class="recent-posts-widget widget-item">

                         <h3 class="widget-title">Mới nhất</h3>

                         <div class="post-item">
                             <img src="image/blog-1.jpg" alt="" class="flex-shrink-0">
                             <div>
                                 <h4><a href="blog-details.html">Nihil blanditiis at in nihil autem</a></h4>
                                 <time datetime="2020-01-01">Jan 1, 2020</time>
                             </div>
                         </div><!-- End recent post item-->





                     </div><!--/Recent Posts Widget -->

                     <!-- Tags Widget -->
                     <div class="tags-widget widget-item">

                         <h3 class="widget-title">Tags</h3>
                         <ul>
                             <li><a href="#">App</a></li>
                             <li><a href="#">IT</a></li>
                             <li><a href="#">Business</a></li>
                             <li><a href="#">Mac</a></li>
                             <li><a href="#">Design</a></li>
                             <li><a href="#">Office</a></li>
                             <li><a href="#">Creative</a></li>
                             <li><a href="#">Studio</a></li>
                             <li><a href="#">Smart</a></li>
                             <li><a href="#">Tips</a></li>
                             <li><a href="#">Marketing</a></li>
                         </ul>

                     </div><!--/Tags Widget -->

                 </div>

             </div>

         </div>
     </div>

 </main>