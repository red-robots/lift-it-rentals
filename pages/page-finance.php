<?php
/**
 * Template Name: Financing Solutions
 *
 */

get_header(); ?>
<div id="primary" class="full-content-area clear">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php  
			$callouts[] = array(
							'title' => get_field('call-out_box_1_title'),
							'text' => get_field('call-out_box_1_text'),
							'link' => get_field('call_out_box_1_link')
						);
			$callouts[] = array(
							'title' => get_field('call-out_box_2_title'),
							'text' => get_field('call-out_box_2_text'),
							'link' => get_field('call-out_box_2_link')
						);
		?>

		<section class="grey-section clear">
			<div class="content-wrapper wrapper clear">
				<div class="white-box col-left">
					<div class="inside clear">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="col-right">
					<div class="inside clear">
						<?php $i=1; foreach ($callouts as $c) { 
						$c_title = $c['title'];
						$c_text = $c['text'];
						$c_link = ($c['link']) ? $c['link'] : '#';
							if( $c_title && $c_text ) { ?>
								<div id="callout-<?php echo $i?>" class="call-out animated fadeIn wow">
									<div class="icon icon<?php echo $i;?>"></div>
									<?php if($i==1) { ?><div class="calloutwrap"><?php } ?>
									<h3 class="title"><a href="<?php echo $c_link ?>"><?php echo $c_title ?></a></h3>
									<div class="text"><?php echo $c_text ?></div>
									<?php if($i==1) { ?>
										</div>
										<div class="calloutbtn">
											<a href="<?php echo $c_link ?>">Contact</a>
										</div>
									<?php } ?>
								</div>	
							<?php $i++; } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

		<?php  
		$services = get_field('service_detail');
		if ($services) { ?>
		<section class="services-info-section clear">
			<div class="content-inner clear">
				<?php $j=1; foreach ($services as $sv) { 
					$s_title = $sv['title'];
					$s_desc = $sv['description'];
					$s_image = $sv['image'];
					$s_button_name = $sv['button_name'];
					$s_button_link = $sv['button_link'];
					if($s_title && $s_desc) { 
						$first_box = ($j==1) ? ' first':''; ?>

						<div class="svcbox clear <?php echo ($j % 2) ? 'odd':'even';?> animated slideInUp wow<?php echo $first_box;?>">
							<div class="flexrow clear">
								<?php if ($s_image) { ?>
								<div class="imagecol">
									<img src="<?php echo $s_image['sizes']['medium_large'] ?>" alt="<?php echo $s_image['title'] ?>" />
								</div>	
								<?php } ?>
								<div class="contentcol <?php echo ($s_image) ? 'half':'wrapper';?>">
									<div class="inside clear">
										<h3 class="title"><?php echo $s_title; ?></h3>
										<?php echo $s_desc; ?>
										<?php if ($s_button_name && $s_button_link) { ?>
											<div class="buttondiv"><a class="btn-style green" href="<?php echo $s_button_link; ?>"><?php echo $s_button_name; ?></a></div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>	


					<?php $j++; } ?>
				<?php } ?>
			</div>
		</section>
		<?php } ?>

		<?php 
		$b_left_column_title = get_field('left_column_title'); 
		$b_left_column_text = get_field('left_column_text'); 
		$left_column_btn_name = get_field('left_column_btn_name'); 
		$left_column_btn_link = get_field('left_column_btn_link'); 
		$b_image_div = get_field('bottom_image_bg'); 
		$icons_list_title = get_field('icons_list_title'); 
		$icons_list = get_field('icons_list'); 
		$pImg = ($b_image_div) ? ' style="background-image:url('.$b_image_div['url'].')"':'';
		?>

		<?php if ( $b_left_column_title || $b_left_column_text || $icons_list ) { ?>
		<section class="section-performance clear">
			<div class="inner clear"<?php echo $pImg; ?>>
				<div class="overlay"></div>
				<div class="wrapper clear">
					<div class="column left animated slideInLeft wow">
						<h2 class="sub-title"><?php echo $b_left_column_title; ?></h2>
						<div class="textwrap">
							<?php echo $b_left_column_text; ?>
							<?php if ($left_column_btn_name && $left_column_btn_link) { ?>
							<div class="buttondiv"><a class="btn-style green" href="<?php echo $left_column_btn_link ?>"><?php echo $left_column_btn_name ?></a></div>			
							<?php } ?>		
						</div>
					</div>
					<div class="column right animated slideInRight wow">
						<div class="inside clear">
							<div class="desc"><?php echo $icons_list_title ?></div>
							<?php if ($icons_list) { ?>
							<div class="lists">
								<div class="items-wrap">
									<?php foreach ($icons_list as $p){ 
										$icon = $p['icon'];
										$name = $p['title']; ?>
										<div class="item">
											<?php if ($icon) { ?>
											<img class="icon" src="<?php echo $icon['url'] ?>" alt="" />	
											<?php } ?>

											<?php if ($name) { ?>
											<div class="name"><?php echo $name ?></div>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
							</div>	
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php } ?>

	<?php endwhile; ?>
</div><!-- #primary -->
<?php
get_footer();
