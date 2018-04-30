<p class="o-notice o-notice--error"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'starter-theme' ); ?></p>

<p class="o-notice o-notice--notice"><?php
    if ( is_user_logged_in() )
        _e( 'Please attempt your purchase again or go to your account page.', 'starter-theme' );
    else
        _e( 'Please attempt your purchase again.', 'starter-theme' );
?></p>

<p>
    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="o-button button pay"><?php _e( 'Pay', 'starter-theme' ) ?></a>
    <?php if ( is_user_logged_in() ) : ?>
    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="o-button button pay"><?php _e( 'My Account', 'starter-theme' ); ?></a>
    <?php endif; ?>
</p>
