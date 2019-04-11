<?php
/* HOME BANNER */
$banner = get_field('banner_image');
$banner_caption = get_field('banner_caption');
$alignment_option = get_field('caption_alignment');
$alignment = ($alignment_option) ? $alignment_option : 'center';
$is_autoheight = ($banner_caption) ? '' : ' autoheight';

if( is_front_page() || is_home() ) {
	$tagline = get_field('banner_tagline'); ?>
	<?php if($banner) { ?>
	<div class="banner clear">
		<img src="<?php echo $banner['url']; ?>" alt="<?php echo $banner['title']; ?>" />
		<?php if ($tagline) { ?>
		<div class="caption text-center">
			<div class="tagline">
				<?php echo $tagline ?>
				<div class="contact-cta">
					<a href="<?php bloginfo('url'); ?>/contact">
						<button class="green">Start Now</button>
					</a>
				</div>
			</div>
		</div>	

		<?php } ?>
	</div>
	<?php } ?>
<?php } else { ?>

	<?php if($banner) { ?>
		<div class="subpage-banner clear<?php echo $is_autoheight;?>">
			<img src="<?php echo $banner['url']; ?>" alt="<?php echo $banner['title']; ?>" />
			<div class="banner-image" style="background-image:url('<?php echo $banner['url']; ?>');"></div>
			<?php if ($banner_caption) { ?>
			<div class="caption <?php echo $alignment; ?>">
				<div class="inside">
					<span class="highlight highlight--wrapping"><?php echo $banner_caption ?></span>
				</div>
			</div>		
			<?php } ?>
		</div>
	<?php } ?>

<?php } ?>