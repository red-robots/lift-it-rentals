<?php
/**
 * The template for home page.
 */

get_header(); ?>

<div id="primary" class="full-content-area clear">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php  
			$what_we_do_title = get_field('what_we_do_title');
			$what_we_do_description = get_field('what_we_do_description');
		?>
		
		<?php if ($what_we_do_title || $what_we_do_description) { ?>
		<section class="section-wwd wrapper clear">
			<div class="med-wrapper">
				<?php if ($what_we_do_title) { ?>
					<h2 class="section-title"><?php echo $what_we_do_title; ?></h2>
				<?php } ?>
				<?php if ($what_we_do_description) { ?>
					<div class="section-content"><?php echo $what_we_do_description; ?></div>
				<?php } ?>
			</div>
		</section>
		<?php } ?>


		<?php 
			$services[] = array(
						'title' => get_field('rental_title'),
						'description' => get_field('rental_short_description'),
						'url' => get_field('rental_page_link'),
						'icon'	=> get_field('rental_icon')
					);
			$services[] = array(
						'title' => get_field('financing_title'),
						'description' => get_field('financing_short_description'),
						'url' => get_field('financing_page_link'),
						'icon'	=> get_field('financing_icon')
					);
			$services[] = array(
						'title' => get_field('management_title'),
						'description' => get_field('management_short_description'),
						'url' => get_field('management_page_link'),
						'icon'	=> get_field('management_icon')
					);
		?>
		<section class="services-section clear">
			<div class="wrapper">
				<div class="row clear">
					<?php foreach ($services as $sv) { 
						$s_title = $sv['title'];
						$s_description = $sv['description'];
						$s_url = ($sv['url']) ? $sv['url'] : '#';
						$s_icon = $sv['icon'];
						?>
						<?php if ($s_title) { ?>
							<a href="<?php echo $s_url; ?>" class="item text-center">
								<?php if ($s_icon) { ?>
								<span class="icon"><img src="<?php echo $s_icon['url'] ?>" alt="<?php echo $s_icon['title'] ?>" /></span>	
								<?php } ?>
								<span class="title"><?php echo $s_title; ?></span>
								<span class="description"><?php echo $s_description; ?></span>
							</a>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</section>

	<?php endwhile; ?>
</div><!-- #primary -->

<?php
get_footer();
