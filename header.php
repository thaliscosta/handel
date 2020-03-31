<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">
	<title><?php bloginfo('name'); wp_title('|'); ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,500i,700,700i,900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="container">
	<a href=""><img src="<?php path_image('handel.svg'); ?>" alt="Handel"></a>
	<div class="search">
		<form action="<?php bloginfo('url'); ?>/<?php echo site_url(13); ?>/" method="get">
			<input type="text" name="s" class="s" placeholder="Buscar" value="<?php the_search_query(); ?>">
			<input type="text" name="post_type" value="product" class="hidden">
			<input type="submit" value="Buscar" class="searchbutton">
		</form>
	</div>
	<div class="account">
		<a href="<?php echo site_url(16); ?>" class="my-account">Minha Conta</a>
		<a href="<?php echo site_url(14); ?>" class="cart">Carrinho
		<?php 
		$cart_count = WC()->cart->get_cart_contents_count();
		if($cart_count){ ?> 
		<span><?php echo $cart_count; ?></span>
		<?php } ?>
		</a>
	</div>
</header>
<?php
wp_nav_menu([
	'menu' => 'categorias',
	'container' => 'nav',
	'container_class' => 'menu-categories'
]);

?>	

 