<section class="o-block o-block--portfolio">

	<h1><?php echo get_sub_field( 'title' );?></h1>

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
								<li class="o-portfolio__post">
									<?php echo get_the_post_thumbnail( $p->ID, 'large', array( 'class' => 'o-portfolio__image' ) );?>
									<a class="o-portfolio__link" href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
								</li>
							<?php 
						} ?>
					</ul>
				<?php
			} 
		}
	?>

</section>