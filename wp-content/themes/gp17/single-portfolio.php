<?php
	get_header(); 

    echo '<main itemprop="mainContentOfPage">';

    while ( have_posts() ) : the_post(); 
    	?>
		<article <?php post_class( 'u-overflow' ); ?> itemscope itemtype="http://schema.org/WebPage">

			<header class="o-page__header u-overflow u-relative">

				<?php the_title( '<h1 itemprop="title" class="o-post__title">', '</h1>' ); ?>

			</header>

			<?php gpwd_post_thumbnail();?>

			<div class="o-portfolio__brief" itemprop="text articleBody">

				<h2>Project Brief</h2>

				<?php echo gpwd_get_acf_field( 'project_brief' );?>

			</div>

			<div class="o-portfolio__learning" itemprop="text articleBody">

				<h2>What I Learned</h2>

				<?php echo gpwd_get_acf_field( 'learning' );?>

			</div>

			<ul class="o-portfolio__details">
				<li><a href="<?php echo esc_url( gpwd_get_acf_field( 'project_link' ) );?>">View Project</a></li>
				<li><?php echo gpwd_get_acf_field( 'project_type' );?></li>
				<li>
					<?php
						if( have_rows( 'my_role' ) ) :

							while ( have_rows('my_role') ) : the_row(); 
								echo gpwd_get_acf_sub_field( 'project_task' );
							endwhile;

						endif;
					?>
				</li>
			</ul>
			
		</article>
		<?php
	endwhile;

    wp_link_pages();

    echo '</main>';

    get_sidebar('site-sidebar');

    get_footer();