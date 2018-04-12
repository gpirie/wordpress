<?php defined( 'ABSPATH' ) or die();

	$latest_block_title 		= get_sub_field( 'latest_block_title' );
	$latest_block_post_count 	= get_sub_field( 'latest_block_post_count' );
	$latest_block_category 		= get_sub_field( 'latest_block_category' );
	$latest_block_layout 		= get_sub_field( 'latest_block_layout' );
	global $selkie_used_post_ids;

	if ( $latest_block_category ) {
		$latest_block_query = new WP_Query( array(
			'post__not_in' 		=> $selkie_used_post_ids,
			'cat'				=> $latest_block_category,
			'post_type' 		=> 'post',
			'posts_per_page' 	=> $latest_block_post_count
		) );
		update_post_thumbnail_cache( $latest_block_query );
		$latest_block_query_post_count = $latest_block_query->post_count;
	}

	if ( false === ( is_wp_error( $latest_block_query ) || empty( $latest_block_query ) ) ) {
		?>
		<section class="block block--posts latest latest--<?php esc_attr_e( $latest_block_layout ); ?>">
			<div class="container">
				<div class="row no-gutters">
					<div class="<?php if ( have_rows( 'block_sidebar_widgets' ) ) { echo 'col-md-10'; } else { echo 'col-md-10 col-md-offset-1'; }?>">
						<?php
							if ( $latest_block_title ) {
								echo '<h2 class="block__title block--latest__title block--latest--'. esc_attr( $latest_block_layout ) .'__title">' . esc_html( $latest_block_title ) . '</h2>';
							}
						?>
					</div>
					<div class="<?php if ( have_rows( 'block_sidebar_widgets' ) ) { echo 'post-container'; } else { echo 'col-md-10 col-md-offset-1'; }?>">
						<?php
							$i = 1;
							if ( $latest_block_query->have_posts() ) {
								while ( $latest_block_query->have_posts() ) {
									$latest_block_query->the_post();
									selkie_plus_post_used();
									if ( $latest_block_layout !== 'feature' && $latest_block_layout !== 'feature-tiled' && $latest_block_layout !== 'feature-list' ) {
										get_template_part( 'template-parts/template', $latest_block_layout );
									}
									else {
										if ( $i < 2 ) {
											echo '<div class="feature-post-container">';
											get_template_part( 'template-parts/template', 'feature' );
											echo '</div>';
										}
										if ( $i == 2 ) {
											echo '<div class="secondary-posts-container">';
										}
										if ( $latest_block_layout == 'feature') {
											if ( $i > 1 && $i < 5  ) {
												get_template_part( 'template-parts/template', 'tiled' );
											}
											if ( $i > 4 ) {
												if ( $i === 5 ) {
													echo '<div class="list-posts-container">';
												}
												get_template_part( 'template-parts/template', 'list' );
												if ( $i === $latest_block_query_post_count ) {
													echo '</div>';
												}
											}
										}
										if ( $latest_block_layout == 'feature-tiled') {
											if ( $i > 1 ) {
												get_template_part( 'template-parts/template', 'tiled' );
											}
										}
										if ( $latest_block_layout == 'feature-list') {
											if ( $i > 1 ) {
												if ( $i === 2 ) {
													echo '<div class="list-posts-container">';
												}
												get_template_part( 'template-parts/template', 'list' );
												if ( $i === $latest_block_query_post_count ) {
													echo '</div>';
												}
											}
										}
										if ( $i === $latest_block_query_post_count ) {
											echo '</div>';
										}
										$i++;
									}
								}
								wp_reset_postdata();
							}
						?>
					</div>
					<?php
						if ( have_rows('block_sidebar_widgets') ) {
							get_template_part( 'blocks/layouts/block', 'sidebar' );
						}
					?>
				</div>
			</div>
		</section>
	<?php
	}
