<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$array_institucional = array();
$args_institucional = new WP_Query(array(
    'post_type' => 'page',
    'posts_per_page' => 1,
    'p' => '2'
));
if ($args_institucional->have_posts()) :
    while ($args_institucional->have_posts()) : $args_institucional->the_post();
        $array_institucional = array(
            'redes_sociais' => get_field('redes_sociais'),
            'texto_rodape' => get_field('texto_rodape'),
            'telefone' => get_field('telefone'),
            'whatsapp' => get_field('whatsapp'),
            'email' => get_field('email'),
            'endereco' => get_field('endereco'),
        );
    endwhile;
endif;
?>

<footer class="full-row footer-default-dark bg-footer" style="padding-bottom: 30px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="footer-widget mb-4">
                    <div class="footer-logo mb-4">
                        <a href="<?php echo home_url() ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/favicon.png" alt="<?php echo get_bloginfo('name') ?>" /></a>
                    </div>
                    <p><?php echo $array_institucional['texto_rodape'] ?></p>
                </div>
                <div class="footer-widget media-widget mb-4">
                    <?php if ($array_institucional['redes_sociais']['facebook'] !== '') { ?>
                        <a href="<?php echo $array_institucional['redes_sociais']['facebook'] ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <?php } ?>
                    <?php if ($array_institucional['redes_sociais']['instagram'] !== '') { ?>
                        <a href="<?php echo $array_institucional['redes_sociais']['instagram'] ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                    <?php } ?>
                    <?php if ($array_institucional['redes_sociais']['youtube'] !== '') { ?>
                        <a href="<?php echo $array_institucional['redes_sociais']['youtube'] ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                    <?php } ?>
                    <?php if ($array_institucional['redes_sociais']['linkedin'] !== '') { ?>
                        <a href="<?php echo $array_institucional['redes_sociais']['linkedin'] ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <?php } ?>
                    <?php if ($array_institucional['whatsapp'] !== '') { ?>
                        <a href="https://api.whatsapp.com/send?phone=55<?php echo preg_replace('/\D/', '', $array_institucional['whatsapp']) ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-widget footer-nav mb-4">
                    <h3 class="widget-title mb-4">Navegação Rápida</h3>
                    <ul>
                        <li>
                            <a class="nav-link" href="<?php echo home_url() ?>">Página Principal</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php echo home_url() ?>/institucional">Institucional</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php echo home_url() ?>/imoveis">Imóveis</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php echo home_url() ?>/contato">Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-widget contact-widget mb-4">
                    <h3 class="widget-title mb-4">Informações de Contato</h3>
                    <ul>
                        <li><?php echo $array_institucional['endereco'] ?></li>
                        <li><?php echo $array_institucional['telefone'] ?></li>
                        <li><?php echo $array_institucional['email'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="copyright bg-footer text-default py-4">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1">
            <div class="col">
                <span class="text-white">© 2022 Elaine Leite Imóveis & Construções. Todos os direitos reservados.</span>
            </div>
            <div class="col text-right">
                <span class="text-white">Desenvolvido por <a href="https://agenciaamplia.digital" target="_blank" style="color:white">Agência Amplia</a></span>
            </div>
        </div>
    </div>
</div>

</div>
<!-- Javascript Files -->
<script src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/greensock.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/layerslider.transitions.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/layerslider.kreaturamedia.jquery.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/popper.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.fancybox.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/owl.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/range/tmpl.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/range/jquery.dependClass.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/range/draggable.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/range/jquery.slider.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/wow.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/mixitup.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/paraxify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js" integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/i18n/defaults-pt_BR.min.js" integrity="sha512-3G716ZCmwlwpcG458jl7f23n7S+GSfI3C17P+CUueNHHji938w7qFXhHQWL6Phb2MeaJkADEtnyT3G6qbMknkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/custom.js"></script>
<script>
    $(document).ready(function() {
        if ($('#slider').length > 0) {
            $('#slider').layerSlider({
                sliderVersion: '6.0.0',
                type: 'fullwidth',
                responsiveUnder: 0,
                layersContainer: 1200,
                pauseOnHover: 'enabled',
                navPrevNext: false,
                hideUnder: 0,
                hideOver: 100000,
                skin: 'v5',
                globalBGColor: '#ffffff',
                navStartStop: false,
                skinsPath: 'assets/skins/',
                height: 700
            });
        }
        if ($('.selectpicker').length > 0) {
            $('.selectpicker').selectpicker();
        }
        $('select[name="cidades[]"]').change(function() {
            var cities = $(this).val();
            console.log(cities);
            $.ajax({
                url: '<?php echo home_url() ?>/wp-actions/search-neighborhoods.php',
                type: 'POST',
                data: {
                    action: 'get_neighborhoods',
                    cities: cities
                },
                success: function(response) {
                    $('select[name="bairros[]"]').selectpicker("destroy");
                    $('select[name="bairros[]"]').html('<option value="" disabled>Bairro</option>');
                    $('select[name="bairros[]"]').append(response);
                    if (response !== null && response !== '') {
                        $('select[name="bairros[]"]').prop('disabled', false);
                    } else {
                        $('select[name="bairros[]"]').prop('disabled', true);
                    }
                    $('select[name="bairros[]"]').selectpicker();
                }
            });
        });
    });
</script>

<?php wp_footer(); ?>

</body>

</html>