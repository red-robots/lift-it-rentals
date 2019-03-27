<?php 
/* Custom Post Types */
//DASH ICONS = https://developer.wordpress.org/resource/dashicons/
add_action('init', 'js_custom_init', 1);
function js_custom_init() {
  $post_types = array(
      array(
          'post_type' => 'team',
          'menu_name' => 'Team',
          'plural'    => 'Team',
          'single'    => 'Team',
          'menu_icon' => 'dashicons-groups',
          'supports'  => array('title','editor','thumbnail')
      )
  );
    
  if($post_types) {
    foreach ($post_types as $p) {
      $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
      $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
      $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
      $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural']; 
      $menu_icon = ( isset($p['menu_icon']) && $p['menu_icon'] ) ? $p['menu_icon'] : "dashicons-admin-post"; 
      $supports = ( isset($p['supports']) && $p['supports'] ) ? $p['supports'] : array('title','editor','custom-fields','thumbnail'); 
      $taxonomies = ( isset($p['taxonomies']) && $p['taxonomies'] ) ? $p['taxonomies'] : array(); 
      $parent_item_colon = ( isset($p['parent_item_colon']) && $p['parent_item_colon'] ) ? $p['parent_item_colon'] : ""; 
      $menu_position = ( isset($p['menu_position']) && $p['menu_position'] ) ? $p['menu_position'] : 20; 
      
      if($p_type) {
          
        $labels = array(
            'name' => _x($plural_name, 'post type general name'),
            'singular_name' => _x($single_name, 'post type singular name'),
            'add_new' => _x('Add New', $single_name),
            'add_new_item' => __('Add New ' . $single_name),
            'edit_item' => __('Edit ' . $single_name),
            'new_item' => __('New ' . $single_name),
            'view_item' => __('View ' . $single_name),
            'search_items' => __('Search ' . $plural_name),
            'not_found' =>  __('No ' . $plural_name . ' found'),
            'not_found_in_trash' => __('No ' . $plural_name . ' found in Trash'), 
            'parent_item_colon' => $parent_item_colon,
            'menu_name' => $menu_name
        );
    
    
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_in_rest' => true,
            'show_ui' => true, 
            'show_in_menu' => true, 
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => false, 
            'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
            'menu_position' => $menu_position,
            'menu_icon'=> $menu_icon,
            'supports' => $supports
        ); 
        
        register_post_type($p_type,$args); // name used in query
          
      }
        
    }
  }
}


  /*
##############################################
  Custom Taxonomies
*/
add_action( 'init', 'build_taxonomies', 0 );
 
function build_taxonomies() {
  // cusotm tax
  register_taxonomy( 'team_type', 'team',
  array( 
    'hierarchical' => true, // true = acts like categories false = acts like tags
    'label' => 'Team Type', 
    'query_var' => true, 
    'rewrite' => true ,
    'show_admin_column' => true,
    'public' => true,
    'rewrite' => array( 'slug' => 'team-type' ),
    '_builtin' => true,
    'show_in_rest' => true,
  ) );
  
} // End build taxonomies


// Add the custom columns to the position post type:
add_filter( 'manage_posts_columns', 'set_custom_cpt_columns' );
function set_custom_cpt_columns($columns) {
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    
    
    if($post_type=='team') {
        unset( $columns['taxonomy-team_type'] );
        unset( $columns['date'] );
        $columns['photo'] = __( 'Photo', 'acstarter' );
        $columns['taxonomy-team_type'] = __( 'Type', 'acstarter' );
        $columns['date'] = __( 'Date', 'acstarter' );
    }
    
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_posts_custom_column' , 'custom_post_column', 10, 2 );
function custom_post_column( $column, $post_id ) {
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    
    if($post_type=='team') {
        switch ( $column ) {
            case 'photo' :
                $img = get_field('image',$post_id);
                $img_src = ($img) ? $img['sizes']['thumbnail'] : '';
                $the_photo = '<span class="tmphoto" style="display:inline-block;width:50px;height:50px;background:#e2e1e1;text-align:center;">';
                if($img_src) {
                   $the_photo .= '<span style="display:block;width:100%;height:100%;background-size:cover;background-position:center;background-image:url('.$img_src.')"></span>';
                } else {
                    $the_photo .= '<i class="dashicons dashicons-businessman" style="font-size:33px;position:relative;top:8px;left:-6px;opacity:0.3;"></i>';
                }
                $the_photo .= '</span>';
                echo $the_photo;
        }
    }
    
}
