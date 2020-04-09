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

//caminho das imagens
function path_image($image){
    echo get_template_directory_uri().'/images/'.$image;
}

//formatar produtos
function format_products($products, $img_size = 'medium'){
    $products_end = [];
    foreach($products as $product){
        $products_end[] = [
            'name' => $product->get_name(),
            'price' => $product->get_price_html(),
            'link' => $product->get_permalink(),
            'image' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
        ];
    }
    return $products_end;
}

//listar produtos
function theme_products_list($products){ ?>
    <ul class="products-list">
            <?php foreach($products as $product){ ?>
            <li>
                <a href="<?php echo $product['link']; ?>">
                    <div class="product-info">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h2><?php echo $product['name']; ?><span><?php echo $product['price']; ?></span></h2>
                    </div>
                    <div class="product-overlay">
                        <span class="btn-link">Ver Mais</span>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php }

//retornar categorias
function get_product_category_data($category){
    $cat = get_term_by('slug', $category, 'product_cat');
    $cat_id = $cat->term_id;
    $img_id = get_term_meta($cat_id, 'thumbnail_id', true);
    return [
        'name' => $cat->name,
        'id' => $cat_id,
        'link' => get_term_link($cat_id, 'product_cat'),
        'img' => wp_get_attachment_image_src($img_id, 'slide')[0]
    ];
}

//remove classes desnecessarios do body_class
function remove_some_body_class($classes) {
    $woo_class = array_search('woocommerce', $classes);
    $woopage_class = array_search('woocommerce-page', $classes);
    $search = in_array('archive', $classes) || in_array('product-template-default', $classes);
    if($woo_class && $woopage_class && $search) {
      unset($classes[$woo_class]);
      unset($classes[$woopage_class]);
    }
    return $classes;
  }
  add_filter('body_class', 'remove_some_body_class');
  
//formata o produto da single
function format_single_product($id, $img_size = 'medium'){
    $product = wc_get_product($id);

    $gallery_ids = $product->get_gallery_attachment_ids();
    $gallery = [];
    if($gallery_ids){
        foreach($gallery_ids as $img_id){
            $gallery[] = wp_get_attachment_image_src($img_id, $img_size)[0];
        }
    }

    return [
        'id' => $id,
        'name' => $product->get_name(),
        'price' => $product->get_price_html(),
        'link' => $product->get_permalink(),
        'sku' => $product->get_sku(),
        'description' => $product->get_description(),
        'image' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
        'gallery' => $gallery
    ];
}