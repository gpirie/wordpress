<?php
	function gpwd_excerpt_length($excerpt) {
	    return substr($excerpt,0,strpos($excerpt,'.')+1);
	}
	add_filter( 'the_excerpt', 'gpwd_excerpt_length', 999 );

	function gpwd_get_the_category() {
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
		    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
			echo ' / ';
			echo get_the_date();
		}
	}

	function gpwd_menu_class($classes, $item, $args) {

		/* Add generic class to all menu-items across the site*/
		$classes[] = 'c-menuitem c-menuitem--'. $args->theme_location;

		/* Add class to top-level items*/
		if ( $item->menu_item_parent == 0 ) 
		{
			$classes[] = 'c-menuitem--'. $args->theme_location . '__item--parent';	
		}
		/* Add class to child-items*/
		else
		{
			$classes[] = 'c-menuitem--'. $args->theme_location . '__item--child';	
		}
    	return $classes;
	}
	add_filter('nav_menu_css_class' , 'gpwd_menu_class' , 10 , 3);

	/* Add class to menu links*/
	function gpwd_add_menuclass($ulclass, $args) {
		return preg_replace('/<a /', '<a class="c-'. $args->theme_location .'__link"', $ulclass);
	}
	add_filter('wp_nav_menu','gpwd_add_menuclass', 10, 3);


	function gpwd_get_latest_posts() {
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 2
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : 

			echo '<section class="c-latestposts">';

			echo '<h1 class="section-title">Latest Posts</h1>';

			echo '<ul class="o-latest">';

			while ( $query->have_posts() ) : $query->the_post();

			echo '<li class="o-latest__item">';
			the_title( '<h1 itemprop="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			
			gpwd_get_the_category();
			
			the_excerpt();
			echo '</li>';

			endwhile;

			echo '</ul>';

			echo '</section>';

		endif;
	}

	function gpwd_get_latest_snippets() {
		$args = array(
			'post_type' => 'snippets',
			'posts_per_page' => 3
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : 

			echo '<section class="c-latestsnippets">';

			echo '<h1 class="section-title">Latest Code</h1>';

			echo '<ul class="o-snippet o-latest">';

			while ( $query->have_posts() ) : $query->the_post();

			echo '<li class="o-snippet__item  o-latest__item">';

			the_title( '<h1 itemprop="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			
			gpwd_get_the_category();
			
			the_excerpt();
			
			echo '</li>';

			endwhile;

			echo '</ul>';

			echo '</section>';

		endif;
	}