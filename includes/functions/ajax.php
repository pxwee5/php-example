<?php 



/*
* Ajax function to get Academic Calendar 
*/
add_action('wp_ajax_getAcademicCalendar', 'getAcademicCalendar');
add_action('wp_ajax_nopriv_getAcademicCalendar', 'getAcademicCalendar');
function getAcademicCalendar() {
  $get_string = $_GET['filter_array'];
  $options_array = json_decode(str_replace("\\" , "", $get_string));
  $file = '';
  $table = '';

  $query = query_posts_from_taxonomy_category('calendar_filter', $options_array, 1);

  if (!empty($query[0])) {
    $table['table'] = json_decode(get_meta($query[0]->ID, 'table'), TRUE);
    $file = get_meta($query[0]->ID, 'file');
    $table['file'] = wp_get_attachment_url($file);
    $output = json_encode($table);
  } else {
    $output = json_encode ('');
  }

  die($output);
}

/*
* Ajax function to get Staff Directory JSON files from MMU Expert RESTAPI
*/
add_action('wp_ajax_getStaffJSON', 'getStaffJSON');
add_action('wp_ajax_nopriv_getStaffJSON', 'getStaffJSON');
function getStaffJSON() {
  //$get_string = $_GET['url'];
  $json_url = $_GET['json_url'];
  $output = (file_get_contents($json_url));

  die($output);
}

/*
* Ajax function to load Degree Lists in the Academic > Degree
*/
add_action('wp_ajax_getDegreeByFaculty', 'getDegreeByFaculty');
add_action('wp_ajax_nopriv_getDegreeByFaculty', 'getDegreeByFaculty');
function getDegreeByFaculty() {

  $faculty_id = $_GET['faculty_id'];
  $output = array();


  $args = array(
    'posts_per_page'   => 1000,
    'tax_query'        => array(
                            array(
                              'taxonomy'  => 'faculty',
                              'field'     => 'id',
                              'terms'     => $faculty_id,
                            ),
                          ),
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => 'degree',
    'post_status'      => 'publish',
  );
  $courses = get_posts( $args ); 

  foreach ($courses as $course) {
    $output['degree'][] = get_program_courses($course);
  }
  $output['faculty'] = get_each_faculty_icons($faculty_id, true);

  $faculty_page = get_page_by_path(get_term_by('id', $faculty_id, 'faculty')->slug, OBJECT, 'faculty');

  if (!empty($faculty_page)){
    $faculty_permalink = get_permalink($faculty_page->ID);
    $output['faculty_url'] = make_blue_btn($faculty_permalink, sprintf(__('Know More About %s', 'multimedia'), $faculty_page->post_title));
  } else {
    $output['faculty_url'] = '';
  }

  $output = json_encode($output);
  die($output);
}

/*
* Ajax function to load Research Centres by Faculty
*/
add_action('wp_ajax_getResearchCentresByFaculty', 'getResearchCentresByFaculty');
add_action('wp_ajax_nopriv_getResearchCentresByFaculty', 'getResearchCentresByFaculty');
function getResearchCentresByFaculty() {
  global $post;
  $faculty_id = $_GET['faculty_id'];
  $output = array();


  $args = array(
    'posts_per_page'   => 1000,
    'tax_query'        => array(
                            array(
                              'taxonomy'  => 'faculty',
                              'field'     => 'id',
                              'terms'     => $faculty_id,
                            ),
                          ),
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => 'research_centres',
    'post_status'      => 'publish',
  );
  $research_centres = get_posts( $args ); 

  foreach ($research_centres as $post) {
    setup_postdata($post);
    $output['research_centres'][] = array('title'     => get_the_title(),
                                          'content'   => mmuautop(get_the_excerpt()),
                                          'pic_name'  => get_meta($post->ID, 'pic_name'),
                                          'pic_email' => get_meta($post->ID, 'pic_email'));
  }
  wp_reset_postdata();

  $output['faculty'] = get_each_faculty_icons($faculty_id, true);

  $output = json_encode($output);
  die($output);
}

/*
* Ajax function to Load More Awards
*/
add_action('wp_ajax_getLoadMore', 'getLoadMore');
add_action('wp_ajax_nopriv_getLoadMore', 'getLoadMore');
function getLoadMore() {

  global $post;
  $json = $_GET['encoded_json'];
  $json = json_decode(str_replace("\\" , "", $json), TRUE);
  $output = '';

  if (!empty($json['taxonomy']) && !empty($json['term_id'])) {
    $query = $query = query_award_pages($json['ppp'], $json['post_type'], $json['page'], $json['year'], $json['taxonomy'], $json['term_id']);
  } else {
    $query = query_award_pages($json['ppp'], $json['post_type'], $json['page'], $json['year']);
  }
  

  if (!empty($query)){
    foreach ($query as $post){
      setup_postdata($post);
      $thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'medium_large');
      $title = get_the_title();
      $excerpt = get_the_excerpt();
      $read_more = '<a class="read-more" href="'.get_permalink( get_the_ID() ).'" title="'.$title.'">'.__('Continue Reading', 'multimedia').'</a>';

      $output .= '<div class="col s12 m6 l4 margin-xs">';
      $output .= '  <div class="thumbnail" style="background-image: url('. $thumbnail .')"></div>';
      $output .= '    <h3 class="title">'. $title .'</h3>';
      $output .= '    <div class="excerpt">' . $excerpt . $read_more;
      $output .= '  </div>';
      $output .= '</div>';
    }
    wp_reset_postdata();
  }
  die($output);
}

/*
* Ajax function to load News by Month & Category
*/
add_action('wp_ajax_getNewsEvents', 'getNewsEvents');
add_action('wp_ajax_nopriv_getNewsEvents', 'getNewsEvents');
function getNewsEvents() {
  global $post;

  $date = new DateTime($_GET['month']);
  $category = $_GET['category'];
  $post_type = $_GET['post_type'];
  $output = array();

  $args = array(
    'posts_per_page'  => 30,
    'date_query'      => array(
                          'year'  => $date->format('Y'),
                          'month' => $date->format('m'),
                          ),
    'orderby'         => 'date',
    'order'           => 'DESC',
    'post_type'       => $post_type,
    'post_status'     => 'publish',
  );
  if ($category != 'all') {
    $args['tax_query'] = array(array(
                             'taxonomy'  => 'news_category',
                             'field'     => 'id',
                             'terms'     => $category,
                           ));
  }

  $news_events = get_posts( $args ); 

  if (!empty($news_events)){
    foreach ($news_events as $post) {
      setup_postdata($post);

      $start_date = new DateTime(get_meta($post->ID, 'start_date'));
      $start_date = $start_date->format('M d, Y');

      $end_date = new DateTime(get_meta($post->ID, 'end_date'));
      $end_date = $end_date->format('M d, Y');

      $thumbnail_url = get_the_post_thumbnail_url('', 'medium_large');

      $output[] = array('title'         => get_the_title(),
                        'thumbnail_url' => (!empty($thumbnail_url)) ? $thumbnail_url : '',
                        'permalink'     => get_the_permalink(),
                        'category'      => wp_get_post_terms($post->ID, 'news_category')[0]->name, //1 category only
                        'date'          => get_the_date('M d, Y'),
                        'excerpt'       => get_the_excerpt(),
                        'start_date'    => $start_date,
                        'end_date'      => $end_date,
                        'time'          => get_meta($post->ID, 'time'),
                        'venue'         => get_meta($post->ID, 'venue'),
                        'organizer'     => get_meta($post->ID, 'organizer'),
                        );
    }
    wp_reset_postdata();
  }

  $output = json_encode($output);

  die($output);
}
