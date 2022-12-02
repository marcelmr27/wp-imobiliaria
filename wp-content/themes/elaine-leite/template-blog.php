<?php
/*
 * Template Name: Blog
 */
$array_blog = array();

$args_blog = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC'
        ));
if ($args_blog->have_posts()):
    while ($args_blog->have_posts()) : $args_blog->the_post();
        $array_blog[] = array(
            'titulo' => get_the_title(),
            'link' => get_permalink(),
            'imagem' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
            'data' => get_the_date(),
        );
    endwhile;
endif;

get_header();
?> 

<header class="pages-header bg-img valign parallaxie" data-background="<?php echo get_template_directory_uri() ?>/img/pg1.jpg" data-overlay-dark="5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cont text-center">
                    <h1>Blog</h1>
                    <div class="path">
                        <a href="<?php echo home_url() ?>">Home</a><span>/</span><a href="#!" rel="nofollow" class="active">Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="blog-pg section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="posts">
                    <?php if (!empty($array_blog)) { ?>
                        <?php foreach ($array_blog as $BLOG) { ?>
                            <div class="item mb-80">
                                <div class="img">
                                    <a href="<?php echo $BLOG['link'] ?>">
                                        <img src="<?php echo $BLOG['imagem'] ?>" alt="<?php echo $BLOG['titulo'] ?>" class="thumparallax">
                                    </a>
                                    <div class="info">
                                        <div class="date">
                                            <h5>
                                                <a href="#!" rel="nofollow">
                                                    <span class="num custom-font">06</span>
                                                    <span>Aug</span>
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10 offset-lg-1">
                                        <div class="content">
                                            <h4 class="title"><a href="<?php echo $BLOG['link'] ?>"><?php echo $BLOG['titulo'] ?></a></h4>
                                            <p><?php echo $BLOG['headline'] ?></p>
                                            <a href="<?php echo $BLOG['link'] ?>" class="more">Leia</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="item mb-80 text-center"><p>Nenhuma notícia cadastrada no blog.</p></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
