<?php
/* HOME BANNER */
$banner = get_field('banner_image');
$banner_caption = get_field('banner_caption');
$is_autoheight = ($banner_caption) ? '' : ' autoheight';

if( is_front_page() || is_home() ) {
	$tagline = get_field('banner_tagline'); ?>
	<?php if($banner) { ?>
	<div class="banner clear">
		<img src="<?php echo $banner['url']; ?>" alt="<?php echo $banner['title']; ?>" />
		<?php if ($tagline) { ?>
		<div class="caption text-center">
			<div class="tagline"><?php echo $tagline ?></div>
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
		<div class="caption"><div class="inside"><?php echo $banner_caption ?></div></div>		
		<?php } ?>
	</div>
	<?php } ?>

<?php } ?>