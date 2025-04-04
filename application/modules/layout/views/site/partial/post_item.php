<?php if (isset($data) && is_array($data) && !empty($data)):
    $i = 0; ?>
    <?php foreach ($data as $value):
        $i++;
        $data_id = $value['id'];
        $data_title = word_limiter($value['title'], 15);
        $data_hometext = word_limiter($value['hometext'], 15);
        $data_link = site_url($value['categories']['alias'] . '/' . $value['alias'] . '-' . $data_id);
        $data_image = array(
            'src' => get_media('posts', $value['homeimgfile'], 'no-image-thumb.png', '832x224x1'),
            'alt' => $value['homeimgalt']
        );
        $data_author = $value['full_name'];
        $data_time = date('M d, Y', $value['addtime']);
    ?>
        <div class="col-12">
            <article>

                <div class="post-img">
                    <img src="<?php echo $data_image['src'] ?>" alt="" class="img-fluid">
                </div>

                <h2 class="title">
                    <a href="blog-details.html"><?php echo $data_title ?></a>
                </h2>

                <div class="meta-top">
                    <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                href="blog-details.html"><?php echo $data_author ?>
                            </a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time
                                    datetime="2022-01-01"><?php echo $data_time ?></time></a></li>
                    </ul>
                </div>

                <div class="content">
                    <p>
                        <?php echo $data_hometext ?>
                    </p>

                    <div class="read-more">
                        <a href="<?php echo $data_link ?>">Read More</a>
                    </div>
                </div>

            </article>
        </div>
    <?php endforeach; ?>
<?php endif; ?> 