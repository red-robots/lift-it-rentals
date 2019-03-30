<?php
/**
 * Template Name: Team
 *
 */

get_header(); 
$post_type = 'team';
$taxonomy = 'team_type';
?>
<div id="primary" class="full-content-area clear teampage">
	<main id="main" class="site-main clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php /* LEADERSHIP */ ?>
			<section class="content-inner section-leadership med-wrapper clear">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php  
				$args1 = array(
					'posts_per_page'   => -1,
					'post_type'        => $post_type,
					'post_status'      => 'publish',
					'tax_query' => array(
	                    array(
	                        'taxonomy' => $taxonomy,
	                        'field'    => 'slug',
	                        'terms'    => 'leadership'
	                    ),
	                ),
				);
				$group1 = new WP_Query($args1);
				if ( $group1->have_posts() ) { ?>
				<div class="team-type leadership">
					<div class="row clear">
					<?php $i=1; while ( $group1->have_posts() ) : $group1->the_post();
						$photo = get_field('image');  
						?>
						<div class="team">
							<div class="inside clear">
								<?php if ($photo) { ?>
								<div class="photo">
									<div class="frame"><img src="<?php echo $photo['sizes']['thumbnail'] ?>" alt="<?php echo $photo['title'] ?>" /></div>
								</div>	
								<?php } ?>
								<div class="description">
									<h3 class="name"><?php the_title(); ?></h3>
									<?php echo custom_excerpt(50); ?>
									<div class="button">
										<a href="<?php echo get_permalink(); ?>">Read More</a>
									</div>		
								</div>
							</div>
						</div>
					<?php $i++; endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
				<?php } ?>
			</section>

			<?php /* Board of Advisors */ ?>
			<section id="board-advisors" class="content-inner section-advisors full-width clear">
				<div class="med-wrapper clear">
					<h2 class="section-title">Our Board of Advisors</h2>
					<?php 
					$args2 = array(
						'posts_per_page'   => -1,
						'post_type'        => $post_type,
						'post_status'      => 'publish',
						'tax_query' => array(
		                    array(
		                        'taxonomy' => $taxonomy,
		                        'field'    => 'slug',
		                        'terms'    => 'board-of-advisors'
		                    ),
		                ),
					);
					$group2 = new WP_Query($args2);
					if ( $group2->have_posts() ) { ?>
					<div class="team-type advisors">
						<div class="row clear">
						<?php $i=1; while ( $group2->have_posts() ) : $group2->the_post();
							$photo = get_field('image');  
							?>
							<div class="team">
								<div class="inside clear">
									<?php if ($photo) { ?>
									<div class="photo">
										<div class="frame"><img src="<?php echo $photo['sizes']['thumbnail'] ?>" alt="<?php echo $photo['title'] ?>" /></div>
									</div>	
									<?php } ?>
									<div class="description">
										<h3 class="name"><?php the_title(); ?></h3>
										<?php echo custom_excerpt(30); ?>
										<div class="button">
											<a href="<?php echo get_permalink(); ?>">Read More</a>
										</div>		
									</div>
								</div>
							</div>
						<?php $i++; endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</section>

		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
