<?php
/*
 * Template Name: Contato
 */
global $wp;
$pagina = new WP_Query(array(
    'posts_per_page' => 1,
    'post_type' => 'page',
    'p' => url_to_postid(home_url($wp->request))
));

$array_institucional = array();

$args_institucional = new WP_Query(array(
    'post_type' => 'page',
    'posts_per_page' => 1,
    'p' => '2'
));
if ($args_institucional->have_posts()) :
    while ($args_institucional->have_posts()) : $args_institucional->the_post();
        $array_institucional = array(
            'telefone' => get_field('telefone'),
            'whatsapp' => get_field('whatsapp'),
            'email' => get_field('email'),
            'endereco' => get_field('endereco')
        );
    endwhile;
endif;

get_header();
?>
<?php
if ($pagina->have_posts()) :
    while ($pagina->have_posts()) : $pagina->the_post(); ?>
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
                    <div class="col-md-5 order-md-2">
                        <h4 class="down-line mb-5">+ Informações de Contato</h4>
                        <div class="mb-3">
                            <ul>
                                <li class="mb-5">
                                    <h6 class="mb-0">Endereço:</h6> <?php echo $array_institucional['endereco'] ?>
                                </li>
                                <li class="mb-5">
                                    <h6>Telefone:</h6> <?php echo $array_institucional['telefone'] ?>
                                </li>
                                <li class="mb-5">
                                    <h6>WhatsApp:</h6> <?php echo $array_institucional['whatsapp'] ?>
                                </li>
                                <li class="mb-5">
                                    <h6>E-mail:</h6> <?php echo $array_institucional['email'] ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7 order-md-1">
                        <h4 class="down-line mb-4">Formulário de Contato</h4>
                        <div class="form-simple">
                            <div id="contact-form">
                                <?php echo do_shortcode('[contact-form-7 id="6" title="Formulário de Contato"]'); ?>
                            </div>
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
