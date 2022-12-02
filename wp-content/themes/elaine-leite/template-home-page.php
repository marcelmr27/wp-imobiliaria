<?php
/*
 * Template Name: Home Page
 */

$array_institucional = $array_banners = $array_cidades = $array_tipos_imoveis = $array_itens_destaque = $array_imoveis_novos = $array_corretores = $array_depoimentos = $array_imoveis_destaques = array();

$args_institucional = new WP_Query(array(
    'post_type' => 'page',
    'posts_per_page' => 1,
    'p' => '2'
));
if ($args_institucional->have_posts()) :
    while ($args_institucional->have_posts()) : $args_institucional->the_post();
        $array_institucional['INSTITUCIONAL_01'] = array(
            '01' => get_field('t1_titulo'),
            '02' => get_field('t1_texto')
        );
        $array_institucional['CTA_01'] = array(
            '01' => get_field('cta1_titulo')
        );
    endwhile;
endif;

$args_banners = new WP_Query(array(
    'post_type' => 'cpt_banners',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'ASC'
));
if ($args_banners->have_posts()) :
    while ($args_banners->have_posts()) : $args_banners->the_post();
        $array_banners[] = array(
            'titulo' => get_the_title(),
            'imagem' => get_field('imagem')
        );
    endwhile;
endif;

$args_cidades = new WP_Query(array(
    'post_type' => 'cpt_cidades',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
));
if ($args_cidades->have_posts()) :
    while ($args_cidades->have_posts()) : $args_cidades->the_post();
        $array_cidades[] = array(
            'id' => get_the_ID(),
            'cidade' => get_the_title()
        );
    endwhile;
endif;

$args_tipos_imoveis = new WP_Query(array(
    'post_type' => 'cpt_tipos_imoveis',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
));
if ($args_tipos_imoveis->have_posts()) :
    while ($args_tipos_imoveis->have_posts()) : $args_tipos_imoveis->the_post();
        $array_tipos_imoveis[] = array(
            'id' => get_the_ID(),
            'tipo_imovel' => get_the_title(),
            'icone' => get_field('icone'),
            'subtipos' => get_field('subtipos')
        );
    endwhile;
endif;

$args_itens_destaque = new WP_Query(array(
    'post_type' => 'cpt_itens_destaque',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
));
if ($args_itens_destaque->have_posts()) :
    while ($args_itens_destaque->have_posts()) : $args_itens_destaque->the_post();
        $array_itens_destaque[] = array(
            'id' => get_the_ID(),
            'item' => get_the_title()
        );
    endwhile;
endif;

$args_imoveis_novos = new WP_Query(array(
    'post_type' => 'cpt_imoveis',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC'
));
if ($args_imoveis_novos->have_posts()) :
    while ($args_imoveis_novos->have_posts()) : $args_imoveis_novos->the_post();
        $array_imoveis_novos[] = array(
            'id' => get_the_ID(),
            'titulo' => get_the_title(),
            'imagem' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
            'link' => get_permalink(),
            'operacao' => get_field('operacao'),
            'tipo_imovel' => get_field('tipo_imovel'),
            'valor' => get_field('valor'),
            'dormitorios' => get_field('detalhes')['dormitorios'],
            'banheiros' => get_field('detalhes')['banheiros'],
            'garagem' => get_field('detalhes')['garagem'],
            'area_terreno' => get_field('detalhes')['area_terreno'],
            'bairro' => get_field('bairro'),
        );
    endwhile;
endif;

$args_corretores = new WP_Query(array(
    'post_type' => 'cpt_corretores',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'ASC'
));
if ($args_corretores->have_posts()) :
    while ($args_corretores->have_posts()) : $args_corretores->the_post();
        $array_corretores[] = array(
            'nome' => get_the_title(),
            'imagem' => get_the_post_thumbnail_url(get_the_ID(), 'full')
        );
    endwhile;
endif;

$args_depoimentos = new WP_Query(array(
    'post_type' => 'cpt_depoimentos',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'ASC'
));
if ($args_depoimentos->have_posts()) :
    while ($args_depoimentos->have_posts()) : $args_depoimentos->the_post();
        $array_depoimentos[] = array(
            'nome' => get_the_title(),
            'profissao' => get_field('profissao'),
            'depoimento' => get_field('depoimento')
        );
    endwhile;
endif;

$args_imoveis_destaques = new WP_Query(array(
    'post_type' => 'cpt_imoveis',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'ASC'
));
if ($args_imoveis_destaques->have_posts()) :
    while ($args_imoveis_destaques->have_posts()) : $args_imoveis_destaques->the_post();
        $array_imoveis_destaques[] = array(
            'id' => get_the_ID(),
            'titulo' => get_the_title(),
            'imagem' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
            'link' => get_permalink(),
            'operacao' => get_field('operacao'),
            'tipo_imovel' => get_field('tipo_imovel'),
            'valor' => get_field('valor'),
            'dormitorios' => get_field('detalhes')['dormitorios'],
            'banheiros' => get_field('detalhes')['banheiros'],
            'garagem' => get_field('detalhes')['garagem'],
            'area_terreno' => get_field('detalhes')['area_terreno'],
            'bairro' => get_field('bairro'),
            'meta_key' => 'destaque',
            'meta_value' => 'Sim'
        );
    endwhile;
endif;

get_header();
?>

<?php if (!empty($array_banners)) { ?>
    <div class="full-row p-0 overflow-hidden">
        <div id="slider" style="width:1200px; height:800px; margin:0 auto;margin-bottom: 0px;">
            <?php foreach ($array_banners as $BANNER) { ?>
                <div class="ls-slide" data-ls="duration:8000; transition2d:4; kenburnsscale:1.2;">
                    <img width="1920" height="1280" src="<?php echo $BANNER['imagem'] ?>" class="ls-l" alt="<?php echo get_bloginfo('name') ?>" style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; mix-blend-mode:normal; width:100%;" data-ls="showinfo:1; durationin:2000; easingin:easeOutExpo; scalexin:1.5; scaleyin:1.5; position:fixed;">
                    <img width="1920" height="1280" src="<?php echo $BANNER['imagem'] ?>" class="ls-tn" alt="<?php echo get_bloginfo('name') ?>">
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<div class="full-row p-0 property-search-form on-slider">
    <div class="container">
        <div class="row">
            <div class="col">
                <form class="bg-white shadow-sm quick-search form-icon-right position-relative" action="<?php echo home_url() ?>/imoveis" method="GET">
                    <div class="row row-cols-lg-3 row-cols-md-3 row-cols-1 g-3">
                        <div class="col">
                            <select class="form-control selectpicker" name="operacao" title="Operação" data-live-search="true">
                                <option value="" disabled>Operação</option>
                                <option value="Locação">Locação</option>
                                <option value="Venda">Venda</option>
                                <option value="Lançamento">Lançamento</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="cidades[]" multiple title="Cidade" data-live-search="true">
                                <option value="" disabled>Cidade</option>
                                <?php if (!empty($array_cidades)) { ?>
                                    <?php foreach ($array_cidades as $CIDADE) { ?>
                                        <option value="<?php echo $CIDADE['id'] ?>"><?php echo $CIDADE['cidade'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="tipos_imoveis[]" multiple title="Tipo" data-live-search="true">
                                <option value="" disabled>Tipo</option>
                                <?php if (!empty($array_tipos_imoveis)) { ?>
                                    <?php foreach ($array_tipos_imoveis as $TIPO_IMOVEL) { ?>
                                        <optgroup label="<?php echo $TIPO_IMOVEL['tipo_imovel'] ?>">
                                            <?php if ($TIPO_IMOVEL['subtipos'] !== null && is_array($TIPO_IMOVEL['subtipos']) && !empty($TIPO_IMOVEL['subtipos'])) { ?>
                                                <?php foreach ($TIPO_IMOVEL['subtipos'] as $SUBTIPO) { ?>
                                                    <option value="<?php echo $TIPO_IMOVEL['id'] . '|separador|' . $SUBTIPO['subtipo'] ?>"><?php echo $SUBTIPO['subtipo'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="bairros[]" multiple title="Bairro" data-live-search="true" disabled>
                                <option value="" disabled>Bairro</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="finalidade" title="Finalidade" data-live-search="true">
                                <option value="" disabled>Finalidade</option>
                                <option value="Residencial">Residencial</option>
                                <option value="Comercial">Comercial</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="dormitorios" title="Dormitórios" data-live-search="true">
                                <option value="" disabled>Dormitórios</option>
                                <option value="1">1 dormitório</option>
                                <option value="2">2 dormitórios</option>
                                <option value="3">3 dormitórios</option>
                                <option value="4">4 dormitórios</option>
                                <option value="5">5 dormitórios</option>
                                <option value="5+">+ de 5 dormitórios</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="banheiros" title="Banheiros" data-live-search="true">
                                <option value="" disabled>Banheiros</option>
                                <option value="1">1 banheiro</option>
                                <option value="2">2 banheiros</option>
                                <option value="3">3 banheiros</option>
                                <option value="3+">+ de 3 banheiros</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="garagem" title="Vagas de Garagem" data-live-search="true">
                                <option value="" disabled>Vagas de Garagem</option>
                                <option value="1">1 vaga</option>
                                <option value="2">2 vagas</option>
                                <option value="3">3 vagas</option>
                                <option value="3+">+ de 3 vagas</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="valor_minimo" title="Valor Mínimo" data-live-search="true">
                                <option value="" disabled>Valor Mínimo</option>
                                <option value="400">R$ 400,00</option>
                                <option value="800">R$ 800,00</option>
                                <option value="1200">R$ 1.200,00</option>
                                <option value="1500">R$ 1.500,00</option>
                                <option value="3000">R$ 3.000,00</option>
                                <option value="5000">R$ 5.000,00</option>
                                <option value="80000">R$ 80.000,00</option>
                                <option value="160000">R$ 160.000,00</option>
                                <option value="300000">R$ 300.000,00</option>
                                <option value="750000">R$ 750.000,00</option>
                                <option value="1000000">R$ 1.000.000,00</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="valor_maximo" title="Valor Máximo" data-live-search="true">
                                <option value="" disabled>Valor Máximo</option>
                                <option value="400">R$ 400,00</option>
                                <option value="800">R$ 800,00</option>
                                <option value="1200">R$ 1.200,00</option>
                                <option value="1500">R$ 1.500,00</option>
                                <option value="3000">R$ 3.000,00</option>
                                <option value="5000">R$ 5.000,00</option>
                                <option value="80000">R$ 80.000,00</option>
                                <option value="160000">R$ 160.000,00</option>
                                <option value="300000">R$ 300.000,00</option>
                                <option value="500000">R$ 500.000,00</option>
                                <option value="750000">R$ 750.000,00</option>
                                <option value="1000000">R$ 1.000.000,00</option>
                                <option value="10000000">R$ 10.000.000,00</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control selectpicker" name="itens[]" multiple title="Itens" data-live-search="true">
                                <option value="" disabled>Itens</option>
                                <?php if (!empty($array_itens_destaque)) { ?>
                                    <?php foreach ($array_itens_destaque as $ITEM) { ?>
                                        <option value="<?php echo $ITEM['id'] ?>"><?php echo $ITEM['item'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary w-100">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="full-row">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <h1 class="text-dark mb-0"><?php echo $array_institucional['INSTITUCIONAL_01']['01'] ?></h1>
            </div>
            <div class="col-lg-7">
                <div class="py-2">
                    <?php echo $array_institucional['INSTITUCIONAL_01']['02'] ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($array_imoveis_novos)) { ?>
    <div class="full-row bg-light">
        <div class="container">
            <div class="row">
                <div class="col mb-4">
                    <div class="align-items-center d-flex">
                        <div class="me-auto">
                            <h2 class="d-table">Imóveis Novos no Site</h2>
                        </div>
                        <a href="<?php echo home_url() ?>/imoveis" class="ms-auto btn-link">Ver Todos os Imóveis</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="3block-carusel nav-disable owl-carousel">
                        <?php foreach ($array_imoveis_novos as $IMOVEL_NOVO) {
                            $explode_bairro = explode('|separador|', $IMOVEL_NOVO['bairro']);
                        ?>
                            <div class="item">
                                <div class="property-grid-1 property-block bg-white transation-this">
                                    <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                                        <div class="cata position-absolute"><span class="sale bg-secondary text-white"><?php echo $IMOVEL_NOVO['operacao'] ?></span></div>
                                        <a href="<?php echo $IMOVEL_NOVO['link'] ?>"><img src="<?php echo $IMOVEL_NOVO['imagem'] ?>" alt="<?php echo $IMOVEL_NOVO['titulo'] . ' - ' . get_bloginfo('name') ?>"></a>
                                    </div>
                                    <div class="property_text p-4">
                                        <span class="listing-price"><?php echo 'R$ ' . number_format($IMOVEL_NOVO['valor'], 2, ',', '.') ?></span>
                                        <h5 class="listing-title"><a href="<?php echo $IMOVEL_NOVO['link'] ?>"><?php echo $IMOVEL_NOVO['titulo'] ?></a></h5>
                                        <span class="listing-location"><i class="fas fa-map-marker-alt"></i> <?php echo $explode_bairro[1] . ', ' . $explode_bairro[2] ?></span>
                                        <ul class="row text-center">
                                            <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-bed"></i></span><?php echo $IMOVEL_NOVO['dormitorios'] ?></li>
                                            <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-shower"></i></span><?php echo $IMOVEL_NOVO['banheiros'] ?></li>
                                            <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-car"></i></span><?php echo $IMOVEL_NOVO['garagem'] ?></li>
                                            <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-vector-square"></i></span><?php echo $IMOVEL_NOVO['area_terreno'] ?> m²</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (!empty($array_tipos_imoveis)) { ?>
    <div class="full-row bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col mb-5">
                    <h2 class="down-line w-50 mx-auto mb-4 text-center text-white w-sm-100">Qual tipo de imóvel está procurando?</h2>
                    <span class="d-table w-50 w-sm-100 sub-title text-white fw-normal mx-auto text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus vel lorem eu vulputate. Vivamus aliquam erat eget maximus consequat.</span>
                </div>
            </div>
            <div class="row row-cols-lg-5 row-cols-sm-4 row-cols-1 g-3 justify-content-center">
                <?php foreach ($array_tipos_imoveis as $TIPO_IMOVEL) { ?>
                    <div class="col">
                        <a href="<?php echo home_url() ?>/imoveis/?cat_imovel=<?php echo $TIPO_IMOVEL['id'] ?>" class="text-center d-flex flex-column align-items-center hover-text-white p-4 bg-white transation text-general hover-bg-primary h-100">
                            <div class="box-70px position-relative">
                                <img src="<?php echo $TIPO_IMOVEL['icone'] ?>" class="img-fluid" alt="<?php echo $TIPO_IMOVEL['tipo_imovel'] . ' - ' . get_bloginfo('name') ?>">
                            </div>
                            <h6 class="d-block text-secondary"><?php echo $TIPO_IMOVEL['tipo_imovel'] ?></h5>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (!empty($array_corretores)) { ?>
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="align-items-center d-flex">
                        <div class="me-auto">
                            <h2 class="d-table">Nossos Corretores</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-xl-4 row-cols-md-2 row-cols-1 mt-5">
                <?php foreach ($array_corretores as $CORRETOR) { ?>
                    <div class="col">
                        <div class="thumb-team-simple">
                            <img class="rounded-lg" src="<?php echo $CORRETOR['imagem'] ?>" alt="<?php echo $CORRETOR['nome'] . ' - ' . get_bloginfo('name') ?>">
                            <div class="user-info d-flex py-4">
                                <div class="me-auto">
                                    <h5 class="text-dark mb-2 font-400"><a href="#!" rel="nofollow"><?php echo $CORRETOR['nome'] ?></a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (!empty($array_depoimentos)) { ?>
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col mb-5">
                    <span class="text-primary tagline pb-2 d-table m-auto">Depoimentos</span>
                    <h2 class="down-line w-50 mx-auto mb-4 text-center w-sm-100">O que nossos clientes dizem</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="testimonial-simple text-center px-5">
                        <div class="text-carusel owl-carousel">
                            <?php foreach ($array_depoimentos as $DEPOIMENTO) { ?>
                                <div class="item">
                                    <i class="flaticon-right-quote flat-large text-primary d-table mx-auto"></i>
                                    <blockquote class="text-secondary fs-5 fst-italic">“ <?php echo $DEPOIMENTO['depoimento'] ?> ”</blockquote>
                                    <h4 class="mt-4 font-400"><?php echo $DEPOIMENTO['nome'] ?></h4>
                                    <span class="text-primary font-fifteen"><?php echo $DEPOIMENTO['profissao'] ?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (!empty($array_imoveis_destaques)) { ?>
    <div class="full-row bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col mb-5">
                    <h2 class="down-line text-white w-50 mx-auto text-center w-sm-100">Imóveis em Destaque</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="3block-carusel nav-disable owl-carousel">
                        <?php foreach ($array_imoveis_destaques as $IMOVEL_DESTAQUE) {
                            $explode_bairro = explode('|separador|', $IMOVEL_DESTAQUE['bairro']);
                        ?>
                            <div class="item">
                                <div class="property-grid-1 property-block bg-white transation-this">
                                    <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                                        <div class="cata position-absolute"><span class="sale bg-secondary text-white"><?php echo $IMOVEL_DESTAQUE['operacao'] ?></span></div>
                                        <a href="<?php echo $IMOVEL_DESTAQUE['link'] ?>"><img src="<?php echo $IMOVEL_DESTAQUE['imagem'] ?>" alt="<?php echo $IMOVEL_DESTAQUE['titulo'] . ' - ' . get_bloginfo('name') ?>"></a>
                                    </div>
                                    <div class="property_text p-4">
                                        <span class="listing-price"><?php echo 'R$ ' . number_format($IMOVEL_DESTAQUE['valor'], 2, ',', '.') ?></span>
                                        <h5 class="listing-title"><a href="<?php echo $IMOVEL_DESTAQUE['link'] ?>"><?php echo $IMOVEL_DESTAQUE['titulo'] ?></a></h5>
                                        <span class="listing-location"><i class="fas fa-map-marker-alt"></i> <?php echo $explode_bairro[1] . ', ' . $explode_bairro[2] ?></span>
                                        <ul class="row text-center">
                                            <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-bed"></i></span><?php echo $IMOVEL_DESTAQUE['dormitorios'] ?></li>
                                            <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-shower"></i></span><?php echo $IMOVEL_DESTAQUE['banheiros'] ?></li>
                                            <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-car"></i></span><?php echo $IMOVEL_DESTAQUE['garagem'] ?></li>
                                            <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-vector-square"></i></span><?php echo $IMOVEL_DESTAQUE['area_terreno'] ?> m²</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="full-row bg-primary py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <h3 class="text-white xs-text-center my-20 font-400"><?php echo $array_institucional['CTA_01']['01'] ?></h3>
            </div>
            <div class="col-lg-3 col-md-4">
                <a href="<?php echo home_url() ?>/contato" class="btn btn-white y-center position-relative d-table xs-mx-auto ms-auto">Contato</a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
