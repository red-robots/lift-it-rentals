<?php
/**
 * Template Name: About
 *
 */

get_header(); ?>
<div id="primary" class="full-content-area clear">
	<?php while ( have_posts() ) : the_post(); ?>
		
		<?php  
			$about_text = get_field('who_we_are_description');
		?>
		<section class="about-content clear">
			<div class="wrapper clear content-inner">
				<div class="flex-row clear">
					<div class="content-left white-box column">
						<div class="inside clear">
							<h1 class="col-title"><?php the_title(); ?></h1>
							<div class="entry-content"><?php echo $about_text; ?></div>
						</div>
					</div>


					<?php
						$model_title = get_field('model_title');
						$model_lists = get_field('model_list');
					?>

					<div class="content-right column">

						<div class="contentdiv clear">
							<?php if ($model_title) { ?>
							<div class="titlediv"><span><?php echo $model_title ?></span></div>
							<?php } ?>
							<?php if ($model_lists) { ?>
							<div class="model-lists clear">
								<div class="flex-row clear">
									<?php $j=1; foreach ($model_lists as $m) { 
										$m_title = $m['title'];
										$m_desc = $m['description'];
										$m_icon = $m['icon']; 
										$delay = $j+2;
										?>
										<div class="flex-col about-grey text-center<?php echo ($j==1)? ' first':''?> animated slideInLeft wow" data-wow-delay="0.<?php echo $delay; ?>s" data-wow-duration="1s">
											<div class="inside clear about-inside-icon">
												<?php if ($m_icon) { ?>
													<div class="icon"><img src="<?php echo $m_icon['url'] ?>" alt="" /></div>	
												<?php } ?>	
												<?php if ($m_title) { ?>
													<h3 class="title"><?php echo $m_title ?></h3>
												<?php } ?>	
												<?php if ($m_desc) { ?>
													<div class="description"><?php echo $m_desc ?></div>
												<?php } ?>	
											</div>
										</div>
									<?php $j++; } ?>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="greydivbg"></div>
		</section>

		<?php  
		$partner_text1 = get_field('our_partners_description');
		$partner_text2 = get_field('our_partners_box');
		$partners_image = get_field('our_partners_image'); ?>
		<section class="section-partners clear animated slideInUp wow">
			<div class="inner clear">
				<div class="column left">
					<?php if ($partners_image) { ?>
						<img src="<?php echo $partners_image['url'] ?>" alt="<?php echo $partners_image['title'] ?>" />
					<?php } ?>
				</div>
				<div class="column right">
					<div class="textwrap">
						<h2 class="sub-title">Our Partners</h2>
						<div class="description">
							<?php if ($partner_text1) { ?>
								<div class="textgroup1"><?php echo $partner_text1; ?></div>
							<?php } ?>
							<?php if ($partner_text2) { ?>
								<div class="textgroup2"><?php echo $partner_text2; ?></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php  
			$performance_description = get_field('our_performance_description');
			$performance_imgBg = get_field('performance_image_backround');
			$pImg = ($performance_imgBg) ? ' style="background-image:url('.$performance_imgBg['url'].')"':'';

			$performance_industries_desc = get_field('performance_industries_desc');
			$performance_industries = get_field('performance_industries');
		?>
		<section class="section-performance clear">
			<div class="inner clear"<?php echo $pImg; ?>>
				<div class="overlay"></div>
				<div class="wrapper clear">
					<div class="column left animated slideInLeft wow">
						<h2 class="sub-title">Our Performance and Progress</h2>
						<div class="textwrap"><?php echo $performance_description; ?></div>
					</div>
					<div class="column right animated slideInRight wow">
						<div class="inside clear">
							<div class="desc"><?php echo $performance_industries_desc ?></div>
							<?php if ($performance_industries) { ?>
							<div class="lists">
								<div class="items-wrap">
									<?php foreach ($performance_industries as $p){ 
										$icon = $p['p_icon'];
										$name = $p['p_title'];
										?>
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

		<?php  
			$quote = get_field('quote');
			$quote_image = get_field('quote_image');
			$cta_button_title = get_field('cta_button_title');
			$cta_button_link = get_field('cta_button_link');
		?>
		<section class="section-quote clear">
			<div class="wrapper clear animated slideInUp wow">
				<?php if ($quote_image) { ?>
				<div class="column image">
					<img src="<?php echo $quote_image['url'] ?>" alt="<?php echo $quote_image['title'] ?>" />
				</div>	
				<?php } ?>

				
				<div class="column text <?php echo ($quote_image) ? 'half':'full';?>">
					<?php if ($quote) { ?>
					<div class="inside clear">
						<?php echo $quote ?>
					</div>
					<?php } ?>
					<?php if ($cta_button_title && $cta_button_link) { ?>
						<div class="button">
							<a class="cta-btn" href="<?php echo $cta_button_link ?>"><?php echo $cta_button_title ?><span class="icon"><i class="fal fa-chevron-right"></i></span></a>
						</div>
					<?php } ?>
				</div>	
				
			</div>
		</section>

	<?php endwhile; ?>
</div><!-- #primary -->
<?php
get_footer();
