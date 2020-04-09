<?php get_header(); ?>

<?php 
$products = [];
if(have_posts()) { while(have_posts()){ the_post();
    $products[] = wc_get_product(get_the_ID());

 }}

 $data = [];
 $data['produtos'] = format_products($products);

 include '_breadcrumb.php';
 ?>

 <main class="container products-archive">
    <nav class="filters">
        <div class="filter">
            <h3>Categorias</h3>
            <?php wp_nav_menu([
                'menu' => 'categorias-internas',
                'menu_class' => 'cat',
                'container' => false
            ]); ?>
        </div>
        <div class="filter">
            <?php 
            $attribute_taxonomies = wc_get_attribute_taxonomies();
            foreach($attribute_taxonomies as $attribute){
                the_widget('WC_Widget_Layered_Nav', [
                    'title' => $attribute->attribute_label,
                    'attribute' => $attribute->attribute_name,
                ]);
            }
            ?>
        </div>
        <div class="filter">
            <h3>Filtrar por preço</h3>
            <form action="" class="filter-price">
                <div>
                    <label for="min_price">De R$</label>
                    <input type="text" required name="min_price" id="min_price" value="<?php $_GET['min_price']; ?>">
                </div>
                <div>
                    <label for="max_price">Até R$</label>
                    <input type="text" required name="max_price" id="max_price" value="<?php $_GET['max_price']; ?>">
                </div>
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </nav>
    <div class="listagem">
        <?php
        if($data['produtos'][0]){
        woocommerce_catalog_ordering();

         theme_products_list($data['produtos']);
        } else {
            echo "<p>Nenhum resultado para sua busca.</p>";
        }
         
         ?>
    </div>
    <?php echo get_the_posts_pagination(); ?>
 </main>


<?php get_footer(); ?>