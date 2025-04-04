<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <?php

        ?>
        <style>
            :root {
                --banner-home: url(<?php echo get_media('images', $slideshow_none[1]['image'], 'no-image.png') ?>)
            }
        </style>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up"><?php echo $slideshow_none[1]['title']; ?></h1>
                    <p data-aos="fade-up" data-aos-delay="100"><?php echo $slideshow_none[1]['content']; ?></p>
                    <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                        <a href="<?php echo $slideshow_none[1]['link']; ?>" class="btn-get-started">Tìm hiểu thêm <i class="bi bi-arrow-right"></i></a>

                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="<?php echo get_media('images', $slideshow_none[0]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    <?php if (isset($projects_comingup) && is_array($projects_comingup) && !empty($projects_comingup)): ?>
        <section id="about" class="about section">
            <div class="container" data-aos="fade-up">
                <?php foreach ($projects_comingup as $key => $value): ?>
                    <div class="row gx-0">
                        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                            <div class="content">
                                <h3>Sự kiện sắp diễn ra</h3>
                                <h2><?php echo $value['name']; ?></h2>
                                <p>
                                    <?php echo $value['hometext']; ?>
                                </p>
                                <div class="text-center text-lg-start">
                                    <a href="#"
                                        class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                        <span>Tham gia ngay</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                            <img src=" <?php echo get_media('projects', $value['image'], 'no-image.png') ?> " class="img-fluid" alt="<?php echo $value['name']; ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </section>
    <?php endif; ?>
    <!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 text-center">Còn lại</h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-3">
                                    <h3 id="days" class="display-4">00</h3>
                                    <p>Days</p>
                                </div>
                                <div class="col-3">
                                    <h3 id="hours" class="display-4">00</h3>
                                    <p>Hours</p>
                                </div>
                                <div class="col-3">
                                    <h3 id="minutes" class="display-4">00</h3>
                                    <p>Minutes</p>
                                </div>
                                <div class="col-3">
                                    <h3 id="seconds" class="display-4">00</h3>
                                    <p>Seconds</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Set the date we're counting down to (1 month from now)
            const countDownDate = new Date().getTime() + (30 * 24 * 60 * 60 * 1000);

            // Update the countdown every 1 second
            const x = setInterval(function() {
                // Get today's date and time
                const now = new Date().getTime();

                // Find the distance between now and the countdown date
                const distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result
                document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
                document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
                document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
                document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

                // If the countdown is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("days").innerHTML = "00";
                    document.getElementById("hours").innerHTML = "00";
                    document.getElementById("minutes").innerHTML = "00";
                    document.getElementById("seconds").innerHTML = "00";
                }
            }, 1000);
        </script>

    </section><!-- /Stats Section -->
    <?php if (isset($projects_comingup) && is_array($projects_comingup) && !empty($projects_comingup)): ?>
        <!-- Event Posts Section -->
        <section id="recent-posts" class="recent-posts section">
            <div class="container">
                <div class="row gy-5">
                    <?php foreach ($posts_service1 as $key => $value): ?>
                        <?php
                        $data_id = $value['id'];
                        $data_title = word_limiter($value['title']);
                        $data_image = array(
                            'src' => get_media('posts', $value['homeimgfile'], 'no-image-thumb.png', '636x270x1'),
                            'alt' => $value['homeimgfile']
                        );
                        $data_link = site_url($value['cat_alias'] . '/' . $value['alias'] . '-' . $data_id);
                        $data_hometext = word_limiter($value['hometext'], 15);
                        $data_created_at = format_date1($value['addtime']);
                        $data_author = $value['full_name'];
                        $data_category_name = $value['categories']['name'];
                        ?>
                        <div class="col-xl-6 col-md-6">
                            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                                <div class="post-img position-relative overflow-hidden">
                                    <img src="<?php echo $data_image['src'] ?>" class=" img-fluid" alt="<?php echo $data_image['alt'] ?>">
                                    <span class="post-date"><?php echo $data_created_at ?></span>
                                </div>

                                <div class="post-content d-flex flex-column">

                                    <h3 class="post-title"><?php echo $data_title ?></h3>

                                    <div class="meta d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person"></i> <span class="ps-2"><?php echo $data_author ?></span>
                                        </div>
                                        <span class="px-3 text-black-50">/</span>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-folder2"></i> <span class="ps-2"><?php echo $data_category_name ?></span>
                                        </div>
                                    </div>

                                    <hr>

                                    <a href="#" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!-- End post item -->
                    <?php endforeach; ?>
                </div>
            </div>

        </section>
        <!-- /Events Posts Section -->
    <?php endif; ?>
    <!-- Values Section -->
    <section id="values" class="values section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <!--<h2>Our Values</h2>-->
            <p>Tổ chức sự kiện thể thao chuyên nghiệp<br></p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                <?php foreach ($posts_service2 as $key => $value): ?>
                    <?php
                    $data_id = $value['id'];
                    $data_title = word_limiter($value['title']);
                    $data_image = array(
                        'src' => get_media('posts', $value['homeimgfile'], 'no-image-thumb.png', '400x185x1'),
                        'alt' => $value['homeimgfile']
                    );
                    $data_link = site_url($value['cat_alias'] . '/' . $value['alias'] . '-' . $data_id);
                    $data_hometext = word_limiter($value['hometext'], 15);
                    $data_created_at = format_date1($value['addtime']);
                    $data_author = $value['full_name'];
                    $data_category_name = $value['categories']['name'];
                    ?>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <img src="<?php echo $data_image['src'] ?>" class=" img-fluid" alt="<?php echo $data_image['alt'] ?>">
                            <h3><?php echo $data_title ?></h3>
                            <p><?php echo $data_hometext ?></p>
                        </div>
                    </div><!-- End Card Item -->





                <?php endforeach ?>
            </div>
        </div>

    </section>
    <!-- /Values Section -->



    <!-- Feature Details Section -->
    <section id="feature-details" class="feature-details section">
        <div class="container section-title" data-aos="fade-up">
            <!--<h2>Features</h2>-->
            <p>Quy trình tổ chức<br></p>
        </div><!-- End Section Title -->
        <div class="container">

            <div class="row gy-4 align-items-center features-item">
                <?php if (isset($info_why_choose_us_none) && !empty($info_why_choose_us_none)): ?>
                    <?php $attributes = unserialize($info_why_choose_us_none['attributes']); ?>
                    <?php foreach ($attributes as $key => $attribute): ?>
                        <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                            <?php if (!empty($attribute['image'])): ?>
                                <img src="<?= base_url('uploads/info/' . $attribute['image']) ?>"
                                    alt="<?= html_escape($attribute['label']) ?>"
                                    class="img-thumbnail"
                                    style="max-width: 100%">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                            <h3><?= html_escape($attribute['label']) ?></h3>
                            <p class="mini-mt gray8 font-15"><?= $attribute['content'] ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div><!-- Features Item -->



        </div>

    </section>
    <!-- /Feature Details Section -->




    <!-- Testimonials Section -->
    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Nhận xét</h2>
            <p>Khách hàng nói về chúng tôi<br></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 1,
                                "spaceBetween": 40
                            },
                            "1200": {
                                "slidesPerView": 3,
                                "spaceBetween": 1
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper">
                    <?php
                    if (isset($info_customer_experience_none) && is_array($info_customer_experience_none) && !empty($info_customer_experience_none)):
                        foreach ($info_customer_experience_none as $key => $testimonial):
                            $attributes = unserialize($testimonial['attributes']);
                            $location = isset($attributes[0]['label']) ? $attributes[0]['label'] : '';
                            $testimonial_content = isset($attributes[0]['content']) ? $attributes[0]['content'] : '';
                    ?>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <?php echo $testimonial_content; ?>
                                    </p>

                                    <div class="profile mt-auto">
                                        <img src="<?php echo get_media('images', $slideshow_none[2]['image'], 'no-avatar.jpg') ?>" class="img-fluid animated" alt="">
                                        <h3><?php echo $testimonial['title']; ?></h3>
                                        <h4><?php echo $location; ?></h4>
                                    </div>
                                </div>
                            </div><!-- End testimonial item -->
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section>
    <!-- /Testimonials Section -->

    <!-- /Testimonials Section -->


    <!-- Clients Section -->
    <section id="clients" class="clients section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Đối tác</h2>
            <p>Những đối tác của chúng tôi<br></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 2,
                                "spaceBetween": 40
                            },
                            "480": {
                                "slidesPerView": 3,
                                "spaceBetween": 60
                            },
                            "640": {
                                "slidesPerView": 4,
                                "spaceBetween": 80
                            },
                            "992": {
                                "slidesPerView": 6,
                                "spaceBetween": 120
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[0]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[1]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[2]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[3]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[4]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[5]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide">
                        <imgpartner_none
                            src="<?php echo get_media('images', $partner_none[6]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[7]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[8]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[9]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>
                    <div class="swiper-slide"><img
                            src="<?php echo get_media('images', $partner_none[10]['image'], 'no-image.png') ?>" class="img-fluid animated" alt="">
                    </div>

                </div>partner_none
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Clients Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tin tức</h2>
            <p>Tin mới nhất về các sự kiện</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">
                <?php foreach ($posts_new1 as $key => $value): ?>
                    <?php
                    $data_id = $value['id'];
                    $data_title = word_limiter($value['title']);
                    $data_image = array(
                        'src' => get_media('posts', $value['homeimgfile'], 'no-image-thumb.png', '400x185x1'),
                        'alt' => $value['homeimgfile']
                    );
                    $data_link = site_url($value['cat_alias'] . '/' . $value['alias'] . '-' . $data_id);
                    $data_hometext = word_limiter($value['hometext'], 15);
                    $data_created_at = format_date1($value['addtime']);
                    $data_author = $value['full_name'];
                    $data_category_name = $value['categories']['name'];
                    ?>

                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                            <div class="post-img position-relative overflow-hidden">
                                <img src="<?php echo $data_image['src'] ?>" class=" img-fluid" alt="<?php echo $data_image['alt'] ?>">
                                <span class="post-date"><?php echo $data_created_at ?></span>
                            </div>

                            <div class="post-content d-flex flex-column">

                                <h3 class="post-title"><?php echo $data_title ?></h3>

                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i> <span class="ps-2"><?php echo $data_author ?></span>
                                    </div>
                                    <span class="px-3 text-black-50">/</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i> <span class="ps-2"><?php echo $data_category_name ?></span>
                                    </div>
                                </div>

                                <hr>

                                <a href="#" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                            </div>

                        </div>
                    </div><!-- End post item -->

                <?php endforeach ?>
            </div>

        </div>

    </section><!-- /Recent Posts Section -->

</main>