<?php
/**
 * The template for displaying a special page
 *
 * 
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen_child
 * Template Name:Special Page Template
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			echo ("<h2>Using My Special Template</h2>");
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );


				endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
</div><!-- .wrap -->

<?php get_footer();
