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

/* Ajax - Get Staff Details */
add_action( 'wp_ajax_nopriv_staff_details', 'staff_details' );
add_action( 'wp_ajax_staff_details', 'staff_details' );
function staff_details() {
  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $post_id = ($_POST['post_id']) ? $_POST['post_id'] : 0;
    $html = display_staff_details_html($post_id,true);
    $response['content'] = $html;
    echo json_encode($response);
  }
  else {
    header("Location: ".$_SERVER["HTTP_REFERER"]);
  }
  die();
}


function display_staff_details_html($post_id,$popUp=null) {
  $html_content = '';
  $post = get_post($post_id);
  if($post) {
    ob_start();
    $content = $post->post_content;
    $content = apply_filters( 'the_content', $content ); ?>

    <?php if ($popUp) { ?>
      <div id="popUp" class="popup-wrapper">
        <div class="closediv"><div class="wrap"><a id="close-modal" href="#"><span>x</span></a></div></div>
        <div class="popup-inner clear">
        <?php } ?>

          <div class="staff-info clear">
            <?php  
              $taxonomy = 'team_type';
              $photo = get_field('image',$post_id); 
              $title = $post->post_title;
              $types = get_the_terms($post_id,$taxonomy);
              $team_type = '';
              if($types) {
                $i=1; foreach($types as $t) {
                  $comma = ($i>1) ? ', ':'';
                  $team_type .= $comma . $t->name;
                  $i++;
                }
              }
            ?>

            <header class="header">
              <h1 class="entry-title"><?php echo $title; ?></h1>
              <?php if ($team_type) { ?>
              <div class="types"><?php echo $team_type ?></div>
              <?php } ?>
            </header>
            <div class="textwrap <?php echo ($photo) ? 'half':'full';?>">
              <?php echo $content; ?>    
            </div>

            <?php if ($photo) { ?>
              <div class="imagediv">
                <img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>" />
              </div>
            <?php } ?>
          </div>

        <?php if ($popUp) { ?>
        </div>
        <div id="popUpBg" class="overlaybg"></div>
      </div>
    <?php } ?>

    <?php
    $html_content = ob_get_contents();
    ob_end_clean();
  }
  return $html_content;
}

/* SITE MAP */
function generate_sitemap($menuName=null,$sortbyMenu=null) {
  global $wpdb;
  $pages = $wpdb->get_results( "SELECT ID,post_title,post_parent,post_type FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' ORDER BY post_title ASC", OBJECT );
  $links = array();
  $menus = ($menuName) ? wp_get_nav_menu_items($menuName) : '';
  $site_url = get_site_url();
  $menu_pages = array();

  if( $menus ) {
    foreach ($menus as $m) {
      $m_id = $m->ID;
      $m_type = $m->type;
      $pagelink = $m->url;
      $menu_parent_id = $m->menu_item_parent;
      $object_id = $m->object_id;
      $parts = explode("#",$pagelink);

      if( $m_type =='custom' ) {
        $custom_url_parse = parse_url($pagelink);
        $site_url_parse = parse_url($site_url);
        if( isset($custom_url_parse['host']) && $custom_url_parse['host'] ) {
          $custom_host = $custom_url_parse['host'];
          $site_host = $site_url_parse['host'];
          if($custom_host!=$site_host) {
            $m->url = $pagelink;
            $m->external_link = $pagelink;
          }
        } else {

          $hash = ($parts) ? array_filter($parts) : false;

          if( $hash ) {
            if (strpos($pagelink, $site_url) !== false) {
              $pagelink = $pagelink;
            } else {
              $str = ltrim($pagelink, '/');
              $pagelink = $site_url . '/' . $str;
            }
            $m->url = $pagelink;
          }

        }

      } else {
        $menu_pages[$object_id] = $m->title;
      }
    }
  }

  /* Sort Sitemap by Menu Order */
  if( $sortbyMenu ) {
    if( $menus ) {

      foreach ($menus as $m) {
        $id = $m->ID;
        $menu_name = $m->title;
        $m_type = $m->type;
        $object_id = $m->object_id;
        $pagelink = $m->url;
        $menu_parent_id = $m->menu_item_parent;
        $external_link = ( isset($m->external_link) && $m->external_link ) ?  true : false;
        if($menu_parent_id>0) {
          $links[$menu_parent_id]['children'][] = array(
              'title' => $menu_name,
              'id'  => $object_id,
              'url' => $pagelink,
              'external_link'=>$external_link
          );
        } else {
          $links[$id] = array(
            'title' => $menu_name,
            'id'  => $object_id,
            'url' => $pagelink,
            'external_link'=>$external_link
          );
        } 
      }

    }

  } else {

    /* Sort pages alphabetically */
    $links = array();
    $children_menus = array();
    $custom_menu_children = array();

    if( $pages ) {
      foreach( $pages as $p ) {
        $id = $p->ID;
        $page_title = $p->post_title;
        $parent_id = $p->post_parent;
        if( $page_title=='Homepage' ) {
          $page_title = 'Home';
        }
        if( $menu_pages && array_key_exists($id, $menu_pages) ) {
          $page_title = $menu_pages[$id];
        }

        $pagelink = get_permalink($id); 
        if($parent_id>0) {
          $children_menus[$parent_id][$id] = array(
                'title' => $page_title,
                'id'  => $id,
                'url' => $pagelink
            );
        } else {
           $links[$id] = array(
                'title' => $page_title,
                'id'  => $id,
                'url' => $pagelink
              );
        }
      }
    }

    /* Add custom menu */
    if( $menus ) {
      foreach ($menus as $m) {
        $id = $m->ID;
        $menu_name = $m->title;
        $m_type = $m->type;
        $object_id = $m->object_id;
        $pagelink = $m->url;
        $menu_parent_id = $m->menu_item_parent;
        $external_link = ( isset($m->external_link) && $m->external_link ) ?  true : false;

        if( $menu_parent_id > 0 ) {
          $menuObj = get_menu_object( $menu_parent_id, $menuName );
          $menu_object_id = ( isset($menuObj->object_id) && $menuObj->object_id ) ? $menuObj->object_id : '';

          $children_menus[$menu_object_id][$object_id] = array(
            'title' => $menu_name,
            'id'  => $object_id,
            'url' => $pagelink,
            'external_link'=>$external_link
          );

          $existing_children = ( isset($children_menus[$menu_object_id]) && $children_menus[$menu_object_id] ) ? $children_menus[$menu_object_id] : '';
          if( $existing_children && !array_key_exists($object_id, $existing_children)) {
            $children_menus[$menu_object_id][$object_id] = array(
              'title' => $menu_name,
              'id'  => $object_id,
              'url' => $pagelink,
              'external_link'=>$external_link
            );
          }
          
          

        } else {

          if( $m_type=='custom' ) {
            $links[$object_id] = array(
              'title' => $menu_name,
              'id'  => $object_id,
              'url' => $pagelink,
              'external_link'=>$external_link
            );
          }
          
        } 

      }
    }

  }



  /* Arrange parent links alphabetically */
  if( !$sortbyMenu ) {
    /* Arrange children menu alphabetically */
    if( $children_menus ) {
      foreach( $children_menus as $parent_id=>$child_objects ) {
        $child_sorted = sort_array_items($child_objects, 'title', 'ASC');
        $children_menus[$parent_id] = $child_sorted;
        if( array_key_exists($parent_id, $links)) {
          $children = array_values($child_sorted);
          $links[$parent_id]['children'] = $children;
        }
      }
    }
    $links = ($links) ? sort_array_items($links, 'title', 'ASC') : '';
  }
  
  return $links;
  
}

function get_menu_object( $menuId, $menuName ) {
  $obj = '';
  if( $menuId && $menuName ) {
    if( $menus = wp_get_nav_menu_items($menuName) ) {
      foreach( $menus as $m ) {
        $id = $m->ID;
        if( $menuId==$id ) {
          $obj = $m;
          break;
        }
      }
    }
  }
  return $obj;
}


function sort_array_items($array, $key, $sort='DESC') {
  $sorter=array();
  $ret=array();
  $items = array();

  foreach($array as $k=>$v) {
      $str = string_cleaner($v[$key]);
      $index = $str.'_'.$k;
      $sorter[$index] = $v;
  }

  if($sort=='DESC') {
      krsort($sorter);
  } else {
      ksort($sorter);
  }

  foreach($sorter as $key=>$val) {
      $parts = explode('_',$key);
      $n = $parts[1];
      $items[$n] = $val;
  }
  return $items;
}


function string_cleaner($str) {
  if($str) {
      $str = str_replace(' ', '', $str); 
      $str = preg_replace('/\s+/', '', $str);
      $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
      $str = strtolower($str);
      $str = trim($str);
      return $str;
  }
}




