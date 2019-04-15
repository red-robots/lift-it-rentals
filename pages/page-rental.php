<?php
/**
 * Template Name: Rental Solutions
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
		?>
		<section class="services-info-section clear">
			<div class="content-inner clear">
				<?php if ($services) { ?>
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
				<?php } ?>


				<?php  
				/* Circular Graphic Section */
				$bottom_section_title = get_field('bottom_section_title');
				$bottom_section_text = get_field('bottom_section_text');
				$bottom_button_name = get_field('bottom_button_name');
				$bottom_button_link = get_field('bottom_button_link');
				$services_graphic = get_field('services_graphic');
				$map_image_url = get_bloginfo('template_url').'/images/graph1.png';
				$alphabets = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
				?>

				<?php if ( $bottom_section_title ||  $bottom_section_text || $services_graphic ) { ?>
					<div class="svcbox clear has-image-map">
						<div class="wrapper clear">

							<div class="flexrow clear">
								<div class="contentcol <?php echo ($s_image) ? 'half':'wrapper';?>">
									<div class="inside clear animated slideInLeft wow">
										<?php if ( $bottom_section_title ||  $bottom_section_text ) { ?>
											<h3 class="title"><?php echo $bottom_section_title; ?></h3>
											<?php echo $bottom_section_text; ?>
										<?php } ?>
										<?php if ($bottom_button_name && $bottom_button_link) { ?>
											<div class="buttondiv"><a class="btn-style green" href="<?php echo $bottom_button_link; ?>"><?php echo $bottom_button_name; ?></a></div>
										<?php } ?>
									</div>
								</div>

								<?php if ($services_graphic) { ?>
									<div class="imagecol animated slideInRight wow">
										<div id="image_map" class="imagemapdiv">
											<div id="canvasdiv" class="canvas" style="background-image:url('<?php echo $map_image_url; ?>');"></div>
											<img id="main_image" class="canvas-image" data-orig="<?php echo $map_image_url; ?>" src="<?php echo $map_image_url; ?>" id="map-image" alt="" usemap="#map" />
											<map id="svc_map" name="map">
											    <area id="step1" data-tooltip-content="#tooltip_content1" shape="poly" coords="400, 240, 462, 127, 402, 11, 450, 16, 493, 25, 549, 44, 596, 66, 638, 95, 673, 128, 707, 170, 735, 209, 757, 251, 772, 295, 781, 336, 786, 370, 788, 402, 674, 462, 558, 401, 558, 380, 555, 358, 546, 332, 532, 307, 513, 286, 494, 270, 468, 255, 440, 246, 419, 243" href="#" target="_self" title="Step 1" />
											    <area id="step2" data-tooltip-content="#tooltip_content2" shape="poly" coords="561, 400, 558, 437, 550, 465, 535, 489, 520, 509, 499, 527, 473, 543, 446, 555, 419, 560, 404, 561, 341, 675, 402, 792, 444, 786, 494, 778, 538, 765, 592, 739, 633, 711, 689, 659, 721, 617, 743, 581, 763, 538, 778, 490, 785, 447, 789, 408, 788, 397, 675, 461" href="#" target="_self" title="Step 2" />
											    <area id="step3" data-tooltip-content="#tooltip_content3" shape="poly" coords="339, 675, 404, 560, 373, 560, 345, 554, 317, 540, 290, 521, 271, 497, 256, 473, 246, 450, 242, 429, 238, 407, 124, 344, 8, 404, 15, 456, 27, 507, 47, 564, 80, 619, 112, 660, 152, 697, 197, 729, 247, 755, 310, 777, 359, 785, 401, 789" href="#" target="_self" title="Step 3" />
											    <area id="step4" data-tooltip-content="#tooltip_content4" shape="poly" coords="9, 401, 16, 341, 27, 294, 48, 233, 85, 174, 135, 116, 184, 77, 243, 46, 299, 27, 353, 15, 403, 12, 462, 126, 398, 239, 366, 242, 341, 251, 318, 262, 295, 278, 277, 296, 262, 316, 250, 340, 241, 362, 237, 403, 125, 342" href="#" target="_self" title="Step 4" />
											</map>
											<?php $s=1; foreach ($services_graphic as $g) { 
												$descs = $g['description']; 
												?>
												<div class="image-hover" id="img_step<?php echo $s;?>" data-image="<?php echo get_bloginfo('template_url'); ?>/images/step<?php echo $s;?>-hover.png"></div>
												<span data-tooltip-content="#tooltip_content<?php echo $s;?>" data-step="step<?php echo $s;?>" class="tooltip graphic-info info_step<?php echo $s;?> graphic<?php echo $s;?>">
													<span class="num"><?php echo $s; ?></span>
													<span class="name"><?php echo $g['title']; ?></span>
													<span id="tooltip_content<?php echo $s;?>" class="description">
														<div class="tp_title"><?php echo $g['title'] ?></div>
														<div class="tp_desc">
															<?php if ($descs) { ?>
																<ul class="tp-bullet-items">
																<?php $x=0; foreach ($descs as $d) { ?>
																	<li><span class="alpha"><?php echo $alphabets[$x]; ?>)</span> <?php echo $d['bullet_item']; ?></li>
																<?php $x++; } ?>	
																</ul>
															<?php } ?>
														</div>
													</span>
												</span>
											<?php $s++; } ?>
											<div class="graphimg" style="background-image:url('<?php echo $map_image_url; ?>');"></div>
										</div>
									</div>	
								<?php } ?>
							</div>

						</div>
					</div>	
				<?php } ?>

			</div>
		</section>

	<?php endwhile; ?>
</div><!-- #primary -->
<?php
get_footer();
