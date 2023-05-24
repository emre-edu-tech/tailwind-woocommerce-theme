<?php
get_header('shop');
?>
    <?php do_action('woocommerce_before_main_content'); ?>
    
    <header class="woocommerce-products-header py-10 bg-gray-200">
        <div class="max-w-6xl mx-auto text-center">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <?php do_action('woocommerce_archive_description'); ?>
        </div>
    </header>
    
    <div class="max-w-6xl mx-auto py-10">
        <?php 
            if(woocommerce_product_loop()) {
                do_action('woocommerce_before_shop_loop');
                woocommerce_product_loop_start();
                if(wc_get_loop_prop('total')) {
                    while(have_posts()) {
                        the_post();
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                    }
                }
                woocommerce_product_loop_end();
                // woocommerce_pagionation is hooked - 10
                do_action( 'woocommerce_after_shop_loop' );
            } else {
                // wc_no_products_found function is hooked - 10
                do_action( 'woocommerce_no_products_found' );
            }

            // woocommerce_output_content_wrapper_end - outputs closing divs
            do_action( 'woocommerce_after_main_content' );

            // woocommerce_get_sidebar is hooked - 10
            do_action( 'woocommerce_sidebar' );
        ?>
    </div>

<?php
get_footer('shop');
