<?php

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


