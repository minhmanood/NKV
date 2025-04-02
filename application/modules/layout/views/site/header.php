<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->

            <h1 class="sitename">Sports Zone</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <!-- <li><a href="blog-details.html" class="active">Giới thiệu<br></a></li>

                <li class="dropdown"><a href="#"><span>Giải đấu</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="blog-details.html">Bóng đá</a></li>

                        <li><a href="blog-details.html">Chạy bộ</a></li>
                        <li><a href="blog-details.html">Khác</a></li>

                    </ul>
                </li>
                <li><a href="blog-details.html">Đăng ký tổ chức</a></li>
                <li><a href="blog.html">Tin tức</a></li>
                <li><a href="contact.html">Liên hệ</a></li> -->
                <?php echo isset($html_menu_main) ? $html_menu_main : ''; ?>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted flex-md-shrink-0" href="#about">Call Center</a>

    </div>
</header>