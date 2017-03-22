<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
global $isDevelopment;
$isDevelopment = true; 

global $program_strings;
$program_strings = array('foundation', 'diploma', 'degree', 'postgraduate', 'short-courses');
global $mmu_eng_text;
$mmu_eng_text = __('AND fulfil MMU\'s minimum English requirements.', 'multimedia');

global $_intl_not_available;
 $_intl_not_available = '<p>'.__('This programme is not available for international students.', 'multimedia').'</p>';
global $_local_not_available;
$_local_not_available ='<p>'.__('This programme is not available for local students.', 'multimedia').'</p>';


global $_localization_array;
$international = __( 'International', 'multimedia' );
$local = __( 'Local (Malaysian)', 'multimedia' );
$intl_icon = array( 'normal'  => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/localization/international_grey.png" class="mmu-icon-normal" alt="International Icon" />',
                    'hover'   => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/localization/international_white.png" class="mmu-icon-hover" alt="International Icon Hover" />',
                    'title'   => $international, 
                    'slug'    => 'intl', 
                    'link'    => '#intl',
                    'active'  => '');
                      
$local_icon = array('normal'  => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/localization/local_grey.png" class="mmu-icon-normal" alt="Local Icon" />',
                    'hover'   => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/localization/local_white.png" class="mmu-icon-hover" alt="Local Icon Hover" />',
                    'title'   => $local, 
                    'slug'    => 'local', 
                    'link'    => '#local',
                    'active'  => '');
$_localization_array = array($intl_icon, $local_icon);


/*// Add Post Type Descriptions
global $post_type_slug;
function post_type_desc( $views ){
    
    $screen = get_current_screen();
    $post_type = get_post_type_object($screen->post_type);

    if ($post_type->description) {
      printf('<span style="margin-bottom: 1em; display: block;">%s</span>', $post_type->description); // echo 
    }

    return $views; // return original input unchanged
}*/

/*add_filter("views_edit-academic", 'post_type_desc');
add_filter("views_edit-foundation", 'post_type_desc');
add_filter("views_edit-diploma", 'post_type_desc');
add_filter("views_edit-degree", 'post_type_desc');
add_filter("views_edit-postgraduate", 'post_type_desc');*/

// Add Menu Separators
add_action('admin_init','admin_menu_separator');
function admin_menu_separator() {
  global $menu;
  if (current_user_can('administrator')){
    add_admin_menu_separator('109');
    $last = (string)(key(array_slice($menu, -1, 1, TRUE)) - 0.5);
    add_admin_menu_separator('170');
    add_admin_menu_separator($last);
  }
}

function add_admin_menu_separator($position) {
  global $menu;
  @$menu[$position] = array('','read',"separator",'','wp-menu-separator-mmu'); //@ hides error from this line
  ksort($menu);
}


/*
//Shows the $menu array
add_action( 'admin_init', 'wpse_136058_debug_admin_menu' );
function wpse_136058_debug_admin_menu() {

   var_dump( $GLOBALS[ 'menu' ], TRUE);
}*/

function separator_color_change(){
  echo '
  <style type="text/css">

    #adminmenu li.wp-menu-separator {display: none;}
    #adminmenu li.wp-menu-separator-mmu {
      height: 5px;
      padding: 0;
      margin: 0 0 6px;
      cursor: inherit;
      margin: 0; background: #888;
    }
    @media only screen and (min-width: 960px){
      .menu-icon-foundation >a, .menu-icon-foundation li,
      .menu-icon-diploma > a, .menu-icon-diploma li,
      .menu-icon-degree > a, .menu-icon-degree li,
      .menu-icon-postgraduate >a , .menu-icon-postgraduate li,
      .menu-icon-distance-education >a , .menu-icon-distance-education li { padding-left: 13px !important; }
  }
    #adminmenu .wp-submenu {width: auto;}
    table.template-table { border-collapse: collapse; margin-top: 1em }
    table.template-table th, table.template-table td { border: 1px solid #ccc; padding: 0.2em 1em; text-align: left }

  </style>';
}
add_action( 'admin_head', 'separator_color_change');

/**
 * Proper way to enqueue scripts and styles.
 */
function mmu_theme_add_scripts() {
  global $isDevelopment;
  //name, src, dependencies (array), version, in_footer

  //Stylesheets
  //wp_enqueue_style('materialize-icon', 'http://fonts.googleapis.com/icon?family=Material+Icons' , array(), false, false ); //permanently removed (slow loading)
  wp_enqueue_style('dashicons');
  wp_enqueue_style('genericons', get_template_directory_uri().'/assets/css/genericons/genericons.css', array(), '1.0.0', false );

  //Styles
  if ($isDevelopment) {
    wp_enqueue_style('materialize', get_template_directory_uri().'/assets/css/materialize.min.css', array(), '0.97.6', false );
    wp_enqueue_style('animatecss', get_template_directory_uri().'/assets/css/animate.min.css', array(), '3.5.1', false );
    wp_enqueue_style('sweet-alert', get_template_directory_uri().'/assets/css/sweetalert.css', array(), '1.0.0', false );
    wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/css/magnific-popup.css', array(), '1.1.0', false );
    wp_enqueue_style('owl-carousel', get_template_directory_uri().'/assets/css/owl.carousel.css', array(), '1.3.2', false );
    wp_enqueue_style('main', get_template_directory_uri().'/assets/css/main.css', array(), '0.0.1', false );
  } else {
    wp_enqueue_style('main', get_template_directory_uri().'/assets/dist/main.css', array(), '0.0.1', false );
  }

  //JS
  if ($isDevelopment) {
  wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '2.2.3', true );
  wp_enqueue_script('materialize', get_template_directory_uri() . '/assets/js/materialize.min.js', array(), '0.97.6', true );

  wp_enqueue_script('offscreen-js', get_template_directory_uri() . '/assets/js/jquery.offscreen.js', array(), '1.0.0', true );
  wp_enqueue_script('js-cookie', get_template_directory_uri() . '/assets/js/js.cookie.js', array(), '2.1.2', true );
  wp_enqueue_script('mustachejs', get_template_directory_uri() . '/assets/js/mustache.min.js', array(), '2.2.1', true );
  wp_enqueue_script('matchheight', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js', array(), '0.7.0', true );
  wp_enqueue_script('sweetalert', get_template_directory_uri() . '/assets/js/sweetalert.min.js', array(), '1.0.0', false );
  wp_enqueue_script('paginationjs', get_template_directory_uri() . '/assets/js/pagination.min.js', array(), '2.0.7', true );
  wp_enqueue_script('pageup', get_template_directory_uri() . '/assets/js/jquery.pageup.js', array(), '0.1', true );
  wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), '1.1.0', true );
  wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '1.0', true );
  wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array(), '0.0.1', true );

  wp_enqueue_script('staff_directory', get_template_directory_uri() . '/assets/js/mmu-ajax-staff-directory.js', array(), '0.0.1', true );
  wp_enqueue_script('news_events', get_template_directory_uri() . '/assets/js/mmu-ajax-news-events.js', array(), '0.0.1', true );
  wp_enqueue_script('ajax_faculty_load_degree', get_template_directory_uri() . '/assets/js/mmu-ajax-faculty-load-degree.js', array(), '0.0.1', true );
  wp_enqueue_script('ajax_research_centre', get_template_directory_uri() . '/assets/js/mmu-ajax-research-centre.js', array(), '0.0.1', true );
  wp_enqueue_script('load_more', get_template_directory_uri() . '/assets/js/mmu-load-more.js', array(), '0.0.1', true );
  wp_enqueue_script('pg-faculty', get_template_directory_uri() . '/assets/js/mmu-faculty.js', array(), '0.1', true );
  wp_enqueue_script('pg-campuslife', get_template_directory_uri() . '/assets/js/mmu-campuslife.js', array(), '0.1', true );
  wp_enqueue_script('homejs', get_template_directory_uri() . '/assets/js/mmu-home.js', array(), '1.0', true );
  wp_enqueue_script('youtube-video', get_template_directory_uri() . '/assets/js/mmu-youtube-video.js', array(), '1.0', true ); 
  wp_enqueue_script('slider-video', get_template_directory_uri() . '/assets/js/mmu-slider-video.js', array(), '1.0', true );
  wp_enqueue_script('gmap-demographic', get_template_directory_uri() . '/assets/js/mmu-about.js', array(), '1.0', true );
  wp_enqueue_script('gmap-marker', get_template_directory_uri() . '/assets/js/mmu-markerclusterer.js', array(), '1.0', true );

  } else {
    wp_enqueue_script('app-js', get_template_directory_uri() . '/assets/dist/app.js', array(), '1.0', true ); 
  }

  
}
add_action( 'wp_enqueue_scripts', 'mmu_theme_add_scripts' );

/*add_filter( 'script_loader_tag', function ( $tag, $handle ) {
  if ($handle !== 'news_events') return $tag;

  return str_replace( ' src', ' defer src', $tag );
}, 10, 2 );*/


function multimedia_setup(){
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   */
  load_theme_textdomain( 'multimedia', get_template_directory() . '/languages' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 1200, 9999 );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  // This theme uses wp_nav_menu() in multiple locations
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'multimedia' ),
    'social' => __( 'Social Media Icons', 'multimedia' ),
    'footer' => __( 'Footer Menu', 'multimedia' ),
  ) );

  //Add Custom Header
  add_theme_support( 'custom-header' );

  //Add Custom Caption
  add_theme_support( 'caption' );

  /*
   * This theme styles the visual editor to resemble the theme style,
   * specifically font, colors, icons, and column width.
   */
  //add_editor_style( get_template_directory().'/assets/css/editor-style.css' );
  add_editor_style( array( 'assets/css/editor-style.css', get_template_directory() ) );

}
add_action( 'after_setup_theme', 'multimedia_setup' );


/**
 * Adding ACF Options Page for Theme Options
 **/
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'      => 'Theme Options',
    'menu_title'      => 'Theme Options',
    'menu_slug'       => 'theme-options',
    'capability'      => 'manage_options',
    'parent_slug'     => '',
    'position'        => false,
    'icon_url'        => false,
    'redirect'        => true,
  ));

  acf_add_options_sub_page(array(
    'page_title'      => 'General Settings',
    'menu_title'      => 'General Settings',
    'menu_slug'       => 'general-settings',
    'parent_slug'     => 'theme-options',
  ));
}


function wpse_wp_head(){
  // first make sure this is a single post/page
  //if( !is_page() || !is_single() )
 //     return;

  // then get the post data
  $post = get_post();
  if (!empty($post)) {
    echo '<meta name="post_id" value="'. $post->ID .'" />';
  }
/*
  $author = get_user_option('display_name', $post->post_author );
  echo '<meta name="author" value="'. esc_attr( $author ) .'" />';*/
}
add_action('wp_head', 'wpse_wp_head');

/* Adds default placeholder for Degree & Diploma (Create New Page) Titles */
function wpb_change_title_text( $title ){
  $screen = get_current_screen();
  if  ( $screen->post_type == 'degree' ) {
    $title = 'e.g. Banking and Finance';
  } else if ($screen->post_type == 'foundation' || $screen->post_type == 'diploma') {
    $title = 'e.g. Telecommunication Engineering';
  }
  return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );


/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
/*add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
  global $typenow;
  $post_type = 'requirements'; // change to your post type
  $taxonomy  = 'requirement_cat'; // change to your taxonomy
  if ($typenow == $post_type) {
    $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
    $info_taxonomy = get_taxonomy($taxonomy);
    wp_dropdown_categories(array(
      'show_option_all' => __("Show All {$info_taxonomy->label}"),
      'taxonomy'        => $taxonomy,
      'name'            => $taxonomy,
      'orderby'         => 'name',
      'selected'        => $selected,
      'show_count'      => true,
      'hide_empty'      => true,
    ));
  };
}*/
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
/*add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
  global $pagenow;
  $post_type = 'requirements'; // change to your post type
  $taxonomy  = 'requirement_cat'; // change to your taxonomy
  $q_vars    = &$query->query_vars;
  if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
    $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
    $q_vars[$taxonomy] = $term->slug;
  }
}*/

/**
 * Add Filter to all Post Types that has Custom Taxonomy (Category)
 * @link http://wordpress.stackexchange.com/questions/107772/add-filter-to-admin-list-for-all-custom-post-types-by-their-custom-taxonomies/107773
 */
function taxonomy_filter_restrict_manage_posts() {
  global $typenow, $post, $post_id;

  if( $typenow != "page" && $typenow != "post" ){
    //get post type
    $post_type = get_query_var('post_type'); 

    //get taxonomy associated with current post type
    $taxonomies = get_object_taxonomies($post_type);

    //in next loop add filter for tax
    if ($taxonomies) {
      foreach ($taxonomies as $tax_slug) {
        $tax_obj = get_taxonomy($tax_slug);
        $tax_name = $tax_obj->labels->name;
        $terms = get_terms($tax_slug);
        echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
        echo "<option value=''>Show All $tax_name</option>";
        foreach ($terms as $term) { 
            $label = (isset($_GET[$tax_slug])) ? $_GET[$tax_slug] : ''; // Fix
            echo '<option value='. $term->slug, $label == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
        }
        echo "</select>";
      }
    }
  }
}
add_action( 'restrict_manage_posts', 'taxonomy_filter_restrict_manage_posts' );


function clean($string) {
  $string = str_replace(' ', '-', $string); // Replaces all spaces with dash.
  $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
  return  $string;
}
function clean_underscore($string) {
  $string = strtolower($string);
  $string = str_replace(' ', '_', $string); // Replaces all spaces with dash.
  $string = preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
  return  $string;
}
function combine($string) {
  $string = preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars including dash (-).
  return  $string;
}

function make_blue_btn($url, $text, $new_tab = FALSE) {
  if ($new_tab == TRUE) $target = 'target="_blank"'; 
  else $target = '';

  $html_url = '<a href="'.$url.'" title="'.$text.'" class="waves-effect waves-light btn mmublue" '.$target.'>'.$text.'</a>';
  return $html_url;
}

function make_white_btn($url, $text, $new_tab = FALSE) {
  if ($new_tab == TRUE) $target = 'target="_blank"'; 
  else $target = '';

  $html_url = '<a href="'.$url.'" title="'.$text.'" class="waves-effect waves-light btn mmuwhite" '.$target.'>'.$text.'</a>';
  return $html_url;
}

function get_requirement_by_course($req_post_id, $post, $location) { //DELETE SOON
  $output ='';
  $req_metas = get_post_meta($req_post_id);
  $intl_text = __('International Students', 'multimedia');
  $local_text = __('Local Students', 'multimedia');

  global $mmu_eng_text;

  //Get Location Titles
  if ($location == 'intl') {
    $output .= '<h5>'.$intl_text.'</h5>';
  } else if ($location == 'local') {
    $output .= '<h5>'.$local_text.'</h5>';
  }
  //Get English Requirement Flags
  if (isset($req_metas['intl_eng_boolean'])){
    $intl_eng_boolean = implode($req_metas['intl_eng_boolean']);
  }
  if (isset($req_metas['local_eng_boolean'])){
    $local_eng_boolean = implode($req_metas['local_eng_boolean']);
  }

  if (implode($req_metas[$location.'_eng_boolean']) == 1) {
    $int_reqs = implode($req_metas[$location.'_requirements']);

      if ($intl_eng_boolean == 1){
        $eng_req_anchor_li = '<li><a href="'.get_permalink(get_page_by_path('how-to-apply', OBJECT, 'admission')->ID).'#'.$location.'-'.str_replace("-", "", get_post_type($post->ID)).'-requirements"/>'.$mmu_eng_text.'</a></li>';
        $end_ul_pos = strrpos($int_reqs, '</ul>');
        if (isset($int_reqs)){
          $int_reqs = substr_replace($int_reqs, $eng_req_anchor_li, $end_ul_pos, 0);
        }
      }

    //$output .= mmuautop(implode($req_metas[$location.'_requirements']));
    $output .= mmuautop($int_reqs);
  } else {
    $output .= 'This degree programme is not available for international student.';
  }
  return $output;

}



function get_degree_options_text ($post_type){
  if ($post_type == 'diploma') {
    return __('Post-Diploma Degree Programmes', 'multimedia');
  } else if ($post_type == 'foundation') {
    return __('Post-Foundation Degree Programmes', 'multimedia');
  }
}

function get_degree_progression_urls($faculty_ids){ 
  $output_arr = array();
  if (empty($faculty_ids)) {
    return NULL;
  } else if (count($faculty_ids) > 3){ 
    return __('<span style="color: red;">WARNING</span>: Selected too many faculties. Please select only 1 or 2 faculties.', 'multimedia'); 
  } else {

  $courses = get_program_using_faculty_id('degree', $faculty_ids);

  foreach ($faculty_ids as $faculty_id) {
    $faculty = get_term_by('id', $faculty_id, 'faculty');
    $degrees = array();
    
    foreach($courses as $course) {
      $tags = get_the_terms($course->ID, 'faculty');
      if ($faculty->term_id == $tags[0]->term_id){
        $degrees[] = $course;
      }
    }
    $output_arr[] = array('faculty' => $faculty, 
                          'degrees' => $degrees);
  }
  return $output_arr;
  }
}

function get_program_using_faculty_id($program, $faculty_ids){
   $args = array(
    'posts_per_page'   => 100,
    'tax_query'        => array(
                            array(
                              'taxonomy'  => 'faculty',
                              'field'     => 'id',
                              'terms'     => $faculty_ids,
                            ),
                          ),
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => $program,
    'post_status'      => 'publish',
  );
  return get_posts( $args ); 
}

function make_course_back_button($hash, $post = ''){
  if ($hash == 'degree' && !empty($post->post_parent) != 0){
    $academic_link = get_permalink($post->post_parent);
  } else {
    $academic_link = get_permalink(get_page_by_path('degrees-and-programmes', OBJECT, 'academic')->ID).'#'.$hash;
  }
  
  $output = '<div><a href="'.$academic_link.'" title="'.__('Go Back','multimedia').'"><span class="dashicons dashicons-arrow-left-alt"></span>'.__('Back','multimedia').'</a></div>';

  return $output;
}

function query_posts_by_post_type($post_type, $post_parent){
  $args = array(
    'posts_per_page'   => 1000,
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => $post_type,
    'post_parent'      => $post_parent,
    'post_status'      => 'publish',
    'suppress_filters' => true 
  );
  $posts_array = get_posts( $args );
  return $posts_array;
}

function get_program_courses($posts){

  if (!empty($posts)) {
    $course = array();
    $empty_icon = array('normal'  => '<img src="'.get_template_directory_uri().'/assets/img/icons/empty_icon.png" class="mmu-icon-normal"/>',
                        'hover'   => '<img src="'.get_template_directory_uri().'/assets/img/icons/empty_icon.png" class="mmu-icon-hover"/>');

    $icon_normal = (!empty(get_meta($posts->ID, 'icon_normal'))) ? wp_get_attachment_image(get_meta($posts->ID, 'icon_normal'), 'full', '', array('class' => 'mmu-icon-normal')) : $empty_icon['normal'];
    $icon_hover = (!empty(get_meta($posts->ID, 'icon_hover'))) ? wp_get_attachment_image(get_meta($posts->ID, 'icon_hover'), 'full', '', array('class' => 'mmu-icon-hover')) : $empty_icon['hover'];
    
    $course['icon_normal'] = $icon_normal;
    $course['icon_hover']  = $icon_hover;
    $course['title'] = $posts->post_title;
    $course['title2'] = get_meta($posts->ID, 'secondary_title');
    $course['link'] = get_permalink($posts->ID);
    $course['type'] = $posts->post_type;
    $course['parent'] = $posts->post_parent;

    return $course;
  }
}

function get_postgraduate_req($post_id, $postg_type) {
  $category = clean($postg_type['slug']);

  $count = get_meta($post_id, $category.'_req');

  for ($i = 0; $i < $count; $i++) {
    $title_bool_key = $category.'_req_'.$i.'_title_boolean';
    $title_key = $category.'_req_'.$i.'_title';
    $requirement_key = $category.'_req_'.$i.'_requirement';
    $part_time_key = $category.'_req_'.$i.'_part_time';
    $full_time_key = $category.'_req_'.$i.'_full_time';
    $availability_key = $category.'_req_'.$i.'_availability';

    $requirement_id = get_meta($post_id, $requirement_key);
    $requirement = get_requirement_data($requirement_id, 'local', 'postgraduate');
    
    $requirement_details[] = array( 'title_bool'    => get_meta($post_id, $title_bool_key),
                                    'title'         => get_meta($post_id, $title_key),
                                    'req_title'     => $requirement['title'], 
                                    'req_details'   => $requirement['content'],
                                    'part_time'     => get_meta($post_id, $part_time_key),
                                    'full_time'     => get_meta($post_id, $full_time_key),
                                    'availability'  => get_meta($post_id, $availability_key));
  }
  return $requirement_details;
}

function check_table($table){
  if (!empty($table)){
    foreach ($table['h'] as $header){
      if (!empty($header['c'])){
        return TRUE;
      }
    }
    foreach ($table['b'] as $row){
      foreach ($row as $col) {
        if (!empty($col['c'])){
          return TRUE;
        }
      }
    }
  }
  return FALSE;
}

function get_fees_array($post_id, $location){

  $output = array();
  $queries = query_posts_from_taxonomy_category('academic_cat', 'how-to-apply-programs-'.$location, '', 'menu_order', 'ASC');

  foreach ($queries as $query) {
    $icon_normal = wp_get_attachment_image(get_meta($query->ID, 'icon_normal'), 'full', $query->post_title, array('class' => 'mmu-icon-normal'));
    $icon_hover = wp_get_attachment_image(get_meta($query->ID, 'icon_hover'), 'full', $query->post_title, array('class' => 'mmu-icon-hover'));
    $icon_color = wp_get_attachment_image(get_meta($query->ID, 'icon_color'), 'full', $query->post_title, array('class' => 'mmu-icon-color'));
    $icon_title = $query->post_title;
    $meta_key = $location.'_'.clean($query->post_name);
    $metas = get_meta($post_id, $meta_key);
    $content_array = array();

    if (!empty($metas)) {
      foreach ($metas as $key => $meta) {
        $component_key = $meta_key.'_'.$key.'_'.$meta;

        if ($meta == 'table') {
          $component = json_decode(get_meta($post_id, $component_key), TRUE);
        } else if ($meta == 'notes') {
          $component = mmuautop(get_meta($post_id, $component_key));
        }
        $content_array[] = array($meta => $component);
      }
    }

    $icon_info = array( 'normal'  => $icon_normal,
                        'hover'   => $icon_hover,
                        'color'   => $icon_color,
                        'title'   => $icon_title,
                        'content' => $content_array);

    array_push($output, $icon_info);
  }
  return $output;
}


/**
 * Echoes a Table template using any variable
 * @example how-to-apply, courses
 * @return $ouput contains HTML
 **/
function include_table($table, $classes = ''){
  include(locate_template('/template-parts/table.php'));
}
function include_vtable($table, $classes = ''){
  include(locate_template('/template-parts/vtable.php'));
}

function include_table_data_dump($table, $classes=''){
  include(locate_template('/template-parts/table_data_dump.php'));
}
function include_table_data_dump_three($table_array = array()){
  include(locate_template('/template-parts/table_data_dump_three.php'));
}

function include_faculty_course_list($array) {
  include(locate_template('/template-parts/faculty_course_list.php'));
}

/**
 * Function to remove all empty arrays. Used to control array filter for table heading. 
 * @return array that are not empty
 **/
function table_col_not_empty($v){ 
  if (!empty($v['c'])) { return $v; }
}


/**
 * Create an array of student counts sorted by year using ACF Tables
 **/
function parse_array_into_tables ($table_array) {
  $new_table = array();

  array_shift($table_array['h']);
  foreach($table_array['b'] as $table) {
    $year = array_shift($table);
    foreach($table as $key => $row){
      $new_table [strip_tags($year['c'])] [$table_array['h'][$key]['c']] = $row['c'];
    }
  }
  ksort($new_table);
  return $new_table;
}

function get_campus_details ($campus_ids, $cost_bool = FALSE) {
  $campus_array = array();

  if (!empty($campus_ids)) {
    //If 'all' is added, function will return all post IDs from 'campus' post type
    if ($campus_ids == 'all') {
      $campus_ids = query_posts_by_post_type('campus', 0);
      $campus_ids = wp_list_pluck($campus_ids, 'ID');
    }

    foreach ($campus_ids as $campus_id) {
      $contacts = array(); //Refresh array
      $costs = array();
      $post = get_post($campus_id);
      $title = $post->post_title;
      $image = wp_get_attachment_image_src(get_meta($campus_id, 'image'), 'full')[0]; //Returns array(url, width, height), we need only url
      $desc = mmuautop(get_meta($campus_id, 'desc_about'));
      $location = get_meta($campus_id, 'location');
      $address = mmuautop(get_meta($campus_id, 'address'));

      //Get Contacts Details
      if (!empty(get_meta($campus_id, 'contact_details'))) {
        for ($i = 0; $i < get_meta($campus_id, 'contact_details'); $i++){
          $string = 'contact_details_'.$i.'_';
          $department = $string.'department';
          $toll_free = $string.'toll_free';
          $tel = $string.'tel';
          $fax = $string.'fax';
          
          $contacts[] = array('department'  => get_meta($campus_id, $department),
                              'toll_free'   => get_meta($campus_id, $toll_free),
                              'tel'         => get_meta($campus_id, $tel),
                              'fax'         => get_meta($campus_id, $fax));
        }
      } else { $contacts = null; }
      

      //Get Cost of Living Details
      if (!empty(get_meta($campus_id, 'living_cost')) && $cost_bool == TRUE) {
        for ($j=0; $j<get_meta($campus_id, 'living_cost'); $j++) {
          $string = 'living_cost_'.$j.'_';
          $cost_title = get_meta($campus_id, $string.'title');
          $cost_icon = get_meta($campus_id, $string.'icon');
          $cost_desc = get_meta($campus_id, $string.'desc');

          $costs[] = array('title'  => $cost_title,
                          'icon'  => wp_get_attachment_image($cost_icon, 'full'),
                          'desc'  => mmuautop($cost_desc));
        }
      } else { $costs = null; }
      

      $campus_array[] = array('title'     => $title,
                              'image'     => $image,
                              'desc'      => $desc,
                              'location'  => $location,
                              'address'   => $address,
                              'contacts'  => $contacts,
                              'costs'     => $costs);
    }
    return $campus_array;
  }
}

function get_financial_assistance_array($post_id){
  $tabs = array('loan', 'scholarship', 'bursary');
  $post_meta = get_post_meta($post_id);

  foreach ($tabs as $key => $tab_slug) { //Loop Tabs 
    $components = array();

    for ($i=0; $i<get_meta($post_id, $tab_slug); $i++){ //Loop Accordion 
      $tab_string = $tab_slug.'_'.$i;
      $accordion_title = $tab_string.'_title';
      $accordion_string = $tab_string.'_item';
      $accordion_regex = '/^'.$tab_string.'_item_.*/';
      $component_names = get_meta($post_id, $accordion_string);
      
      $components['accordion']['item_'.$i]['title'] = get_meta($post_id, $accordion_title);

      if (!empty($component_names)) {
        $j = 0;
        foreach ($component_names as $component_name) { //Loop Accordion Components
          $component_string = $accordion_string.'_'.$j.'_'.$component_name;
          $components['accordion']['item_'.$i]['content'][] = array($component_name => get_meta($post_id, $component_string));
          $j++;
        }
      }
    }
    $page_info = array('desc'   => mmuautop(get_meta($post_id, 'desc_'.$key)),
                       'title'  => ucwords($tab_slug),
                       'title2' => '',
                       'image'  => wp_get_attachment_image(get_meta($post_id, 'icon_color_'.$key), 'full','', array('class' => 'mmu-icon-color')) );

    $components['page_info'] = $page_info;
    $accordions[] = $components;  
  }
  return $accordions;
}

function filter_by_key($array, $match_string){
  $new_array = array();
  foreach ($array as $key => $meta) {

    if (preg_match($match_string, $key)){
      $new_array[$key] = $meta; 
    }
  }
  return $new_array;
}

/*
 * Creates an array that displays 'parent' and 'child'
 * @return array
 */
function get_hierarchial_term_array($term_array) {
  if (!empty($term_array)){
    $term_parents = array_filter($term_array, function($array) { return ($array->parent == 0); });
  
    foreach ($term_parents as $parent_term) {
      $term_child = array_filter($term_array, function($array) use($parent_term) { return ($array->parent == $parent_term->term_id); });  
      $term_hierarchy[] = array('parent'  => $parent_term,
                                'child'   => $term_child);
    }
    return $term_hierarchy;
  }
}

function mmuautop ($content){
  /*$content = do_shortcode($content);
  $content = mmuautop($content);*/
  $content = apply_filters('the_content', $content); //Display all contents according to Wordpress 'the_content' specification. Runs shortcode and mmuautop function together.
  return $content;
}


function get_array_from_repeater($post, $repeater_key = '', $components = array()) {
  $output = array();
  $row = array();
  $row_count = get_meta($post->ID, $repeater_key);

  for ($i=0; $i<$row_count; $i++) {
    $row_str = $repeater_key.'_'.$i.'_';
    foreach($components as $component) {
      $component_str = $row_str.$component;
      $row[$component] = get_meta($post->ID, $component_str);
    }
    $output[] = $row;
  }
  return $output;
}

function get_array_from_flexcontent($post, $flex_content_meta){

  if ($content = get_meta($post->ID, $flex_content_meta)){
    foreach($content as $key => $component) {
      $meta_key = $flex_content_meta.'_'.$key.'_';

      //Just normal text
      if ($component == 'text') {
        $output[] = array('type' => $component, 'data' => mmuautop(get_meta($post->ID, $meta_key.$component)));

      //Table using <table>
      } else if ($component == 'table') {
        $output[] = array('type' => $component, 'data' => json_decode(get_meta($post->ID, $meta_key.$component), TRUE));

      //H2 or H3 title
      } else if ($component == 'title') {
        $output[] = array('type' => $component, 'data' => get_meta($post->ID, $meta_key.$component));
      

      //Table using <div> and simple tables (more responsive)
      } else if ($component == 'table_data_dump'){
        $output[] = array('type' => $component, 'data' => json_decode(get_meta($post->ID, $meta_key.'table_data_dump'), TRUE));

      //Same as above but 3 tables in 1 row
      } else if ($component == 'table_data_dump_three') {
        $output[] = array('type' => $component, 'data' => array(json_decode(get_meta($post->ID, $meta_key.'table_data_dump_1'), TRUE), 
                                                                json_decode(get_meta($post->ID, $meta_key.'table_data_dump_2'), TRUE), 
                                                                json_decode(get_meta($post->ID, $meta_key.'table_data_dump_3'), TRUE),));

      } else if ($component == 'faculty_course_list') {
        $output[] = array('type' => $component, 'data' => get_faculty_course_list(get_meta($post->ID, $meta_key.'qualification'), get_meta($post->ID, $meta_key.'faculty')));

      } else if ($component == '2columns') {
        $output[] = array('type' => $component, 'data' => array('col1' => mmuautop(get_meta($post->ID, $meta_key.'col1')),
                                                                'col2' => mmuautop(get_meta($post->ID, $meta_key.'col2'))));
      
      } else if ($component == '3columns') {
        $output[] = array('type' => $component, 'data' => array('col1' => mmuautop(get_meta($post->ID, $meta_key.'col1')),
                                                                'col2' => mmuautop(get_meta($post->ID, $meta_key.'col2')),
                                                                'col3' => mmuautop(get_meta($post->ID, $meta_key.'col3'))));

      } else if ($component == 'quote') {
        $output[] = array('type' => $component, 'data' => mmuautop(get_meta($post->ID, $meta_key.$component)));

      } else if ($component == 'accordion') {
        $output[] = array('type' => $component, 'data' => get_array_from_repeater($post, $meta_key.$component, array('title', 'wysiwyg')));

      } else if ($component == 'news_events') {
        $output[] = array('type' => $component, 'data' => get_news_events_options(3, get_meta($post->ID, $meta_key.$component)));

      } else if ($component == 'section_title') {
        $output[] = array('type' => $component, 'data' => get_meta($post->ID, $meta_key.'title'));

      } else if ($component == 'titled_table') {
        $output[] = array('type' => $component, 'data' => array('title' => get_meta($post->ID, $meta_key.'title'),
                                                                'table' => json_decode(get_meta($post->ID, $meta_key.'table'), TRUE)));

      } else if ($component == 'full_column') {
        $output[] = array('type' => $component, 'data' => array('title' => get_meta($post->ID, $meta_key.'title'),
                                                                'text' => mmuautop(get_meta($post->ID, $meta_key.'text')) ));

      } else if ($component == 'two_columns') {
        $output[] = array('type' => $component, 'data' => array('title' => get_meta($post->ID, $meta_key.'title'),
                                                                'text_1' => mmuautop(get_meta($post->ID, $meta_key.'text_1')),
                                                                'text_2' => mmuautop(get_meta($post->ID, $meta_key.'text_2')) ));


      }
    }
    return $output;
  }
}

function get_news_events_options($number, $term_id) {
  $args = array(
    'posts_per_page'  => $number,
    'orderby'         => 'date',
    'order'           => 'DESC',
    'post_type'       => array('news','events'),
    'tax_query' => array(
      array(
        'taxonomy' => 'news_category',
        'field'    => 'id',
        'terms'    => $term_id,
      ),
    ),
    'post_status'     => 'publish',
  );
  return get_posts($args);
}

/**
 * Get Custom Fields with more control using get_post_meta();
 **/
function get_meta($id, $key){
  $custom_keys = get_post_custom_keys($id);
  if (!empty($custom_keys)) {
    if ( in_array($key, $custom_keys) && !empty($item = get_post_meta($id, $key)) ) {
      return $item[0];
    } else {
      return '';
    }
  }
}



function get_faculty_course_list ($programs_ids, $faculty) {
  $program_slugs = array();
  $data = array();

  $args = array(
    'posts_per_page'  => 100,
    'orderby'         => 'menu_order',
    'order'           => 'ASC',
    'post_type'       => 'academic',
    'post__in'        => $programs_ids,
    'post_status'     => 'publish',
  );
  $programs = get_posts($args);

  //Get program slugs in array
  foreach ($programs as $program){ $program_slugs[] = $program->post_name; }

  //Get all courses in the program using faculty
  $args = array(
    'posts_per_page'   => 100,
    'tax_query'        => array(
                            array(
                              'taxonomy'  => 'faculty',
                              'field'     => 'id',
                              'terms'     => $faculty,
                            ),
                          ),
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => $program_slugs,
    'post_status'      => 'publish',
  );
  $courses = get_posts( $args ); 

  //Sort all courses according to the programs
  foreach ($programs as $program) {
    $program_courses = array();
    foreach ($courses as $course) {
      if ($course->post_type == $program->post_name) {
        $program_courses[] = $course;
      }
    }
    $data[] = array('program' => $program,
                    'courses' => $program_courses);
  }

  return $data;
}

function query_award_pages($ppp, $post_type, $page, $year, $taxonomy = '', $term_id = '') {
  $args = array(
    'posts_per_page'=> $ppp,
    'post_type'     => $post_type,
    'orderby'       => 'date',
    'order'         => 'DESC',
    'post_status'   => 'publish',
    'paged'         => $page,
    'date_query'    => array(
      array(
        'year'  => $year,
      ),
    ),
  );
  if (!empty($taxonomy) && !empty($term_id)) {
    $args['tax_query'] =  array(
                            array(
                              'taxonomy'  => $taxonomy,
                              'field'     => 'id',
                              'terms'     => $term_id,
                            ),
                          );
  }

  $query = get_posts( $args );
  return $query;
}

/**
 * Count Posts by Year. 
 * Returns array(array('year', 'count'))
 **/
function post_count_by_year($post_type, $term_id = ''){
  global $wpdb;

  $table_posts = $wpdb->prefix.'posts';
  $table_term_relationships = $wpdb->prefix.'term_relationships';
  $term_filter = (!empty($term_id)) ? 'AND term_taxonomy_id = "'.$term_id.'"' : '';

  $query = $wpdb->get_results("SELECT YEAR(post_date) AS `year`, COUNT( * ) AS `count` 
                               FROM $table_posts
                               LEFT JOIN $table_term_relationships
                               ON $table_posts.ID = $table_term_relationships.object_id
                               WHERE post_type = '$post_type' AND post_status = 'publish' $term_filter
                               GROUP BY YEAR(post_date) ORDER BY `year` ASC", ARRAY_A);
  return $query;
}

/**
 * Get Posts By Date monthly
 **/
function get_news_dates_by_term($post_type, $term_id = '') {
  global $wpdb;

  $table_posts = $wpdb->prefix.'posts';
  $table_term_relationships = $wpdb->prefix.'term_relationships';
  $term_filter = (!empty($term_id)) ? 'AND term_taxonomy_id = "'.$term_id.'"' : '';

  $query = $wpdb->get_results(" SELECT post_date AS `date`, COUNT( * ) AS `count` 
                                FROM $table_posts
                                LEFT JOIN $table_term_relationships
                                ON $table_posts.ID = $table_term_relationships.object_id
                                WHERE post_type = '$post_type' AND post_status = 'publish' $term_filter
                                GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY `date` DESC
                                LIMIT 12", ARRAY_A);
  return $query;
}



function facebook_share_link($url) {
  echo 'https://www.facebook.com/sharer/sharer.php?u='.$url;
}
function twitter_share_link($url) {
  echo 'https://twitter.com/home?status='.$url;
}

/*
* Filter URE Restrict Edit Post Type
* Docs: https://www.role-editor.com/documentation/hooks/ure_restrict_edit_post_type/
*/
add_filter('ure_restrict_edit_post_type', 'exclude_posts_from_edit_restrictions');
function exclude_posts_from_edit_restrictions($post_type) {
  $restrict_it = true;  
  if (current_user_can('foe') || current_user_can('faculty_manager')) {
    if ($post_type == 'news' || $post_type == 'events' || $post_type == 'foundation' ) {
      $restrict_it = false;
    }
  }
  return $restrict_it;
}


/*
* Admin Editor: Filters each tabs and change their name according to title
* @Only applies to "Faculty" Post Type
*/
function my_acf_update_tabs_title( $field ) {
  global $post;
  
  if (!empty($post) && ($post->post_type == 'faculty' || $post->post_name == 'home')){
  //if (!empty($post) && $post->post_type == 'faculty'){
    
    $tab_key = clean_underscore($field['label']);
    //$tab_key = '';
    $title = get_field($tab_key.'_title');

    if (!is_null($title)) {
      if (!empty($title)){
        $field['label'] = $title;
      } else {
        $field['label'] = 'Unused Tab';
      }
    }
  }
  wp_reset_postdata(); //Important
    
  return $field;
}
add_filter('acf/load_field/type=tab', 'my_acf_update_tabs_title');


/**
 * Used to translate August 2016 into value 2016-08 and text August 2016
 * Used to format news and events date dropdown
 **/
/*function get_news_date_options($date_array) {
  $output = array();
  if (!empty($date_array)){
    foreach ($date_array as $date){
      $date_object = new DateTime($date);
      $output[] = array('value' => $date_object->format('Y-m'),
                        'text'  => $date);
    }
  }
  return $output;
}*/
function get_news_date_options($date_array) {
  $output = array();
  if (!empty($date_array)){
    foreach ($date_array as $date){
      $date_object = new DateTime($date['date']);
      $output[] = array('value' => $date_object->format('Y-m'),
                        'text'  => $date_object->format('F Y'));
    }
  }
  return $output;
}


function get_faculty_icons ($id_array) {
  $faculties = array();

  if (!empty($id_array)){
    foreach ($id_array as $id) {
      $faculties[] = get_each_faculty_icons($id);
    }
    return $faculties;
  }
}
function get_each_faculty_icons ($id, $get_image = false) {

  if ($get_image == false) {
    $icon_normal = get_option('faculty_'.$id.'_icon_normal');
    $icon_hover = get_option('faculty_'.$id.'_icon_hover');
    $icon_color = get_option('faculty_'.$id.'_icon_color');
  } else {
    $icon_normal = wp_get_attachment_image(get_option('faculty_'.$id.'_icon_normal'), 'full');
    $icon_hover = wp_get_attachment_image(get_option('faculty_'.$id.'_icon_hover'), 'full');
    $icon_color = wp_get_attachment_image(get_option('faculty_'.$id.'_icon_color'), 'full');
  }

  $term = get_term($id);
  $title = $term->name;
  $slug = $term->slug;
  $link = get_permalink(get_page_by_path('degrees-and-programmes', OBJECT, 'academic')->ID).'?faculty='.$id.'#degree';

  $faculty = array( 'id' => $id,
                    'icon_normal' => $icon_normal,
                    'icon_hover' => $icon_hover,
                    'icon_color' => $icon_color,
                    'title' => $title,
                    'slug'  => $slug,
                    'link' => $link);
  return $faculty;
}
function get_faculty_info_template ($faculty_id) {
  include(locate_template('/template-parts/page_faculty_info.php'));
}


function return_icon_html ($faculty_array, $title) {

  if (!empty($faculty_array)) {
    $output = '';
    $output .= '<div class="container-blue">';
    $output .= '<h3 class="center-align text-blue">'.ucwords($title).'</h3>';
    $output .= '<div class="row mmu-icon-grids">';

    foreach ($faculty_array as $faculty) {
      $output.= '<div class="col s6 m4 l3">
                  <a class="" href="'.$faculty['link'].'">
                    <div class="mmu-icon-wrapper">
                      <div class="mmu-icon">
                        '.wp_get_attachment_image($faculty['icon_normal'], 'full', '', array('class' => 'mmu-icon-normal')).'
                        '.wp_get_attachment_image($faculty['icon_hover'], 'full', '' , array('class' => 'mmu-icon-hover')).'
                      </div>
                    </div>
                    <div class="mmu-icon-text">'.$faculty['title'].'</div>
                  </a>
                </div>';
    }
    $output .= '</div>'; //End row
    $output .= '</div>'; //End container
    
    return $output;
  }
}



/**
 * Add Materialize Video Container for Responsive Videos
 **/
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}


/**
 * Get slider content from Repeater Field
 **/
function get_slider_content($post_id){
  $content = array();
  for($i=0; $i<get_meta($post_id, 'carousel'); $i++){
    $string = 'carousel_'.$i.'_';
    $slider_title = get_meta($post_id, $string.'title');
    $slider_link = get_meta($post_id, $string.'link');
    $slider_textarea = get_meta($post_id, $string.'textarea');
    $slider_image = wp_get_attachment_url(get_meta($post_id, $string.'image'));

    $content[] = array( 'title'     => $slider_title,
                        'link'      => $slider_link,
                        'text'      => $slider_textarea,
                        'image'     => $slider_image);
  }

  return $content;
}

function get_latest_news_events($posts_per_page) {
  $args = array(
    'posts_per_page'  => $posts_per_page,
    'orderby'         => 'date',
    'order'           => 'DESC',
    'post_type'       => array('news','events'),
    'tax_query' => array(
      array(
        'taxonomy' => 'news_category',
        'field'    => 'slug',
        'terms'    => 'ccu',
      ),
    ),
    'post_status'     => 'publish',
  );
  return get_posts($args);
}

/**
 * Disable permalink edit for faculty (post type) and faculty_admins
 **/
function hide_slug_box() {
    global $post;
    global $pagenow;

    if (!current_user_can('administrator') && ($pagenow=='post-new.php' OR $pagenow=='post.php') && $post->post_type=='faculty') {
        echo '<style type="text/css">
                #edit-slug-box { display: none }
              </style>';
    }
}
add_action( 'admin_head', 'hide_slug_box' );


function array_count_value_by_key($array, $match_key, $match) {
  $count = 0;

  foreach($array as $value){
    if ($value[$match_key] == $match) {
      $count++;
    }
  }
  return $count;
}


/**
 * Add all CPT into search
 **/
function my_cptui_add_post_type_to_search( $query ) {
  if ( $query->is_search ) {
    $cptui_post_types = cptui_get_post_type_slugs();
    $query->set(
      'post_type',
      array_merge(
        array( 'post' ), // May also want to add the "page" post type.
        $cptui_post_types
      )
    );
  }
}
add_filter( 'pre_get_posts', 'my_cptui_add_post_type_to_search' );



/**
 * Include ACF fields into search
 **/

/**
 * [list_searcheable_acf list all the custom fields we want to include in our search query]
 * @return [array] [list of custom fields]
 */
function list_searcheable_acf(){
  $list_searcheable_acf = array("desc");
  return $list_searcheable_acf;
}
/**
 * [advanced_custom_search search that encompasses ACF/advanced custom fields and taxonomies and split expression before request]
 * @param  [query-part/string]      $where    [the initial "where" part of the search query]
 * @param  [object]                 $wp_query []
 * @return [query-part/string]      $where    [the "where" part of the search query as we customized]
 * see https://vzurczak.wordpress.com/2013/06/15/extend-the-default-wordpress-search/
 * credits to Vincent Zurczak for the base query structure/spliting tags section
 */
function advanced_custom_search( $where, &$wp_query ) {
    global $wpdb;

    $prefix = $wpdb->prefix;
 
    if ( empty( $where ))
        return $where;
 
    // get search expression
    $terms = $wp_query->query_vars[ 's' ];
    
    // explode search expression to get search terms
    $exploded = explode( ' ', $terms );
    if( $exploded === FALSE || count( $exploded ) == 0 )
        $exploded = array( 0 => $terms );
         
    // reset search in order to rebuilt it as we whish
    $where = '';
    
    // get searcheable_acf, a list of advanced custom fields you want to search content in
    $list_searcheable_acf = list_searcheable_acf();
    foreach( $exploded as $tag ) :
        $where .= " 
          AND (
            (".$prefix."posts.post_title LIKE '%$tag%')
            OR (".$prefix."posts.post_content LIKE '%$tag%')
            OR EXISTS (
              SELECT * FROM ".$prefix."postmeta
                WHERE post_id = ".$prefix."posts.ID
                  AND (";
        foreach ($list_searcheable_acf as $searcheable_acf) :
          if ($searcheable_acf == $list_searcheable_acf[0]):
            $where .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
          else :
            $where .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
          endif;
        endforeach;
          $where .= ")
            )
            OR EXISTS (
              SELECT * FROM ".$prefix."comments
              WHERE comment_post_ID = ".$prefix."posts.ID
                AND comment_content LIKE '%$tag%'
            )
            OR EXISTS (
              SELECT * FROM ".$prefix."terms
              INNER JOIN ".$prefix."term_taxonomy
                ON ".$prefix."term_taxonomy.term_id = ".$prefix."terms.term_id
              INNER JOIN ".$prefix."term_relationships
                ON ".$prefix."term_relationships.term_taxonomy_id = ".$prefix."term_taxonomy.term_taxonomy_id
              WHERE (
              taxonomy = 'post_tag'
                OR taxonomy = 'category'              
                OR taxonomy = 'myCustomTax'
              )
                AND object_id = ".$prefix."posts.ID
                AND ".$prefix."terms.name LIKE '%$tag%'
            )
        )";
    endforeach;
    return $where;
}
add_filter( 'posts_search', 'advanced_custom_search', 500, 2 );


