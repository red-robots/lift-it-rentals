<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="full-content-area default-template clear">
		<main id="main" class="site-main wrapper" role="main">

		<?php
		while ( have_posts() ) : the_post();
			echo display_staff_details_html( get_the_ID() );
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
