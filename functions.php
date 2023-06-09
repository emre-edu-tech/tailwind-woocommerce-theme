<?php

add_action('wp_enqueue_scripts', 'boilerplate_load_assets');
function boilerplate_load_assets()
{
	// Add font awesome support
	wp_enqueue_style('font-awesome-6', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
	wp_enqueue_script('woo-mainjs', get_theme_file_uri('/build/index.js'), array('wp-element', 'jquery'), '1.0', true);
	wp_enqueue_style('woo-maincss', get_theme_file_uri('/build/index.css'));
	wp_localize_script('woo-mainjs', 'wooCustomData', [
		'root_url' => get_site_url(),
		'ajax_url' => admin_url('admin-ajax.php'),
		'security' => wp_create_nonce('custom-ajax-requesyt')
	]);
}

add_action('after_setup_theme', 'boilerplate_add_support');
function boilerplate_add_support()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo', [
		'flex-width' => true,
		'flex-height' => true,
		'header-text' => ['site-title', 'site-description']
	]);
	// This line below is necessary if there will be template overrides in Custom Theme
	add_theme_support('woocommerce');
	// Enable the Product Gallery Features (Zoom, Swipe, Lightbox)
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

// WOOCOMMERCE THEME OVERRIDES
// Disable all Woocommerce Styles - Necessary if creating a theme from scratch
add_filter('woocommerce_enqueue_styles', '__return_false');
// Remove breadcrumb before main content
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
// Add breadcrumb in header just after page title
add_action('woocommerce_archive_description', 'woocommerce_breadcrumb', 11);
// Override the html for on sale badge
add_filter('woocommerce_sale_flash', function() {
	return '<span class="absolute top-2 right-2 bg-primary text-white rounded-full p-1 text-base font-semibold onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>';
});
// Override the Product Loop Thumbnail
// Note: There is no dedicated thumbnail for this part
// Thumbnail is generated using filter
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
// Add custom action for loop product thumbnail
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
if(!function_exists('woocommerce_template_loop_product_thumbnail')) {
	function woocommerce_template_loop_product_thumbnail() {
		// echo out the html for the custom thumbnail image
		$output = has_post_thumbnail() ? get_the_post_thumbnail(get_the_ID(), 'post-thumbnail', [
			'class' => 'shadow-md',
			'alt' => get_the_title(),
			'title' => get_the_title(),
		]) : 'Product Placeholder image will be echoed';
		echo $output;
	}
}
// Change the place of closing link on product loop
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11);

// Put custom HTML before Product Title
add_action('woocommerce_shop_loop_item_title', 'add_custom_start_html_before_shop_loop_title', 5);
function add_custom_start_html_before_shop_loop_title() {
	$output = '<div class="product-info-container flex flex-col items-center p-2">';
	echo $output;
}
add_action('woocommerce_after_shop_loop_item', 'add_custom_end_html_before_shop_loop_title', 11);
function add_custom_end_html_before_shop_loop_title() {
	$output = '</div>';
	echo $output;
}

// Put custom html before shop loop to style the result count and catalog ordering
add_action('woocommerce_before_shop_loop', 'add_custom_start_html_before_shop_loop', 11);
function add_custom_start_html_before_shop_loop() {
	$output = '<div class="shop-info-container flex justify-between items-center py-3">';
	echo $output;
}
// Put custom html just after the result count and catalog ordering
add_action('woocommerce_before_shop_loop', 'add_custom_end_html_before_shop_loop', 31);
function add_custom_end_html_before_shop_loop() {
	$output = '</div>';
	echo $output;
}

// Customize the shop loop item TITLE
// First remove the default action
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
// Now create custom action and rebuild it
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
function woocommerce_template_loop_product_title() {
	$output = '<h3 class="' . apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title text-center py-2 text-lg text-primary hover:text-slate-600') . '"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
	echo $output;
}

// CUSTOMIZING DEFAULT WORDPRESS LOGIN SCREEN
add_filter('login_headerurl', 'customwoo_login_headerurl');
function customwoo_login_headerurl() {
	return esc_url(site_url('/'));
}
