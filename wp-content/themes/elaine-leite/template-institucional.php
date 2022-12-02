<?php

/**
 * Template Name: Institucional
 */
global $wp;
$pagina = new WP_Query(array(
    'posts_per_page' => 1,
    'post_type' => 'page',
    'p' => url_to_postid(home_url($wp->request))
));

get_header();
?>

<?php
if ($pagina->have_posts()) :
    while ($pagina->have_posts()) : $pagina->the_post();
?>
        <div class="page-banner-simple bg-secondary py-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="banner-title text-white"><?php the_title() ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="full-row pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="text-dark mb-3"><?php the_title() ?></h1>
                        <div class="py-2">
                            <?php the_content() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    endwhile;
endif;
?>
<?php
get_footer();
