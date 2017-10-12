<section class="o-block o-block--portfolio">

	<h2><?php echo get_sub_field( 'title' );?></h2>

	<?php
		if( false === empty( get_sub_field( 'projects' ) ) ) 
		{
			$posts = get_sub_field('projects');

			if( $posts )
			{
				?>
					<ul class="o-portfolio u-overflow">
						<?php foreach( $posts as $p )
						{
							?>
								<li class="o-portfolio__item o-portfolio__item--block">
									<a class="o-portfolio__link" href="<?php echo get_permalink( $p->ID ); ?>">
										<?php echo get_the_post_thumbnail( $p->ID, 'portfolio_thumb', array( 'class' => 'o-portfolio__image' ) );?>
									</a>
								</li>
							<?php 
						} ?>
					</ul>
				<?php
			} 
		}
	?>

</section>