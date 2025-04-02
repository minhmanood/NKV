<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo html_escape($description); ?>" />
    <meta name="keywords" content="<?php echo html_escape($keywords); ?>" />
    <meta property="og:site_name" content="<?php echo html_escape($site_name); ?>" />
    <meta property="og:type" content="Website" />
    <meta property="og:title" content="<?php echo html_escape($title_seo); ?>" />
    <meta property="og:url" content="<?php echo current_full_url(); ?>" />
    <meta property="og:description" content="<?php echo html_escape($description); ?>" />
    <meta property="og:image" content="<?php echo $image; ?>" />
    <meta property="fb:app_id" content="<?php echo $this->config->item('app_id', 'facebook'); ?>" />
    <!-- google -->
    <meta itemprop="name" content="<?php echo html_escape($site_name); ?>">
    <meta itemprop="description" content="<?php echo html_escape($description); ?>">
    <meta itemprop="image" content="<?php echo $image; ?>">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo html_escape($site_name); ?>">
    <meta name="twitter:title" content="<?php echo html_escape($title_seo); ?>">
    <meta name="twitter:description" content="<?php echo html_escape($description); ?>">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image:src" content="<?php echo $image; ?>">
    <title><?php echo $title_seo; ?></title>
    <!-- <link rel="icon" href="<?php echo base_url(get_module_path('logo') . $favicon); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo get_asset('css_path'); ?>plugins.css" />
    <link rel="stylesheet" href="<?php echo get_asset('css_path'); ?>wdag.css" />
    <link rel="stylesheet" href="<?php echo get_asset('css_path'); ?>custom.css" /> -->

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/" rel="preconnect">
    <link href="https://fonts.gstatic.com/" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://bootstrapmade.com/content/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://bootstrapmade.com/content/vendors/aos/aos.css" rel="stylesheet">
    <link href="https://bootstrapmade.com/content/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="https://bootstrapmade.com/content/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?php echo get_asset('css_path') ?>custom.css" rel="stylesheet">


    <script type="text/javascript">
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', '<?php echo $analytics_UA_code; ?>', 'auto');
        ga('send', 'pageview');
    </script>
</head>

<body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '<?php echo $this->config->item('app_id', 'facebook'); ?>',
                xfbml: true,
                version: 'v2.11'
            });
        };
    </script>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- <div class="page-loader bg-white">
        <div class="v-center">
            <div class="loader-square bg-colored"></div>
        </div>
    </div> -->
    <?php $this->load->view('header'); ?>
    <?php $this->load->view($main_content); ?>
    <?php $this->load->view('footer'); ?>
    <script type="text/javascript">
        base_url = '<?php echo base_url(); ?>';
    </script>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script data-cfasync="false"
        src="https://bootstrapmade.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/php-email-form/validate.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/aos/aos.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/glightbox/js/glightbox.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/purecounter/purecounter_vanilla.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="https://bootstrapmade.com/content/demo/FlexStart/assets/js/main.js"></script>

    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"918f6fdd7e0001f2","version":"2025.1.0","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"68c5ca450bae485a842ff76066d69420","b":1}'
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($(window).width() < 768) {
                $('img').each(function() {
                    $(this).removeAttr('style');
                });
            }
        });
    </script>
    <script>
        AOS.init();
    </script>
</body>

</html>