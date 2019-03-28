<?php
/**
 * Template Name: About
 *
 */

get_header(); ?>
<div id="primary" class="full-content-area default-template clear">
	<main id="main" class="site-main wrapper clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
