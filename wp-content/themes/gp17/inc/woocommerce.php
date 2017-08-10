<?php

	/* Woocommerce Globals*/
	define( 'ADD_TO_CART_TEXT', 'Add to Basket' );

	add_filter( 'woocommerce_product_single_add_to_cart_text', 'starter_single_add_to_cart_text' );
	function starter_single_add_to_cart_text() {
	        return __( ADD_TO_CART_TEXT, 'starter-theme' );
	}

	add_filter( 'woocommerce_product_add_to_cart_text', 'starter_archive_add_to_cart_text' );
	function starter_archive_add_to_cart_text() {
	    return __( ADD_TO_CART_TEXT, 'starter-theme' );
	}

	//Breadcrumbs
	add_filter( 'woocommerce_breadcrumb_defaults', 'starter_woocommerce_breadcrumbs' );
	function starter_woocommerce_breadcrumbs() {
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
	function your_add_to_cart_message() {
	if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :
	    $message = sprintf( '%s<a href="%s" class="your-style">%s</a>', __( 'Successfully added to cart.', 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ), __( 'Continue Shopping', 'woocommerce' ) );
	else :
	    $message = sprintf( '%s<a href="%s" class="your-class">%s</a>', __( 'Successfully added to cart.' , 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ), __( 'View Cart', 'woocommerce' ) );
	endif;
	return $message;
	}
	add_filter( 'wc_add_to_cart_message', 'your_add_to_cart_message' );