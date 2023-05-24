<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby bg-primary text-white p-2" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
