<?php

//adiciona o suporte ao woocommerce
function theme_add_woocommerce_support(){
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'theme_add_woocommerce_support');

//registra o arquivo de css
function theme_css(){
    wp_register_style('theme_style', get_template_directory_uri().'/style.css', [], '1.0.0');
    wp_enqueue_style('theme_style');
}
add_action('wp_enqueue_scripts', 'theme_css'); 

//tamanho das imagens
function theme_custom_images(){
    add_image_size('slide', 1000, 800, ['center', 'top']);
    update_option('medium_crop', 1);
}
add_action('after_setup_theme', 'theme_custom_images');

//quantidade de produtos mostrados na loja
function theme_loop_shop_per_page(){
    return 6;
}
add_filter('loop_shop_per_page', 'theme_loop_shop_per_page');