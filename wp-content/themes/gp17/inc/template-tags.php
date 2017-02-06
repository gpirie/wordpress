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

			echo '<li>';
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

			echo '<ul class="o-snippet">';

			while ( $query->have_posts() ) : $query->the_post();

			echo '<li>';
			the_title( '<h1 itemprop="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			
			gpwd_get_the_category();
			
			the_excerpt();
			echo '</li>';

			endwhile;

			echo '</ul>';

			echo '</section>';

		endif;
	}