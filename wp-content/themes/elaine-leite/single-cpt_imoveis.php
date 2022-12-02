<?php
global $wp;
$pagina = new WP_Query(array(
    'posts_per_page' => 1,
    'post_type' => 'cpt_imoveis',
    'p' => url_to_postid(home_url($wp->request))
));

get_header();
?>

<?php
if ($pagina->have_posts()) :
    while ($pagina->have_posts()) : $pagina->the_post();
        $explode_bairro = explode('|separador|', get_field('bairro'));
        $explode_tipo_imovel = explode('|separador|', get_field('tipo_imovel'));
        $string_tipo_imovel = get_the_title($explode_tipo_imovel[0]) . ' > ' . $explode_tipo_imovel[1];
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

        <div class="full-row pb-100 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 order-xl-2">
                        <div class="widget widget_contact bg-white border p-30 shadow-one rounded mb-30">
                            <h5 class="mb-4">Solicitar Atendimento</h5>
                            <div class="quick-search form-icon-right">
                                <?php echo do_shortcode('[contact-form-7 id="108" title="Formulário Imóvel"]'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 order-xl-1">
                        <div class="property-overview border summary rounded bg-white p-30 mb-30">
                            <?php if (get_field('galeria') !== null) { ?>
                                <div class="1block-carusel owl-carousel mb-5">
                                    <?php foreach (get_field('galeria') as $GALERIA) { ?>
                                        <div class="item"><img src="<?php echo $GALERIA; ?>" class="ls-bg" alt="<?php echo get_the_title() . ' - ' . get_bloginfo('name') ?>" /> </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="row mb-4">
                                <div class="col-auto">
                                    <h4 class="listing-title"><a href="#!" rel="nofollow"><?php the_title() ?></a></h4>
                                    <span class="listing-location"><i class="fas fa-map-marker-alt text-primary"></i> <?php echo $explode_bairro[1] . ', ' . $explode_bairro[2] ?></span>
                                </div>
                                <div class="col-auto ms-auto xs-m-0 text-end xs-text-start pb-4">
                                    <span class="text-white px-2 mb-3 rounded product-status ms-auto xs-m-0 py-1 bg-primary"><?php echo get_field('operacao') ?></span>
                                    <span class="listing-price"><?php echo 'R$ ' . number_format(get_field('valor'), 2, ',', '.') ?></span>
                                </div>
                            </div>
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="mb-3">Descrição</h5>
                                    <?php the_content() ?>
                                </div>
                            </div>
                        </div>
                        <div class="property-overview border rounded bg-white p-30 mb-30">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="mb-3">+ Informação</h5>
                                    <div class="table-striped overflow-x-scroll pb-2">
                                        <table class="w-100">
                                            <tbody>
                                                <tr>
                                                    <td>Finalidade: <?php the_field('finalidade') ?></td>
                                                    <td>Tipo de Imóvel: <?php echo $string_tipo_imovel ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Dormitórios: <?php echo get_field('detalhes')['dormitorios'] ?></td>
                                                    <td>Banheiros: <?php echo get_field('detalhes')['banheiros'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Vagas de Garagem: <?php echo get_field('detalhes')['garagem'] ?></td>
                                                    <td>Área do Terreno: <?php echo get_field('detalhes')['area_terreno'] ?> m²</td>
                                                </tr>
                                                <tr>
                                                    <td>Área da Construção: <?php echo get_field('detalhes')['area_construcao'] ?> m²</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (get_field('itens_destaque') !== null) {
                            $args_itens_destaque = new WP_Query(array(
                                'post_type' => 'cpt_itens_destaque',
                                'posts_per_page' => -1,
                                'post_status' => 'publish',
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'post__in' => get_field('itens_destaque')
                            ));
                        ?>
                            <div class="property-overview border rounded bg-white p-30 mb-30">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <h5 class="mb-3">Itens</h5>
                                        <ul class="list-three-fold-width list-style-tick">
                                            <?php
                                            if ($args_itens_destaque->have_posts()) :
                                                while ($args_itens_destaque->have_posts()) : $args_itens_destaque->the_post();
                                                    echo '<li>' . get_the_title() . '</li>';
                                                endwhile;
                                            endif;
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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
