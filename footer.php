<footer>
    <img src="<?php path_image('handel-white.svg'); ?>" alt="Handel">
    <div class="footer-info container">
        <div class="item">
            <h3>Páginas</h3>
            <?php 
             wp_nav_menu([
                 'menu' => 'footer',
                 'container' => 'nav',
                 'container_class' => 'footer-menu'
             ]);   
            ?>
        </div>
        <div class="item">
            <h3>Redes Sociais</h3>
            <?php 
             wp_nav_menu([
                 'menu' => 'social',
                 'container' => 'nav',
                 'container_class' => 'footer-social'
             ]);   
            ?>
        </div>
        <div class="item">
            <h3>Meios de pagamento</h3>
            <ul>
                <li>Cartão de Crédito</li>
                <li>Boleto Bancário</li>
                <li>PagSeguro</li>
            </ul>
        </div>
    </div>
    <?php 
    $countries = WC()->countries;
    $base_address = $countries->get_base_address();
    $base_city = $countries->get_base_city();
    $base_state = $countries->get_base_state();
    $complete_address = "$base_address, $base_city, $base_state"; 
    ?>
    <small class="footer-copy"><?php bloginfo(); ?> &copy; <?php echo date('Y').' - '.$complete_address;?></small>
</footer>
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri();?>/js/slide.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/script.js"></script>
</body>
</html>