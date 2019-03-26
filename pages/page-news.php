<?php
/**
 * Template Name: News
 *
 */

get_header(); ?>
<div id="primary" class="full-content-area clear wrapper-grey">
	<main id="main" class="site-main wrapper" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<div class="latestnews newsCol">
				<div class="inside clear">
					<h2 class="col-title">News</h2>
					<?php 
					$a_args = array(
						'posts_per_page'   => 1,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'post_type'        => 'post',
						'post_status'      => 'publish'
					);
					$latest = new WP_Query($a_args);
					if ( $latest->have_posts() ) { ?>
					<article id="post_<?php the_ID();?>" class="article">
						<?php while ( $latest->have_posts() ) : $latest->the_post(); 
							$content = strip_tags( get_the_content() ); ?>
							<h2 class="post-title"><?php the_title(); ?></h2>
							<div class="post-entry">
								<?php the_excerpt(); ?>
								<div class="button"><a href="<?php the_permalink() ?>">Read More</a></div>		
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</article>
					<?php } ?>
				</div>
			</div>

			<div class="newslist newsCol">
				<div class="inside clear">
					<h2 class="col-title">Past Articles</h2>
					<?php 
					$num_items = 10;
					$aa = array(
						'posts_per_page'   => -1,
						'post_type'        => 'post',
						'post_status'      => 'publish'
					);
					$posts = get_posts($aa);
					$count = ($posts) ? count($posts) : 0;

					$b_args = array(
						'posts_per_page'   => $num_items,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'post_type'        => 'post',
						'post_status'      => 'publish'
					);
					$news = new WP_Query($b_args);
					if ( $news->have_posts() ) { ?>
						<div id="news_entries" class="entries clear scrollbar<?php echo ($count>=$num_items) ? ' has-scrollbar':''; ?>">
							<?php while ( $news->have_posts() ) : $news->the_post();  ?>
								<div class="entry clear">
									<div class="post-date"><?php echo get_the_date('m/d/Y'); ?></div>
									<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php } ?>
				</div>

				<?php if ($count>=$num_items) { ?>
				<div class="scrolldowndiv">
					<a id="more-posts" data-currentpage="1" href="#"><i></i></a>
				</div>	
				<?php } ?>

			</div>

		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
