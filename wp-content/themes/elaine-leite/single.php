<?php
global $wp;
$blog = new WP_Query(array(
    'posts_per_page' => 1,
    'post_type' => 'post',
    'p' => url_to_postid(home_url($wp->request))
        ));

get_header();
?> 
<?php
get_footer();
