<?php
/**
 * Template Name: Contact
 *
 */

get_header(); 
$banner = get_field('banner_image');
$has_banner = ($banner) ? 'has-banner':'no-banner';
?>

<div id="primary" class="full-content-area contactpage clear <?php echo $has_banner ?> clear ">
	<main id="main" class="site-main wrapper" role="main">
		<?php while ( have_posts() ) : the_post(); 
			$form = get_field('form'); 
			?>

			<?php if ($form) { ?>
			<div class="content-form white-box">
				<div class="inside clear">
					<h1 class="col-title"><?php the_title(); ?></h1>
					<?php echo $form ?>
						
				</div>
			</div>	
			<?php } ?>

			<div class="content-column">
				<div class="entry-content"><?php the_content(); ?></div>	
			</div>

		<?php endwhile; ?>
	</main><!-- #main -->
	<div class="greybg"><div></div></div>
</div><!-- #primary -->

<?php
get_footer();
