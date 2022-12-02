<?php
/**
 * Template Name: Portfólio
 */
global $wp;
$pagina = new WP_Query(array(
    'posts_per_page' => 1,
    'post_type' => 'page',
    'p' => url_to_postid(home_url($wp->request))
        ));

$array_portfolio = array();
$args_portfolio = new WP_Query(array(
    'post_type' => 'cpt_portfolio',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'ASC',
    'meta_key' => 'home_page',
    'meta_value' => 'Sim'
        ));
if ($args_portfolio->have_posts()):
    while ($args_portfolio->have_posts()) : $args_portfolio->the_post();
        $array_portfolio[] = array(
            'nome' => get_the_title(),
            'imagem' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
            'categorias' => get_the_category(get_the_ID()),
            'link' => get_permalink(),
        );
    endwhile;
endif;

get_header();
?> 

<?php
if ($pagina->have_posts()):
    while ($pagina->have_posts()) : $pagina->the_post();
        ?>
        <header class="pages-header bg-img valign parallaxie" data-background="<?php echo get_template_directory_uri() ?>/img/pg1.jpg" data-overlay-dark="5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cont text-center">
                            <h1><?php the_title() ?></h1>
                            <div class="path">
                                <a href="<?php echo home_url() ?>">Home</a>
                                <span>/</span>
                                <a href="#!" rel="nofollow" class="active"><?php the_title() ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?php if (!empty($array_portfolio)) { ?>
            <section class="portfolio section-padding">
                <div class="container">
                    <div class="row">
                        <!-- filter links -->
                        <div class="filtering text-center col-12">
                            <div class="filter box">
                                <span data-filter='*' class="active">All</span>
                                <span data-filter='.interior'>Interior</span>
                                <span data-filter='.theaters'>Theaters</span>
                                <span data-filter='.residential'>Residential</span>
                            </div>
                        </div>
                        <div class="gallery twsty inf-lit full-width">
                            <?php foreach ($array_portfolio as $PORTFOLIO) { ?>
                                <div class="items theaters three-column mt-50">
                                    <div class="item-img bg-img" data-background="<?php echo $PORTFOLIO['imagem'] ?>">
                                        <a href="<?php echo $PORTFOLIO['link'] ?>">
                                            <div class="item-img-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="info mt-10">
                                        <h5><?php echo $PORTFOLIO['nome'] ?></h5>
                                        <span>Categoria</span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php } else { ?>
            <section class="portfolio section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center"><p>Nenhum projeto cadastrado.</p></div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <?php
    endwhile;
endif;
?>
<?php
get_footer();
