<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
$banner = get_field('banner_image');
$has_banner = ($banner) ? 'has-banner':'no-banner';
?>

	<div id="primary" class="full-content-area default-template clear <?php echo $has_banner ?>">
		<main id="main" class="site-main wrapper" role="main">

			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
