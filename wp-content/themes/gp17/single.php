<?php 

    get_header(); 

    echo '<main role="main" itemprop="mainContentOfPage">';

    while ( have_posts() ) : the_post(); 

        if ( has_post_format( 'gallery' ) ) :

            get_template_part( 'template-parts/content', 'gallery' );

        elseif ( has_post_format( 'video' ) ) :

            get_template_part( 'template-parts/content', 'video' );

        else : 

            get_template_part( 'template-parts/content', 'single' );

        endif;

    endwhile;

    echo '</main>';

    get_sidebar('site-sidebar');

    get_footer(); 


?>