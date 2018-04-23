<form role="search" method="get" class="o-form o-form--searchform js-searchtoggle" action="<?php echo home_url( '/' ); ?>">
    <label class="u-visuallyhidden"><?php echo _x( 'Search for:', 'label' ) ?></label>
    <input type="search" class="o-form__field o-form--searchform__field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    
    <input type="submit" class="o-form__field o-form--searchform__button button" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>