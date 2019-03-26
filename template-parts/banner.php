<?php
/* HOME BANNER */
if( is_front_page() || is_home() ) {
	$banner = get_field('banner_image');
	$tagline = get_field('banner_tagline');
	?>

	<?php if($banner) { ?>
	<div class="banner">
		<img src="<?php echo $banner['url']; ?>" alt="<?php echo $banner['title']; ?>" />
		<?php if ($tagline) { ?>
		<div class="caption text-center">
			<div class="tagline"><?php echo $tagline ?></div>
		</div>	
		<?php } ?>
	</div>
	<?php } ?>

<?php } ?>