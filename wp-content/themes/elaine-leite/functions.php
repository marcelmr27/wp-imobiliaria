<?php

function register_my_session()
{
    if (!session_id()) {
        session_start();
    }
}

add_action('init', 'register_my_session');

add_action('after_setup_theme', 'your_theme_features');

function your_theme_features()
{
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1280, 720);
}

add_theme_support('title-tag');

add_theme_support('post-thumbnails');


add_filter('acf/prepare_field/name=tipo_imovel', 'acf_allow_tipo_imovel_optgroup');

function acf_allow_tipo_imovel_optgroup($field)
{
    if ($field['ID'] === 0) {
        return $field;
    }

    $args_tipos_imoveis = new WP_Query(array(
        'post_type' => 'cpt_tipos_imoveis',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    $current_group = '';
    $choices = [];
    if ($args_tipos_imoveis->have_posts()) :
        while ($args_tipos_imoveis->have_posts()) : $args_tipos_imoveis->the_post();
            $current_group = get_the_title();
            $choices[$current_group] = [];
            $subtipos = get_field('subtipos');
            if ($subtipos !== null && is_array($subtipos) && !empty($subtipos)) {
                foreach ($subtipos as $ITEM) {
                    $choices[$current_group][get_the_ID() . '|separador|' . $ITEM['subtipo']] = $ITEM['subtipo'];
                }
            }
        endwhile;
    endif;

    $field['choices'] = $choices;
    return $field;
}

add_filter('acf/prepare_field/name=bairro', 'acf_allow_bairro_optgroup');

function acf_allow_bairro_optgroup($field)
{
    if ($field['ID'] === 0) {
        return $field;
    }

    $args_tipos_imoveis = new WP_Query(array(
        'post_type' => 'cpt_cidades',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    $current_group = '';
    $choices = [];
    if ($args_tipos_imoveis->have_posts()) :
        while ($args_tipos_imoveis->have_posts()) : $args_tipos_imoveis->the_post();
            $current_group = get_the_title();
            $choices[$current_group] = [];
            $bairros = get_field('bairros');
            if ($bairros !== null && is_array($bairros) && !empty($bairros)) {
                foreach ($bairros as $ITEM) {
                    $choices[$current_group][get_the_ID() . '|separador|' . $ITEM['bairro'] . '|separador|' . get_the_title()] = $ITEM['bairro'];
                }
            }
        endwhile;
    endif;

    $field['choices'] = $choices;
    return $field;
}

add_filter('acf/format_value/type=number', 'fix_number', 20, 3);
function fix_number($value, $post_id, $field)
{
    $keys = array(
        'field_63794048df4fd'
    );
    if (in_array($field['key'], $keys)) {
        $value = floatval($value);
    }
    return $value;
}
