<?php
get_header();
include '_breadcrumb.php';
?>

<div class="container notification">
    <?php wc_print_notices(); ?>
</div>

<main class="container single-product-page">    
<?php
if(have_posts()) { while (have_posts()) { the_post();
    $product_item = format_single_product(get_the_ID());
?>

<div class="product-gallery" data-gallery="gallery">
    <div class="product-gallery-list">
        <?php foreach($product_item['gallery'] as $img ){ ?>
            <img src="<?php echo $img; ?>" alt="<?php echo $product_item['name']; ?>" data-gallery="list">
        <?php } ?>
    </div>
    <div class="img-main">
        <img src="<?php echo $product_item['image']; ?>" alt="<?php echo $product_item['name']; ?>" data-gallery="main">
    </div>
</div>
<div class="product-info">
    <small><?php echo $product_item['sku']; ?></small>
    <h1><?php echo $product_item['name']; ?></h1>
    <p class="price"><?php echo $product_item['price']; ?></p>
    <?php woocommerce_template_single_add_to_cart(); ?>
    <h2>Descrição</h2>
    <p><?php echo $product_item['description']; ?></p>
</div>

<?php } } //fim do loop ?>
</main>

<?php 
$related_ids = wc_get_related_products($product_item['id'], 6);
$related_products =  [];
foreach($related_ids as $product_id){
    $related_products[] = wc_get_product($product_id);
}
$related = format_products($related_products);


?>
<section class="relateds separator">
    <div class="container">
        <h2>Relacionados</h2>
        <?php theme_products_list($related); ?>
    </div>
</section>

<?php get_footer(); ?>