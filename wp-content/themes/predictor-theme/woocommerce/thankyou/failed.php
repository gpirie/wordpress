<p class="o-notice o-notice--error"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></p>

<p class="o-notice o-notice--notice"><?php
    if ( is_user_logged_in() )
        _e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
    else
        _e( 'Please attempt your purchase again.', 'woocommerce' );
?></p>

<p>
    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="o-button button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
    <?php if ( is_user_logged_in() ) : ?>
    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="o-button button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
    <?php endif; ?>
</p>
