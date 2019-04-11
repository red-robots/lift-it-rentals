<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

// if ( ! is_active_sidebar( 'sidebar-1' ) ) {
// 	return;
// }

$end = get_field('end_of_article_info', 'option');
 
			$callouts[] = array(
							'title' => get_field('call-out_box_1_title', 'option'),
							'text' => get_field('call-out_box_1_text', 'option'),
							'link' => get_field('call-out_box_1_link', 'option')
						);
			$callouts[] = array(
							'title' => get_field('call-out_box_2_title', 'option'),
							'text' => get_field('call-out_box_2_text', 'option'),
							'link' => get_field('call-out_box_2_link', 'option')
						);
			$callouts[] = array(
							'title' => get_field('call-out_box_3_title', 'option'),
							'text' => get_field('call-out_box_3_text', 'option'),
							'link' => get_field('call-out_box_3_link', 'option')
						);
		?>


<aside id="secondary" class="widget-area" role="complementary">
	<?php //dynamic_sidebar( 'sidebar-1' ); ?>
	<?php 
	if( $end ) {
				echo '<div class="endofpost">'.$end.'</div>';
	} ?>
<section class="grey-sections">
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
				</section>
</aside><!-- #secondary -->
