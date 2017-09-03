<section class="o-block o-block--featured">
	<?php
		if( false === empty( get_sub_field( 'post' ) ) ) 
		{
			$posts = get_sub_field('post');

			if( $posts )
			{
				?>
					<ul class="o-featuredposts">
						<?php foreach( $posts as $p )
						{
							?>
								<li class-"o-featuredposts__post">
									<?php echo get_the_post_thumbnail( $p->ID, 'small', array( 'class' => 'o-featuredposts__image' ) );?>
									<a class="o-featuredposts__link" href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
								</li>
							<?php 
						} ?>
					</ul>
				<?php
			} 
		}
	?>

</section>