<?php
	/**
	 * The main template file.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package Predictor Theme
	 *
	 * Template Name: Leagues
	 *
	 */

	get_header();

	echo '<main class="o-maincontent u-clear" itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'page' );

		?>
			<div class="o-tabs o-tabs--leagues">

				<ul class="o-tabs__nav u-overflow">
					<li class="o-tabs__navitem o-tabs__navitem--visible"><a class="o-tabs__link" href="#createleague">Create League</a></li>
					<li class="o-tabs__navitem"><a class="o-tabs__link" href="#joinleague">Join a League</a></li>
				</ul>

				<div id="createleague" class="o-tabs__tab o-tabs--leagues__tab is-visible">
					<?php echo do_shortcode('[create_league]');?>
				</div>

				<div id="joinleague" class="o-tabs__tab o-tabs--leagues__tab">
					<?php echo do_shortcode('[join_league]');?>
				</div>
			</div>
		<?php

	endwhile;

	echo '</main>';

	get_sidebar();

	get_footer();
