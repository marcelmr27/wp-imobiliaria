<?php

/**
 * Header file for the Twenty Twenty WordPress default theme.
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
        $array_institucional['telefone'] = get_field('telefone');
    endwhile;
endif;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favicon.png">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <!-- Required style of the theme -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/webfonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/owl.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/layerslider.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/template.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/colors/color.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/loader.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css" integrity="sha512-g2SduJKxa4Lbn3GW+Q7rNz+pKP9AWMR++Ta8fgwsZRCUsawjPvF/BxSMkGS61VsR9yinGoEgrHPGPn2mrj8+4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="preloader">
        <div class="loader xy-center"></div>
    </div>

    <div id="page_wrapper" class="bg-white">
        <header class="header-style nav-on-top bg-white">
            <div class="main-nav py-2 xs-p-0">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <nav class="navbar navbar-expand-lg nav-secondary nav-primary-hover nav-line-active">
                                <a class="navbar-brand" href="<?php echo home_url() ?>"><img class="nav-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/logo/logo.png" alt="<?php echo get_bloginfo('name') ?>"></a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon flaticon-menu flat-small text-primary"></span>
                                </button>
                                <div class="collapse navbar-collapse sm-ml-0" id="navbarSupportedContent">
                                    <ul class="navbar-nav ms-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo home_url() ?>">Página Principal</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo home_url() ?>/institucional">Institucional</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo home_url() ?>/imoveis">Imóveis</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo home_url() ?>/contato">Contato</a>
                                        </li>
                                    </ul>
                                    <a href="tel:+55<?php echo preg_replace('/\D/', '', $array_institucional['telefone']) ?>" target="_blank" class="btn btn-primary add-listing-btn"><?php echo $array_institucional['telefone'] ?></a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>