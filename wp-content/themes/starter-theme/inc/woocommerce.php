<?php
/**
 * Starter Theme WooCommerce functions and definitions.
 *
 * @package Theme Name
 */

defined( 'ABSPATH' ) || die( 'Nice try' );

/* Woocommerce Globals*/
define( 'MY_ACCOUNT_PERMALINK', ( get_option( 'woocommerce_myaccount_page_id' ) ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : '' );

/**
 * Defines the text to be displayed on Add to Cart buttons on product pages.
 *
 * @access   public
 * @since    1.0.0
 * @return string
 */
function starter_single_add_to_cart_text() {
	return __( 'Add to Basket', 'starter-theme' );
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'starter_single_add_to_cart_text' );

/**
 * Defines the text to be displayed on Add to Cart buttons on product pages.
 *
 * @access   public
 * @since    1.0.0
 * @return string
 */
function starter_archive_add_to_cart_text() {
	return __( 'Add to Basket', 'starter-theme' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'starter_archive_add_to_cart_text' );

/**
 * Displays breadcrumbs on the WooCommerce pages.
 *
 * @access   public
 * @since    1.0.0
 */
function starter_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '',
		'wrap_before' => '<nav class="o-breadcrumb u-overflow u-hidden@print" itemprop="breadcrumb"><ul>',
		'wrap_after'  => '</ul></nav>',
		'before'      => '<li class="o-breadcrumb__crumb">',
		'after'       => '</li>',
		'home'        => _x( 'Home', 'breadcrumb', 'starter-theme' ),
	);
}
add_filter( 'woocommerce_breadcrumb_defaults', 'starter_woocommerce_breadcrumbs' );

/**
 * Displays add to cart links.
 *
 * @access   public
 * @since    1.0.0
 * @return 	 string
 */
function starter_add_to_cart_message() {
	if ( get_option( 'woocommerce_cart_redirect_after_add' ) === 'yes' ) :
		$message = sprintf( '%s<a href="%s" class="your-style">%s</a>', __( 'Successfully added to cart.', 'starter-theme' ), esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ), __( 'Continue Shopping', 'starter-theme' ) );
	else :
		$message = sprintf( '%s<a href="%s" class="your-class">%s</a>', __( 'Successfully added to cart.' , 'starter-theme' ), esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ), __( 'View Cart', 'starter-theme' ) );
	endif;
	return $message;
}
add_filter( 'wc_add_to_cart_message', 'starter_add_to_cart_message' );

/**
 * Adds classes to the checkout fields.
 *
 * @access   public
 * @since    1.0.0
 * @param array $args The arguments applied to the checkout.
 * @param array $key The checkout field key.
 * @param array $value The value of the checkout field.
 * @return 	 array
 */
function starter_checkout_fields_classes( $args, $key, $value ) {
	$args['class'][] = 'o-form__row o-form__row--checkout u-overflow u-clear';
	$args['label_class'] = 'o-form__label o-form__label--checkout u-block';
	$args['input_class'][] = 'o-form__input o-form__input--checkout u-block';

	return $args;
};
add_filter( 'woocommerce_form_field_args', 'starter_checkout_fields_classes', 10, 3 );

/**
 * The message to display an empty cart message.
 *
 * @access   public
 * @since    1.0.0
 */
function starter_empty_cart_message() {

	$message = 'Your basket is currently empty.';

	echo '<div class="o-notice o-notice--error">' . esc_html( $message ) . '</div>';

}
add_filter( 'wc_empty_cart_message', 'starter_empty_cart_message' );

/**
 * Removes the tabs from the product page.
 *
 * @access   public
 * @since    1.0.0
 * @param array $tabs The tabs added to the product page.
 * @return 	 array
 */
function starter_remove_product_tabs( $tabs ) {
	unset( $tabs['description'] );
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'starter_remove_product_tabs', 98 );

// Checkout order.
// Move payment to the bottom of the page.
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );

/**
 * Define a custom order failed page.
 *
 * @access   public
 * @since    1.0.0
 * @param array $order The failed order details.
 */
function starter_thankyou_failed( $order ) {
	wc_get_template( 'woocommerce/thankyou/failed.php', array(
		'order' => $order,
	) );
}
add_action( 'starter_thankyou_failed', 'starter_thankyou_failed', 10 );

/**
 * Define a custom header for order confirmation pages.
 *
 * @access   public
 * @since    1.0.0
 * @param array $order The failed order details.
 */
function starter_thankyou_header( $order ) {
	wc_get_template( 'woocommerce/thankyou/header.php', array(
		'order' => $order,
	) );
}
add_action( 'starter_thankyou_successful', 'starter_thankyou_header', 10 );

/**
 * The order details table.
 *
 * @access   public
 * @since    1.0.0
 * @param array $order The failed order details.
 */
function starter_thankyou_table( $order ) {
	wc_get_template( 'woocommerce/thankyou/table.php', array(
		'order' => $order,
	) );
}
add_action( 'starter_thankyou_successful', 'starter_thankyou_table', 20 );

/**
 * Customer details template for the thankyou page.
 *
 * @access   public
 * @since    1.0.0
 * @param array $order The failed order details.
 */
function starter_thankyou_customer_details( $order ) {
	wc_get_template( 'woocommerce/thankyou/customer-details.php', array(
		'order' => $order,
	) );
}
add_action( 'starter_thankyou_successful', 'starter_thankyou_customer_details', 30 );

/**
 * Display recent orders on the profile pages.
 *
 * @access   public
 * @since    1.0.0
 * @param array $count The number of recent orders to be displayed.
 */
function starter_get_recent_customer_orders( $count = 5 ) {

	// Get all customer orders.
	$customer_orders = get_posts( array(
		'numberposts' => esc_attr( $count ),
		'meta_key'    => '_customer_user',
		'meta_value'  => get_current_user_id(),
		'post_type'   => wc_get_order_types(),
		'post_status' => array_keys( wc_get_order_statuses() ),
		'suppress_filters' => false,
	) );

	if ( false === empty( $customer_orders ) ) {
		?>
			<h2>Recent Orders</h2>

			<table class="o-recentorders o-table">
				<tr>
					<th>Order Reference</th>
					<th>Order Date</th>
					<th>Total</th>
					<th></th>
				</tr>
		<?php

		foreach ( $customer_orders as $customer_order ) {
			$order = wc_get_order( $customer_order );
			?>
				<tr>
					<td><?php echo esc_html( $order->id );?></td>
					<td class="o-recentorders__date"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></td>
					<td class="o-recentorders__total"><?php echo esc_html( $order->get_formatted_order_total() );?></td>
					<td class="o-recentorders__edit"><a href="<?php echo esc_url( MY_ACCOUNT_PERMALINK ); ?>view-order/<?php echo esc_html( $order->id );?>">View Order</a></td>
				</tr>
			<?php
		}

		echo '</table>';
	} else {
		starter_display_notification( 'You have no recent orders. Place an order today.', 'notice' );
	}
}
