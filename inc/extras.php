<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ACStarter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acstarter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_front_page() || is_home() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage';
    }

    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

	return $classes;
}
add_filter( 'body_class', 'acstarter_body_classes' );

function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


/* Fixed Gravity Form Conflict Js */
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

function custom_excerpt_length( $length ) {
    return 100;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function trim_excerpt($text) {
    $text = str_replace('[&hellip;]', '', $text);
    $text = rtrim($text,' ');
    return $text.'...';
}
add_filter('get_the_excerpt', 'trim_excerpt');


function custom_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt) >= $limit) {
      array_pop($excerpt);
      $excerpt = implode(" ", $excerpt) . '...';
  } else {
      $excerpt = implode(" ", $excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
  return $excerpt;
}




/* News Page */
add_action("wp_ajax_load_more_news", "load_more_news");
add_action("wp_ajax_nopriv_load_more_news", "load_more_news");
function load_more_news() {
    $num = ($_POST["page"]) ? $_POST["page"] : 1;
    $paged = $num + 1;
    $perpage = ($_POST["perpage"]) ? $_POST["perpage"] : 10;

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $content = get_news_items($paged,$perpage);
        $args = array(
            'posts_per_page'   => $perpage,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish',
            'paged'            => $paged
        );
        $posts = new WP_Query($args);
        $total_pages = ($posts) ? $posts->max_num_pages : 0;
        $result['content'] = $content;
        $result['total_pages'] = $total_pages;
        $result['pagenext'] = $paged;

        $result = json_encode($result);
        echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }
   die();
}


function get_news_items($paged=1,$perpage=10) {
    $html_content = '';
    $args = array(
        'posts_per_page'   => $perpage,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'paged'            => $paged
    );
    $posts = new WP_Query($args);
    if ( $posts->have_posts() ) { 
        ob_start(); ?>
    <div data-group="page__<?php echo $paged;?>" class="batch page__<?php echo $paged;?>">
        <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
            <div class="entry clear">
                <div class="post-date"><?php echo get_the_date('m/d/Y'); ?></div>
                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php  }
    $html_content = ob_get_contents();
    ob_end_clean();
    return $html_content;
}



