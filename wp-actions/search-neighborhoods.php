<?php
include_once '../wp-load.php';

if ($_POST['action'] == 'get_neighborhoods') {
    $return = null;
    if (isset($_POST['cities']) && is_array($_POST['cities']) && !empty($_POST['cities'])) {
        foreach ($_POST['cities'] as $CIDADES) {
            $args_cidades = new WP_Query(array(
                'post_type' => 'cpt_cidades',
                'posts_per_page' => 1,
                'post_status' => 'publish',
                'p' => $CIDADES
            ));
            if ($args_cidades->have_posts()) :
                while ($args_cidades->have_posts()) : $args_cidades->the_post();
                    $return .= '<optgroup label="' . get_the_title() . '">';
                    if (have_rows('bairros')) {
                        while (have_rows('bairros')) : the_row();
                            $return .= '<option value="' . get_the_ID() . '|separador|' . get_sub_field('bairro') . '">' . get_sub_field('bairro') . '</option>';
                        endwhile;
                    }
                    $return .= '</optgroup>';
                endwhile;
            endif;
        }
    }
    echo $return;
}
