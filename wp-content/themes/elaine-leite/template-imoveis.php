<?php

/**
 * Template Name: Imóveis
 */
global $wp;
$pagina = new WP_Query(array(
    'posts_per_page' => 1,
    'post_type' => 'page',
    'p' => url_to_postid(home_url($wp->request))
));

$array_cidades = $array_tipos_imoveis = $array_itens_destaque = array();

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
$bairros = null;
$filtro_operacao = $filtro_finalidade = $filtro_dormitorios = $filtro_banheiros = $filtro_garagem = $filtro_valor_minimo = $filtro_valor_maximo = null;
$filtro_cidades = $filtro_tipos_imoveis = $filtro_bairros = $filtro_itens = $array_imoveis = array();
$array_filtro = array('relation' => 'AND');

if (isset($_GET['operacao']) && !empty($_GET['operacao'])) {
    $filtro_operacao = $_GET['operacao'];
    $array_filtro[] = array(
        'key' => 'operacao',
        'value' => $_GET['operacao'],
        'compare' => '='
    );
}
if (isset($_GET['bairros']) && !empty($_GET['bairros'])) {
    $filtro_bairros = $_GET['bairros'];
    $array_filtro_bairro = array('relation' => 'OR');
    foreach ($_GET['bairros'] as $BAIRROS) {
        $array_filtro_bairro[] = array(
            'key' => 'bairro',
            'value' => $BAIRROS,
            'compare' => 'LIKE'
        );
    }
    $array_filtro[] = array(
        $array_filtro_bairro
    );
}
if (isset($_GET['cidades']) && !empty($_GET['cidades'])) {
    $filtro_cidades = $_GET['cidades'];
    $array_filtro_cidade = array('relation' => 'OR');
    foreach ($_GET['cidades'] as $CIDADES) {
        $array_filtro_cidade[] = array(
            'key' => 'bairro',
            'value' => $CIDADES . '|separador|',
            'compare' => 'LIKE'
        );
        $args_cidades_busca = new WP_Query(array(
            'post_type' => 'cpt_cidades',
            'posts_per_page' => 1,
            'post_status' => 'publish',
            'p' => $CIDADES
        ));
        if ($args_cidades_busca->have_posts()) :
            while ($args_cidades_busca->have_posts()) : $args_cidades_busca->the_post();
                $bairros .= '<optgroup label="' . get_the_title() . '">';
                if (have_rows('bairros')) {
                    while (have_rows('bairros')) : the_row();
                        $selected = '';
                        if (in_array(get_the_ID() . '|separador|' . get_sub_field('bairro'), $filtro_bairros)) {
                            $selected = 'selected';
                        }
                        $bairros .= '<option value="' . get_the_ID() . '|separador|' . get_sub_field('bairro') . '" ' . $selected . '>' . get_sub_field('bairro') . '</option>';
                    endwhile;
                }
                $bairros .= '</optgroup>';
            endwhile;
        endif;
    }
    $array_filtro[] = array(
        $array_filtro_cidade
    );
}
if ((isset($_GET['tipos_imoveis']) && !empty($_GET['tipos_imoveis'])) || isset($_GET['cat_imovel'])) {
    if (isset($_GET['cat_imovel'])) {
        if (!empty($array_tipos_imoveis)) {
            $filtro_tipos_imoveis = array();
            foreach ($array_tipos_imoveis as $TIPO) {
                if ((int)$TIPO['id'] === (int) $_GET['cat_imovel']) {
                    if (!empty($TIPO['subtipos'])) {
                        $array_filtro_tipo_imovel = array('relation' => 'OR');
                        foreach ($TIPO['subtipos'] as $SUBTIPO) {
                            $filtro_tipos_imoveis[] = $TIPO['id'] . '|separador|' . $SUBTIPO['subtipo'];
                            $array_filtro_tipo_imovel[] = array(
                                'key' => 'tipo_imovel',
                                'value' => $TIPO['id'] . '|separador|' . $SUBTIPO['subtipo'],
                                'compare' => '='
                            );
                        }
                    }
                }
            }
        }
    } else {
        $filtro_tipos_imoveis = $_GET['tipos_imoveis'];
        $array_filtro_tipo_imovel = array('relation' => 'OR');
        foreach ($_GET['tipos_imoveis'] as $TIPOS_IMOVEIS) {
            $array_filtro_tipo_imovel[] = array(
                'key' => 'tipo_imovel',
                'value' => $TIPOS_IMOVEIS,
                'compare' => '='
            );
        }
    }
    $array_filtro[] = array(
        $array_filtro_tipo_imovel
    );
}
if (isset($_GET['finalidade']) && !empty($_GET['finalidade'])) {
    $filtro_finalidade = $_GET['finalidade'];
    $array_filtro[] = array(
        'key' => 'finalidade',
        'value' => $_GET['finalidade'],
        'compare' => '='
    );
}
if (isset($_GET['dormitorios']) && !empty($_GET['dormitorios'])) {
    $filtro_dormitorios = $_GET['dormitorios'];
    if (strpos($_GET['dormitorios'], '+') !== false) {
        $array_filtro[] = array(
            'key' => 'detalhes_dormitorios',
            'value' => str_replace('+', '', $_GET['dormitorios']),
            'compare' => '>'
        );
    } else {
        $array_filtro[] = array(
            'key' => 'detalhes_dormitorios',
            'value' => $_GET['dormitorios'],
            'compare' => '='
        );
    }
}
if (isset($_GET['banheiros']) && !empty($_GET['banheiros'])) {
    $filtro_banheiros = $_GET['banheiros'];
    if (strpos($_GET['banheiros'], '+') !== false) {
        $array_filtro[] = array(
            'key' => 'detalhes_banheiros',
            'value' => str_replace('+', '', $_GET['banheiros']),
            'compare' => '>'
        );
    } else {
        $array_filtro[] = array(
            'key' => 'detalhes_banheiros',
            'value' => $_GET['banheiros'],
            'compare' => '='
        );
    }
}
if (isset($_GET['garagem']) && !empty($_GET['garagem'])) {
    $filtro_garagem = $_GET['garagem'];
    if (strpos($_GET['garagem'], '+') !== false) {
        $array_filtro[] = array(
            'key' => 'detalhes_garagem',
            'value' => str_replace('+', '', $_GET['garagem']),
            'compare' => '>'
        );
    } else {
        $array_filtro[] = array(
            'key' => 'detalhes_garagem',
            'value' => $_GET['garagem'],
            'compare' => '='
        );
    }
}
if (isset($_GET['valor_minimo']) && !empty($_GET['valor_minimo'])) {
    $filtro_valor_minimo = $_GET['valor_minimo'];
    $array_filtro[] = array(
        'key' => 'valor',
        'value' => $_GET['valor_minimo'],
        'compare' => '>='
    );
}
if (isset($_GET['valor_maximo']) && !empty($_GET['valor_maximo'])) {
    $filtro_valor_maximo = $_GET['valor_maximo'];
    $array_filtro[] = array(
        'key' => 'valor',
        'value' => $_GET['valor_maximo'],
        'compare' => '<='
    );
}
if (isset($_GET['itens']) && !empty($_GET['itens'])) {
    $filtro_itens = $_GET['itens'];
    $array_filtro_itens = array('relation' => 'OR');
    foreach ($_GET['itens'] as $ITENS) {
        $array_filtro_itens[] = array(
            'key' => 'itens_destaque',
            'value' => $ITENS,
            'compare' => 'LIKE'
        );
    }
    $array_filtro[] = array(
        $array_filtro_itens
    );
}

$args_imoveis = new WP_Query(array(
    'post_type' => 'cpt_imoveis',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'ASC',
    'meta_query' => array(
        $array_filtro
    )
));
if ($args_imoveis->have_posts()) :
    while ($args_imoveis->have_posts()) : $args_imoveis->the_post();
        $array_imoveis[] = array(
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
            'itens_destaque' => get_field('itens_destaque'),
        );
    endwhile;
endif;
/*echo '<pre>';
print_r($array_imoveis);
echo '</pre>';
exit;*/
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

        <div class="full-row pb-100 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="listing-sidebar">
                            <div class="widget advance_search_widget">
                                <h5 class="mb-30">Filtro</h5>
                                <form class="rounded quick-search form-icon-right" action="<?php echo home_url() ?>/imoveis" method="GET">
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="operacao" title="Operação" data-live-search="true">
                                                <option value="" disabled>Operação</option>
                                                <option value="Locação" <?php if ($filtro_operacao === 'Locação') {
                                                                            echo 'selected';
                                                                        } ?>>Locação</option>
                                                <option value="Venda" <?php if ($filtro_operacao === 'Venda') {
                                                                            echo 'selected';
                                                                        } ?>>Venda</option>
                                                <option value="Lançamento" <?php if ($filtro_operacao === 'Lançamento') {
                                                                                echo 'selected';
                                                                            } ?>>Lançamento</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="cidades[]" multiple title="Cidade" data-live-search="true">
                                                <option value="" disabled>Cidade</option>
                                                <?php if (!empty($array_cidades)) { ?>
                                                    <?php foreach ($array_cidades as $CIDADE) { ?>
                                                        <option value="<?php echo $CIDADE['id'] ?>" <?php if (in_array($CIDADE['id'], $filtro_cidades)) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $CIDADE['cidade'] ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="tipos_imoveis[]" multiple title="Tipo" data-live-search="true">
                                                <option value="" disabled>Tipo</option>
                                                <?php if (!empty($array_tipos_imoveis)) { ?>
                                                    <?php foreach ($array_tipos_imoveis as $TIPO_IMOVEL) { ?>
                                                        <optgroup label="<?php echo $TIPO_IMOVEL['tipo_imovel'] ?>">
                                                            <?php if ($TIPO_IMOVEL['subtipos'] !== null && is_array($TIPO_IMOVEL['subtipos']) && !empty($TIPO_IMOVEL['subtipos'])) { ?>
                                                                <?php foreach ($TIPO_IMOVEL['subtipos'] as $SUBTIPO) { ?>
                                                                    <option value="<?php echo $TIPO_IMOVEL['id'] . '|separador|' . $SUBTIPO['subtipo'] ?>" <?php if (in_array($TIPO_IMOVEL['id'] . '|separador|' . $SUBTIPO['subtipo'], $filtro_tipos_imoveis)) {
                                                                                                                                                                echo 'selected';
                                                                                                                                                            } ?>><?php echo $SUBTIPO['subtipo'] ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </optgroup>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="bairros[]" multiple title="Bairro" data-live-search="true" <?php if ($bairros === null) {
                                                                                                                                                            echo 'disabled';
                                                                                                                                                        } ?>>
                                                <option value="" disabled>Bairro</option>
                                                <?php echo $bairros; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="finalidade" title="Finalidade" data-live-search="true">
                                                <option value="" disabled>Finalidade</option>
                                                <option value="Residencial" <?php if ($filtro_finalidade === 'Residencial') {
                                                                                echo 'selected';
                                                                            } ?>>Residencial</option>
                                                <option value="Comercial" <?php if ($filtro_finalidade === 'Comercial') {
                                                                                echo 'selected';
                                                                            } ?>>Comercial</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="dormitorios" title="Dormitórios" data-live-search="true">
                                                <option value="" disabled>Dormitórios</option>
                                                <option value="1" <?php if ($filtro_dormitorios === '1') {
                                                                        echo 'selected';
                                                                    } ?>>1 dormitório</option>
                                                <option value="2" <?php if ($filtro_dormitorios === '2') {
                                                                        echo 'selected';
                                                                    } ?>>2 dormitórios</option>
                                                <option value="3" <?php if ($filtro_dormitorios === '3') {
                                                                        echo 'selected';
                                                                    } ?>>3 dormitórios</option>
                                                <option value="4" <?php if ($filtro_dormitorios === '4') {
                                                                        echo 'selected';
                                                                    } ?>>4 dormitórios</option>
                                                <option value="5" <?php if ($filtro_dormitorios === '5') {
                                                                        echo 'selected';
                                                                    } ?>>5 dormitórios</option>
                                                <option value="5+" <?php if ($filtro_dormitorios === '5+') {
                                                                        echo 'selected';
                                                                    } ?>>+ de 5 dormitórios</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="banheiros" title="Banheiros" data-live-search="true">
                                                <option value="" disabled>Banheiros</option>
                                                <option value="1" <?php if ($filtro_banheiros === '1') {
                                                                        echo 'selected';
                                                                    } ?>>1 banheiro</option>
                                                <option value="2" <?php if ($filtro_banheiros === '2') {
                                                                        echo 'selected';
                                                                    } ?>>2 banheiros</option>
                                                <option value="3" <?php if ($filtro_banheiros === '3') {
                                                                        echo 'selected';
                                                                    } ?>>3 banheiros</option>
                                                <option value="3+" <?php if ($filtro_banheiros === '3+') {
                                                                        echo 'selected';
                                                                    } ?>>+ de 3 banheiros</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="garagem" title="Vagas de Garagem" data-live-search="true">
                                                <option value="" disabled>Vagas de Garagem</option>
                                                <option value="1" <?php if ($filtro_garagem === '1') {
                                                                        echo 'selected';
                                                                    } ?>>1 vaga</option>
                                                <option value="2" <?php if ($filtro_garagem === '2') {
                                                                        echo 'selected';
                                                                    } ?>>2 vagas</option>
                                                <option value="3" <?php if ($filtro_garagem === '3') {
                                                                        echo 'selected';
                                                                    } ?>>3 vagas</option>
                                                <option value="3+" <?php if ($filtro_garagem === '3+') {
                                                                        echo 'selected';
                                                                    } ?>>+ de 3 vagas</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="valor_minimo" title="Valor Mínimo" data-live-search="true">
                                                <option value="" disabled>Valor Mínimo</option>
                                                <option value="400" <?php if ($filtro_valor_minimo === '400') {
                                                                        echo 'selected';
                                                                    } ?>>R$ 400,00</option>
                                                <option value="800" <?php if ($filtro_valor_minimo === '800') {
                                                                        echo 'selected';
                                                                    } ?>>R$ 800,00</option>
                                                <option value="1200" <?php if ($filtro_valor_minimo === '1200') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 1.200,00</option>
                                                <option value="1500" <?php if ($filtro_valor_minimo === '1500') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 1.500,00</option>
                                                <option value="3000" <?php if ($filtro_valor_minimo === '3000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 3.000,00</option>
                                                <option value="5000" <?php if ($filtro_valor_minimo === '5000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 5.000,00</option>
                                                <option value="80000" <?php if ($filtro_valor_minimo === '80000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 80.000,00</option>
                                                <option value="160000" <?php if ($filtro_valor_minimo === '160000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 160.000,00</option>
                                                <option value="300000" <?php if ($filtro_valor_minimo === '300000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 300.000,00</option>
                                                <option value="750000" <?php if ($filtro_valor_minimo === '750000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 750.000,00</option>
                                                <option value="1000000" <?php if ($filtro_valor_minimo === '1000000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 1.000.000,00</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="valor_maximo" title="Valor Máximo" data-live-search="true">
                                                <option value="" disabled>Valor Máximo</option>
                                                <option value="400" <?php if ($filtro_valor_maximo === '400') {
                                                                        echo 'selected';
                                                                    } ?>>R$ 400,00</option>
                                                <option value="800" <?php if ($filtro_valor_maximo === '800') {
                                                                        echo 'selected';
                                                                    } ?>>R$ 800,00</option>
                                                <option value="1200" <?php if ($filtro_valor_maximo === '1200') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 1.200,00</option>
                                                <option value="1500" <?php if ($filtro_valor_maximo === '1500') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 1.500,00</option>
                                                <option value="3000" <?php if ($filtro_valor_maximo === '3000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 3.000,00</option>
                                                <option value="5000" <?php if ($filtro_valor_maximo === '5000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 5.000,00</option>
                                                <option value="80000" <?php if ($filtro_valor_maximo === '80000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 80.000,00</option>
                                                <option value="160000" <?php if ($filtro_valor_maximo === '160000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 160.000,00</option>
                                                <option value="300000" <?php if ($filtro_valor_maximo === '300000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 300.000,00</option>
                                                <option value="750000" <?php if ($filtro_valor_maximo === '750000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 750.000,00</option>
                                                <option value="1000000" <?php if ($filtro_valor_maximo === '1000000') {
                                                                            echo 'selected';
                                                                        } ?>>R$ 1.000.000,00</option>
                                                <option value="10000000" <?php if ($filtro_valor_maximo === '10000000') {
                                                                                echo 'selected';
                                                                            } ?>>R$ 10.000.000,00</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control selectpicker" name="itens[]" multiple title="Itens" data-live-search="true">
                                                <option value="" disabled>Itens</option>
                                                <?php if (!empty($array_itens_destaque)) { ?>
                                                    <?php foreach ($array_itens_destaque as $ITEM) { ?>
                                                        <option value="<?php echo $ITEM['id'] ?>" <?php if (in_array($ITEM['id'], $filtro_itens)) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $ITEM['item'] ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100">Filtrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-7">
                        <div class="row">
                            <div class="col">
                                <div class="woo-filter-bar p-3 d-flex flex-wrap justify-content-center">
                                    <div class="d-flex">
                                        <span class="woocommerce-ordering-pages me-4 font-fifteen">
                                            <?php if ((int)sizeof($array_imoveis) > 0) {
                                                if ((int)sizeof($array_imoveis) > 1) {
                                                    echo sizeof($array_imoveis) . ' imóveis encontrados';
                                                } else {
                                                    echo sizeof($array_imoveis) . ' imóvel encontrado';
                                                }
                                            } else {
                                                echo 'Nenhum imóvel encontrado';
                                            } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($array_imoveis)) { ?>
                            <div class="row row-cols-xl-2 row-cols-lg-1 row-cols-md-2 row-cols-1 g-4">
                                <?php foreach ($array_imoveis as $IMOVEL) {
                                    $explode_bairro = explode('|separador|', $IMOVEL['bairro']);
                                ?>
                                    <div class="col">
                                        <div class="property-grid-1 property-block bg-white transation-this hover-shadow">
                                            <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                                                <div class="cata position-absolute"><span class="sale bg-secondary text-white"><?php echo $IMOVEL['operacao'] ?></span></div>
                                                <a href="<?php echo $IMOVEL['link'] ?>"><img src="<?php echo $IMOVEL['imagem'] ?>" alt="<?php echo $IMOVEL['titulo'] . ' - ' . get_bloginfo('name') ?>"></a>
                                            </div>
                                            <div class="property_text p-4">
                                                <span class="listing-price"><?php echo 'R$ ' . number_format($IMOVEL['valor'], 2, ',', '.') ?></span>
                                                <h5 class="listing-title"><a href="<?php echo $IMOVEL['link'] ?>"><?php echo $IMOVEL['titulo'] ?></a></h5>
                                                <span class="listing-location"><i class="fas fa-map-marker-alt"></i> <?php echo $explode_bairro[1] . ', ' . $explode_bairro[2] ?></span>
                                                <ul class="row text-center">
                                                    <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-bed"></i></span><?php echo $IMOVEL['dormitorios'] ?></li>
                                                    <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-shower"></i></span><?php echo $IMOVEL['banheiros'] ?></li>
                                                    <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-car"></i></span><?php echo $IMOVEL['garagem'] ?></li>
                                                    <li class="col-lg-3"><span style="display: block;"><i class="fa-solid fa-vector-square"></i></span><?php echo $IMOVEL['area_terreno'] ?> m²</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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
