<?php
$accordion_posts = new WP_Query(
    array(
        'post_type'      => 'wpnice-accordion',
        'posts_per_page' => -1,
        'fields'         => 'ids')
);

$accordion_ids    = $accordion_posts->posts;
$wpnp_dynamic_css = '';

foreach ($accordion_ids as $accordion_id) {
    $accordion_id;
    $shortcode_data = get_post_meta($accordion_id, 'wpnice_accordion_options', true);

    $titleTypograpy       = !empty($shortcode_data['opt-typography-title']) ? $shortcode_data['opt-typography-title'] : '';
    $activeTitleTypograpy = !empty($shortcode_data['active-title-color']) ? $shortcode_data['active-title-color'] : '';

    $title_color        = !empty($titleTypograpy['color']) ? 'color:' . $titleTypograpy['color'] : '';
    $active_title_color = !empty($activeTitleTypograpy) ? 'color:' . $activeTitleTypograpy : '';

    if(!empty($title_color)) :
        $wpnp_dynamic_css .= '#wpnp_' . $accordion_id . ' .accordion-button{ ' . $title_color . ';}';
        $wpnp_dynamic_css .= '#wpnp_' . $accordion_id . ' .accordion-button:after{ ' . $title_color . ';}';
    endif;

    if(!empty($active_title_color)):
        $wpnp_dynamic_css .= '#wpnp_' . $accordion_id . ' .accordion-button:not(.collapsed){ ' . $active_title_color . ';}';
        $wpnp_dynamic_css .= '#wpnp_' . $accordion_id . ' .accordion-button:not(.collapsed):after{ ' . $active_title_color . ';}';
    endif;

    //title bg color settings
    $title_bg_color = !empty($shortcode_data['title-bg-color']) ? $shortcode_data['title-bg-color'] : '';
    $title_bg_color = !empty($title_bg_color) ? 'background:' . $title_bg_color : '';
    if(!empty($title_bg_color)) :
        $wpnp_dynamic_css .= '#wpnp_' . $accordion_id . ' .accordion-button{ ' . $title_bg_color . ';}';
    endif;

    //active title bg color
    $active_title_bg_color = !empty($shortcode_data['active-title-bg-color']) ? $shortcode_data['active-title-bg-color'] : '';
    $active_title_bg_color = !empty($active_title_bg_color) ? 'background:' . $active_title_bg_color : '';
    if(!empty($active_title_bg_color)):
        $wpnp_dynamic_css .= '#wpnp_' . $accordion_id . ' .accordion-button:not(.collapsed){ ' . $active_title_bg_color . ';}';
    endif;

    //dynamic css for description
    $descTypograpy       = !empty($shortcode_data['opt-typography-desc']) ? $shortcode_data['opt-typography-desc'] : '';
    $desc_color        = !empty($descTypograpy['color']) ? 'color:' . $descTypograpy['color'] : '';
    if(!empty($desc_color)) :
        $wpnp_dynamic_css .= '#wpnp_' . $accordion_id . ' .accordion-body{ ' . $desc_color . ';}';
       
    endif;

    $desc_bg_color = !empty($shortcode_data['desc-bg-color']) ? $shortcode_data['desc-bg-color'] : '';
    $desc_bg_color = !empty($desc_bg_color) ? 'background:' . $desc_bg_color : '';
    if(!empty($desc_bg_color)) :
        $wpnp_dynamic_css .= '#wpnp_' . $accordion_id . ' .accordion-body{ ' . $desc_bg_color . ';}';
    endif;

}