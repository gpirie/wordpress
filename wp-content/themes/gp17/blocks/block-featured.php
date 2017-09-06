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
								<li class="o-featuredposts__post u-overflow" itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
									
									<?php echo get_the_post_thumbnail( $p->ID, 'small', array( 'class' => 'o-featuredposts__image', 'itemprop' => 'image' ) );?>
									
									<div class="o-featuredposts__content">

										<h2 itemprop="title">
											<a class="o-featuredposts__link" href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
										</h2>

										<div itemprop="text articleBody">
											<?php the_excerpt( $p->ID );?>
										</div>

									</div>

									<a class="button" href="<?php echo get_permalink( $p->ID );?>">Continue&hellip;</a>
								</li>
							<?php 
						} ?>
					</ul>
				<?php
			} 
		}
	?>

</section>