<div class="c-ordercomplete">

    <p class="o-notice o-notice--success"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'starter-theme' ), $order ); ?></p>

    <table class="c-orderdetails">
        <tr>
            <th>Order Number:</th>
            <td><?php echo $order->get_order_number(); ?></td>
        </tr>
        <tr>
            <th>Order Date:</th>
            <td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
        </tr>
        <tr>
            <th>Total:</th>
            <td><?php echo $order->get_formatted_order_total(); ?></td>
        </tr>
        <tr>
            <th>Payment Method:</th>
            <td><?php echo $order->payment_method_title; ?></td>
        </tr>
    </table>
