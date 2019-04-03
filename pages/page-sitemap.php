<?php
/**
 * Template Name: Sitemap
 *
 */
get_header(); 
$banner = get_field('banner_image');
$has_banner = ($banner) ? 'has-banner':'no-banner';
?>
<div id="primary" class="full-content-area default-template clear <?php echo $has_banner ?>">
	<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<header class="entry-header"><h1 class="entry-title"><?php the_title(); ?></h1></header>
			<div class="entry-content"><?php the_content(); ?></div>
			<?php get_template_part( 'template-parts/content', 'sitemap' ); ?>
		<?php endwhile;  ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
