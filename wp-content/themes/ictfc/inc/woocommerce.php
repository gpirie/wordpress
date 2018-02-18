<?php
	defined( 'ABSPATH' ) or die( 'Nice try' );

	/* Woocommerce Globals*/
	define( 'ADD_TO_CART_TEXT', 'Add to Basket' );
	define( 'MY_ACCOUNT_PERMALINK', ( get_option('woocommerce_myaccount_page_id') ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : '' );

	add_filter( 'woocommerce_product_single_add_to_cart_text', 'ict_single_add_to_cart_text' );
	function ict_single_add_to_cart_text() {
	        return __( ADD_TO_CART_TEXT, 'ictfc-theme' );
	}

	add_filter( 'woocommerce_product_add_to_cart_text', 'ict_archive_add_to_cart_text' );
	function ict_archive_add_to_cart_text() {
	    return __( ADD_TO_CART_TEXT, 'ictfc-theme' );
	}

	//Breadcrumbs
	add_filter( 'woocommerce_breadcrumb_defaults', 'ict_woocommerce_breadcrumbs' );
	function ict_woocommerce_breadcrumbs() {
	    return array(
            'delimiter'   => '',
            'wrap_before' => '<nav class="o-breadcrumb u-overflow u-hidden@print" itemprop="breadcrumb"><ul>',
            'wrap_after'  => '</ul></nav>',
            'before'      => '<li class="o-breadcrumb__crumb">',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
	}

	//Add to Cart
	function ict_add_to_cart_message() {
	if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :
	    $message = sprintf( '%s<a href="%s" class="your-style">%s</a>', __( 'Successfully added to cart.', 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ), __( 'Continue Shopping', 'woocommerce' ) );
	else :
	    $message = sprintf( '%s<a href="%s" class="your-class">%s</a>', __( 'Successfully added to cart.' , 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ), __( 'View Cart', 'woocommerce' ) );
	endif;
	return $message;
	}
	add_filter( 'wc_add_to_cart_message', 'ict_add_to_cart_message' );

	//Checkout Fields
	function ict_checkout_fields_classes( $args, $key, $value ) { 
		$args['class'][] = 'o-form__row o-form__row--checkout u-overflow u-clear';
		$args['label_class'] = 'o-form__label o-form__label--checkout u-block';
	    $args['input_class'][] = 'o-form__input o-form__input--checkout u-block';

	    return $args;
	};
	add_filter( 'woocommerce_form_field_args', 'ict_checkout_fields_classes', 10, 3 );
	
	function ict_empty_cart_message() {

		$message = 'Your basket is currently empty.';

		echo '<div class="o-notice o-notice--error">'. $message .'</div>';

	}
	add_filter( 'wc_empty_cart_message', 'ict_empty_cart_message' );

	//remove product tabs but keep description
	function ict_remove_product_tabs( $tabs ) {
		unset( $tabs['description'] );
		unset( $tabs['reviews'] );
		unset( $tabs['additional_information'] );
		return $tabs;
	}
	add_filter( 'woocommerce_product_tabs', 'ict_remove_product_tabs', 98 );

	//Checkout order
	//Move payment to the bottom of the page.
	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
	add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );

	//Checkout custom thank you page.
	function wc_custom_redirect_after_purchase() {
	    global $wp;

	    if ( is_checkout() && ! empty( $wp->query_vars['order-received'] ) ) {
	        $order_id  = absint( $wp->query_vars['order-received'] );
	        $order_key = wc_clean( $_GET['key'] );

	        $redirect  = get_permalink( 1736 );
	        $redirect .= get_option( 'permalink_structure' ) === '' ? '&' : '?';
	        $redirect .= 'order=' . $order_id . '&key=' . $order_key;

	        wp_redirect( $redirect );
	        exit;
	    }
	}
	add_action( 'template_redirect', 'wc_custom_redirect_after_purchase' );

	function ict_thankyou( $content ) {
	    
	    if ( ! is_page( 1736 ) ) {
	        return $content;
	    }

	    // check if the order ID exists
	    if ( ! isset( $_GET['key'] ) || ! isset( $_GET['order'] ) ) {
	        return $content;
	    }

	    $order_id  = apply_filters( 'woocommerce_thankyou_order_id', absint( $_GET['order'] ) );
	    $order_key = apply_filters( 'woocommerce_thankyou_order_key', empty( $_GET['key'] ) ? '' : wc_clean( $_GET['key'] ) );
	    $order     = wc_get_order( $order_id );


	    if ( $order->id != $order_id || $order->order_key != $order_key ) {
	        return $content;
	    }

	    ob_start();

	    // Check that the order is valid
	    if ( ! $order ) {
	        // The order can't be returned by WooCommerce - Just say thank you
	        ?><p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p><?php
	    } else {
	        if ( $order->has_status( 'failed' ) ) 
	        {
	            do_action( 'ict_thankyou_failed', $order );
	        } 
	        else 
	        {	           
	           do_action( 'ict_thankyou_successful', $order );
	        }
	    }

	    $content .= ob_get_contents();
	    ob_end_clean();

	    return $content;
	}
	add_filter( 'the_content', 'ict_thankyou' );
	
	function ict_thankyou_failed( $order ) {
	    wc_get_template( 'woocommerce/thankyou/failed.php', array( 'order' => $order ) );
	}
	add_action( 'ict_thankyou_failed', 'ict_thankyou_failed', 10 );
	
	function ict_thankyou_header( $order ) {
	    wc_get_template( 'woocommerce/thankyou/header.php', array( 'order' => $order ) );
	}
	add_action( 'ict_thankyou_successful', 'ict_thankyou_header', 10 );
	
	function ict_thankyou_table( $order ) {
	    wc_get_template( 'woocommerce/thankyou/table.php', array( 'order' => $order ) );
	}
	add_action( 'ict_thankyou_successful', 'ict_thankyou_table', 20 );
	
	function ict_thankyou_customer_details( $order ) {
	    wc_get_template( 'woocommerce/thankyou/customer-details.php', array( 'order' => $order ) );
	}
	add_action( 'ict_thankyou_successful', 'ict_thankyou_customer_details', 30 );	

	function ict_get_recent_customer_orders( $count = 5 ) {
	    
	    // Get all customer orders
	    $customer_orders = get_posts( array(
	        'numberposts' => esc_attr( $count ),
	        'meta_key'    => '_customer_user',
	        'meta_value'  => get_current_user_id(),
	        'post_type'   => wc_get_order_types(),
	        'post_status' => array_keys( wc_get_order_statuses() ),
	        'suppress_filters' => false,
	    ) );

	    if( false === empty( $customer_orders ) ) 
	    {
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
		        		<td><?php echo $order->id;?></td>
		        		<td class="o-recentorders__date"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></td>
		        		<td class="o-recentorders__total"><?php echo $order->get_formatted_order_total();?></td>
		        		<td class="o-recentorders__edit"><a href="<?php echo esc_url( MY_ACCOUNT_PERMALINK ); ?>view-order/<?php echo $order->id;?>">View Order</a></td>
		        	</tr>
		        <?php
		    }

	    	echo '</table>';
		}
		else
		{
			ict_display_notification( 'You have no recent orders. Place an order today.', 'notice' );
		}
	}