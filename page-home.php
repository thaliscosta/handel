<?php
/*
Template name: Home
*/ 
get_header();

$products_slide = wc_get_products([
    'limit' => 6,
    'tag' => ['slide'],
]);

$products_new = wc_get_products([
    'limit' => 9,
    'orderby' => 'date',
    'order' => 'DESC',
]);

$products_sales = wc_get_products([
    'limit' => 9,
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
]);

$data = [];

$data['slides'] = format_products($products_slide, 'slide');
$data['releases'] = format_products($products_new, 'medium');
$data['sales'] =  format_products($products_sales, 'medium');

$home_id = get_the_ID();
$left_category = get_post_meta($home_id, 'categoria_esquerda', true);
$right_category = get_post_meta($home_id, 'categoria_direita', true);

$data['categorias'][$left_category] = get_product_category_data($left_category);
$data['categorias'][$right_category] = get_product_category_data($right_category);
?>

<?php if(have_posts()) { while (have_posts()) { the_post(); ?>
<main id="home">
    <ul class="benefits">
        <li>Frete Grátis</li>
        <li>Troca Fácil</li>
        <li>Até 12 Vezes</li>
    </ul>
    <section class="slide-wrapper">
        <ul class="slide">
            <?php foreach($data['slides'] as $product){ ?>
            <li class="slide-item">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <div class="slide-info">
                    <span class="price"><?php echo $product['price']; ?></span>
                    <h2><?php echo $product['name']; ?></h2>
                    <a href="<?php echo $product['link']; ?>" class="btn-link">Ver produto</a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </section>
    <section class="container">
        <h2 class="sub-title">Lançamentos</h2>
        <?php theme_products_list($data['releases']); ?>
    </section>
    <section class="categories-home">
        <?php foreach($data['categorias'] as $category){ ?>
            <a href="<?php echo $category['link']; ?>">
                <img src="<?php echo $category['img'];?>" alt="<?php echo $category['name'];?>">
                <span class="btn-link"><?php echo $category['name'];?></span>
            </a>
        <?php } ?>
    </section>
    <section class="container">
        <h2 class="sub-title">Mais Vendidos</h2>
        <?php theme_products_list($data['sales']); ?>
    </section>
    
</main>

<?php } } ?>

<?php get_footer(); ?>