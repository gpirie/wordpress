<?php
    defined( 'ABSPATH' ) or die();

    function predictions_form_posted_back( $form_nonce ) {
        $response = ( $form_nonce ) ? !empty($_POST[ esc_attr( $form_nonce ) ]) : '';

        return $response;
    }

    function predictor_display_notification($text, $type = 'error') {

        return sprintf('

            <div class="o-notice o-notice--%s">
                <p class="o-notice__message">%s</p>
            </div>

        ', $type, $text);
    }

    function predictions_form_display_errors($errors) {

        $html = '';

        if(!empty($errors)) {
            $html .= '<ul class="o-notice o-notice--error">';
            foreach ($errors as $key => $error_message) {
                $html .= sprintf('<li data-field="%s">%s</li>', $key, $error_message);
            }
            $html .= '</ul>';
        }

        return $html;
    }