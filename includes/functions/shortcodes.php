<?php 

/**
 * Register Short Code. 
 **/

//create function to register shortcode
function register_shortcodes(){
   /*add_shortcode( 'exchange_program_intake', 'exchange_program_intake_function' );*/
   add_shortcode( 'exchange_program_faculty', 'exchange_program_faculty_function' );
   add_shortcode( 'dropdown_programs', 'dropdown_programs_function' );
   add_shortcode( 'video_slider', 'video_slider_function' );
   add_shortcode( 'campus_life', 'campus_life_function' );
}
// hook register function into wordpress init
add_action( 'init', 'register_shortcodes');

function exchange_program_faculty_function( $atts ){
  $output = '';
  if (!empty($atts)){
    $cyberjaya  = get_meta($atts['id'], 'cyberjaya_faculties');
    $melaka     = get_meta($atts['id'], 'melaka_faculties');
    $nusajaya   = get_meta($atts['id'], 'nusajaya_faculties');  

    $campus_array = array('cyberjaya' => $cyberjaya, 
                          'melaka'    => $melaka, 
                          'nusajaya'  => $nusajaya);

    foreach ($campus_array as $key => $campus) {
      $faculty_array = get_faculty_icons($campus);
      $output .= return_icon_html($faculty_array, $key);
    }
    return $output;
    
  }
}

/**
 * Create dropdown for programs
 **/
function dropdown_programs_function(){
  $queries = query_posts_from_taxonomy_category('academic_cat', 'academic-programs', '', 'menu_order', 'ASC');

  $output = '<a class="mmublue waves-effect waves-light btn dropdown-btn" data-activates="dropdown-programs">'.__('What\'s Your Interest', 'multimedia').'</a>';
  $output .= '<ul id="dropdown-programs" class="dropdown-content">';
  foreach ($queries as $program) {
    $output .= '<li><a href="'.get_permalink(get_page_by_path('degrees-and-programmes', OBJECT, 'academic')->ID).'#'.strtolower(combine($program->post_title)).'">'.$program->post_title.'</a></li>';
  }
  $output .= '</ul>';
   
  return $output;
}


/**
 * Creates a Slider of YouTube Videos
 **/
function video_slider_function( $atts ){
  $output = '';
  $post_id = $atts['id'];
  if (!empty(get_meta($post_id, 'video'))){
   
    $output = '<div class="slider video-slider"><ul class="slides">';
    for($i=0; $i<get_meta($post_id, 'video'); $i++) {
      $output .=  '<li class="video">';
      $output .=    '<a href="'. get_meta($post_id, 'video_'.$i.'_url') .'">';
      $output .=      '<button class="ytp-large-play-button ytp-button" aria-label="Watch Centre for Diploma Programmes"><svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%"><path class="ytp-large-play-button-bg" d="m .66,37.62 c 0,0 .66,4.70 2.70,6.77 2.58,2.71 5.98,2.63 7.49,2.91 5.43,.52 23.10,.68 23.12,.68 .00,-1.3e-5 14.29,-0.02 23.81,-0.71 1.32,-0.15 4.22,-0.17 6.81,-2.89 2.03,-2.07 2.70,-6.77 2.70,-6.77 0,0 .67,-5.52 .67,-11.04 l 0,-5.17 c 0,-5.52 -0.67,-11.04 -0.67,-11.04 0,0 -0.66,-4.70 -2.70,-6.77 C 62.03,.86 59.13,.84 57.80,.69 48.28,0 34.00,0 34.00,0 33.97,0 19.69,0 10.18,.69 8.85,.84 5.95,.86 3.36,3.58 1.32,5.65 .66,10.35 .66,10.35 c 0,0 -0.55,4.50 -0.66,9.45 l 0,8.36 c .10,4.94 .66,9.45 .66,9.45 z" fill="#1f1f1e" fill-opacity="0.81"></path><path d="m 26.96,13.67 18.37,9.62 -18.37,9.55 -0.00,-19.17 z" fill="#fff"></path><path d="M 45.02,23.46 45.32,23.28 26.96,13.67 43.32,24.34 45.02,23.46 z" fill="#ccc"></path></svg></button>';
      $output .=    '</a>';
      $output .=  '</li>';
    }
    $output .= '</ul>';
    $output .= '<span class="video-prev dashicons dashicons-arrow-left-alt2"></span><span class="video-next dashicons dashicons-arrow-right-alt2"></span>';
    $output .= '</div>';

    return $output;
  }
}

/**
 * Creates 3 columns (or more) of Campus Life Links
 **/
function campus_life_function( $atts ){
  $output = '';
  $post_id = $atts['id'];

  if (!empty(get_meta($post_id, 'campus_life'))){

    $output .= '<div class="row square-box">';
      for ($i=0; $i<get_meta($post_id, 'campus_life'); $i++){
        $string = 'campus_life_'.$i.'_';
        $output .= '<div class="col s12 m4"><div class="box-wrapper"><div class="box-content">';
        $output .= '<div class="box-icon">'. wp_get_attachment_image(get_meta($post_id, $string.'icon'), 'full') .'</div>';
        $output .= '<div class="box-title">'. get_meta($post_id, $string.'title') .'</div>';
        $output .= '</div><div class="box-hover">';
        $output .= ' <div class="box-desc">'. get_meta($post_id, $string.'desc').'</div>';
        $output .= '<div class="box-link">';
        $output .= '<a href="'.get_permalink(get_meta($post_id, $string.'link')) .'">'.get_meta($post_id, $string.'title') .'</div></a>';
        $output .= '</div></div></div>';
        }
    $output .= '</div>';
    return $output;
  }

}