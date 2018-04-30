<div class="c-customerdetails c-ordercomplete__customerdetails">

    <div class="c-customercontact c-ordercomplete__customercontact">

        <header>
            <h2><?php _e( 'Customer details', 'starter-theme' ); ?></h2>
        </header>

        <dl class="customer_details">
            <?php
            if ( $order->billing_email ) echo '<dt>' . __( 'Email:', 'starter-theme' ) . '</dt><dd>' . $order->billing_email . '</dd>';
            if ( $order->billing_phone ) echo '<dt>' . __( 'Telephone:', 'starter-theme' ) . '</dt><dd>' . $order->billing_phone . '</dd>';

            // Additional customer details hook
            do_action( 'woocommerce_order_details_after_customer_details', $order );
            ?>
        </dl>
    </div>

    <?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

        <div class="c-customerdetails__address c-customerdetails__address--billing">

            <header>
                <h3><?php _e( 'Billing Address', 'starter-theme' ); ?></h3>
            </header>

            <address>
                <?php
                if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'starter-theme' ); else echo $order->get_formatted_billing_address();
                ?>
            </address>

        </div>

        <div class="c-customerdetails__address c-customerdetails__address--shipping">

            <header>
                <h3><?php _e( 'Shipping Address', 'starter-theme' ); ?></h3>
            </header>

            <address>
                <?php
                    if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'starter-theme' ); else echo $order->get_formatted_shipping_address();
                ?>
            </address>

        </div>

    <?php endif; ?>

</div>
