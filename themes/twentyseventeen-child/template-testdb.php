
<?php
/**
 * The template for testing database access.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */


get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );
				
				
				global $wpdb;
				$users = $wpdb->get_results("Select * from $wpdb->users;");
				
				echo "<table>";
foreach($users as $user){
echo "<tr>
<td>Nice Name</td><td> $user->user_nicename </td>
<td>E-mail</td><td> $user->user_email </td>
</tr>";
}
echo "</table>";
				
				
				
				


			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
