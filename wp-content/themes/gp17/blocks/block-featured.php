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

										<h2 class="o-featuredposts__title" itemprop="title">
											<a class="o-featuredposts__link" href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
										</h2>

										<div class="o-featuredposts__excerpt" itemprop="text articleBody">
											<?php echo $p->post_excerpt;?>
										</div>

										<a class="o-button" href="<?php echo get_permalink( $p->ID );?>">Continue&hellip;</a>

									</div>

								</li>
							<?php 
						} ?>
					</ul>
				<?php
			} 
		}
	?>

</section>