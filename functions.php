<?php

function camille_files() {
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
    wp_enqueue_style('camille_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'camille_files');

function camille_features() {
    register_nav_menu('headerMenuLocation','Header Menu Location'); // first argument is computed name (codename), second argument is the menu location name that shows in the backend menu editor
    register_nav_menu('footerLocationOne','Footer Location One');
    register_nav_menu('footerLocationTwo','Footer Location Two');
    add_theme_support('title_tag');
}

add_action('after_setup_theme', 'camille_features');  // firts argument is the hook, second argument is the name of the function

function camille_adjust_queries($query) {     // Ability to adjust queries right before they are run
if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {      // ...to define the new rule doesn't apply back-end; Defining which page we want the rule to apply; Making sure we don't accidentally manipulate a custom query
    $today = date('Ymd');   
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
        array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => date($today),
            'type' => 'numeric' 
        )
    ));
}
}

add_action('pre_get_posts', 'camille_adjust_queries');