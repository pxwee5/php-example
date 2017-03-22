<?php 

/**
 * Wordpress get_posts() for taxonomy category
 * @example how-to-apply
 * @return Array of posts
 **/
function query_posts_from_taxonomy_category($taxonomy_slug, $category_slug, $number = 100, $orderby = 'menu_order', $order = 'ASC'){
	$args = array(
    'posts_per_page'   => $number,
    'offset'           => 0,
    'tax_query'        => array(
                            array(
                              'taxonomy' 	=> $taxonomy_slug,
                              'field'    	=> 'slug',
                              'terms'    	=> $category_slug,
                              'operator' 	=> 'AND',
                            ),
                          ),
    'orderby'          => $orderby,
    'order'            => $order,
    'post_type'        => '',
    'post_status'      => 'publish',
    'suppress_filters' => true 
  );
  $postslist = get_posts( $args ); 

  return $postslist;
}

/**
 * 
 * @
 * @example 
 * @return 
 **/

function get_tab_list($queries, $location = '', $for_course_page = FALSE){
	$output = array();
	$program_type_array = explode("/", $_SERVER['REQUEST_URI']);
	$academic_page_id = get_page_by_path('degrees-and-programmes', OBJECT, 'academic')->ID;
	$active = '';
	// $empty_icon = '<img src="'.get_template_directory_uri().'/assets/img/icons/empty_icon.png" />';
	
	if ($location == 'intl'){
		$location = 'intl-';
	} else if($location == 'local'){
		$location = 'local-';
	}

	foreach ($queries as $query) {

		$icon_normal = wp_get_attachment_image(get_meta($query->ID, 'icon_normal'), 'full', '', array('class' => 'mmu-icon-normal'));
		$icon_hover = wp_get_attachment_image(get_meta($query->ID, 'icon_hover'), 'full','', array('class' => 'mmu-icon-hover'));
		$icon_color = wp_get_attachment_image(get_meta($query->ID, 'icon_color'), 'full','', array('class' => 'mmu-icon-hover'));
		$program_name = $query->post_title;
		$slug = $query->post_name;
		$program_id_link = '#'.$location . str_replace("-", "", $query->post_name);
		$logo = get_meta($query->ID, 'icon_bool');

		if ($for_course_page == FALSE){ //If page is not Program > Courses
			$active = '';
			$program_id_link = '#'.$location . str_replace("-", "", $query->post_name);
		
		} elseif ($for_course_page == TRUE) { //If page is Program > Courses
			$program_id_link = get_permalink($academic_page_id).'#'.combine($query->post_name);


			foreach($program_type_array as $program_type){
				if (clean($program_type) == clean($query->post_name)) {
					$active = 'active';
					break;
				} else {
					$active = '';
				}
			}
		}


		$icon_info = array( 'normal'	=> $icon_normal,
												'hover' 	=> $icon_hover,
												'color'		=> $icon_color,
												'title'		=> $program_name,
												'slug' 		=> $slug,
												'link' 		=> $program_id_link,
												'active'	=> $active,
												'logo'		=> $logo);

		array_push($output, $icon_info);

	}
	return $output;
}


/**
 * Queries all "Course Requirements" and returns an array
 * @example how-to-apply
 * @return array with ['intl_requirements'] or ['local_requirements']
 **/
function query_requirement_list($location, $program_slug){

	$queries = query_posts_from_taxonomy_category('requirement_cat', $program_slug, 100,'menu_order', 'ASC');
	$requirement_array = array();

	foreach($queries as $key => $query){
		$requirements = get_post_meta($query->ID, '', true);
		$intl_req_array = get_requirement_data($query->ID, $location, $program_slug);
		$requirement_array[] =  $intl_req_array;
	}
	return $requirement_array;
}

/**
 * 
 * 
 * @example 
 * @return 
 **/
function get_requirement_data($req_id, $location, $program_slug){

	global $mmu_eng_text;
	$req_array = array();

	$req_boolean = get_meta($req_id, $location.'_boolean');
	$eng_boolean = get_meta($req_id, $location.'_eng_boolean');

	if ($req_boolean == 1){
		$req = get_meta($req_id, $location.'_requirements');

		//Add english requirement link and find position to add it in. 
		if ($eng_boolean == 1){
			$anchor_link = get_permalink(get_page_by_path('how-to-apply', OBJECT, 'admission')->ID).'#'.$location.'-'.str_replace("-", "", $program_slug).'-requirements';
			$eng_req_anchor_li = '<li><a href="'.$anchor_link.'"/>'.$mmu_eng_text.'</a></li>';
			$end_ul_pos = strrpos($req, '</ul>');

			$req = substr_replace($req, $eng_req_anchor_li, $end_ul_pos, 0);
		}

		$title = get_the_title($req_id);
		$course_id = get_meta($req_id, $location.'_courses');
		$icon_id = (!empty($course_id)) ? get_meta($course_id[0], 'icon_color') : '' ;
		$data_id = $location.'-'.$req_id;

		$req_array = array('title'			=> $title,
											 'image_id' 	=> $icon_id,
											 'course_id'	=> $course_id,
											 'content' 		=> mmuautop($req),
											 'data_id'		=> $data_id);
	} 
	return $req_array;
}

/**
 * Gets HTML of "Course Requirements"
 * Shows logo, location text and description
 * @example how-to-apply
 * @return $ouput contains HTML
 **/
/*function get_requirements($location, $program){
	$output = '';
	$req_link ='';
	$req_list = '';
	$loop = 0;

	if ($location == 'intl'){
		$req_key = 'intl_requirements';
	} else if($location == 'local'){
		$req_key = 'local_requirements';
	}

	//$program_reqs = query_requirement_list($program);

	foreach ($program_reqs[$req_key] as $req){
		if (!empty($req)){
			$req_link .= '<h3>';

			foreach($req['course_id'] as $course_id){
				$degree_label = get_post_meta($course_id, 'degree_label');

				if (isset($degree_label)) {
					$course_long_title = implode($degree_label).' '.get_the_title($course_id);
				} else {
					$course_long_title = get_the_title($course_id);
				}
				$course_short_title = get_the_title($course_id);

				$req_link .= '<div>'.$course_long_title.'</div>';
				$req_list .= '<li><a href="'.get_permalink($course_id).'">'.$course_short_title.'</a></li>';
			}
			$req_link .= '</h3>';

			$req_image = $req['image'];
			$req_content = $req['requirements'];
			$req_id = 'requirement-'.$location.'-'.$req['ID'];

			$output .= '<div class="req row s12">
										<div class="req-logo col m2">'.$req_image.'</div>
										<div class="req-desc col m7">'.$req_link.$req_content.'</div>
										<div class="req-link col m3 center-align">
											<a class="dropdown-button btn waves-effect waves-light" data-activates="'.$req_id.'"><span>Find Out More</span><span class="dashicons dashicons-menu"></span></a>	
											<ul id="'.$req_id.'" class="dropdown-content">'.$req_list.'</ul>
										</div>
									</div>';
		}
			
		$loop++;
	}
	return $output;
}*/
function get_requirements($location, $program){
	if ($location == 'intl'){
		$req_key = 'intl_requirements';
	} else if($location == 'local'){
		$req_key = 'local_requirements';
	}

	$program_reqs = query_requirement_list($location, $program);

	return $program_reqs;
}
/**
 * Gets HTML of "Application Steps" for styling
 * @example how-to-apply
 * @return $ouput contains HTML
 **/
/*function get_application_steps($post_metas, $program){
	$steps_output = '';
	$steps_count = 1;

	$steps_output .= '<div class="application-steps">';
	foreach ($post_metas as $key => $field){	
		$string = '/^app_steps_intl_'.$program.'_\d+_steps/'; //Repeated steps in database 
		if (preg_match($string, $key)){
			$steps_output .= '<div class="col s12 steps-wrapper">
													<div class="steps-desc">'.mmuautop(implode($field)).'</div>
													<span class="steps-number">'.$steps_count.'</span>
												</div>';
			$steps_count++;
		}
		
	}
	$steps_output .= '</div>';

	return $steps_output;
}*/
function get_application_steps($post_id, $location, $program_slug){
	$steps_key = 'app_steps_'.$location.'_'.$program_slug;
	$steps_count = get_meta($post_id, $steps_key);
	$steps_array = array();

	for($i=0; $i<$steps_count; $i++){
		$step = mmuautop(get_meta($post_id, $steps_key.'_'.$i.'_steps'));
		$steps_array[] = $step;
	}

	return $steps_array;
}

/**
 * Displays "Course Requirements", "English Requirements" and "Application Steps" in how-to-apply
 * @example how-to-apply
 * @return $ouput contains HTML
 **/
/*function get_tab_content($page_metas, $location, $program){
	$tab_content = '';

	if (isset($page_metas["eng_req_".$location."_".$program])){
		$eng_req = $page_metas["eng_req_".$location."_".$program];
		$eng_req = mmuautop(implode($eng_req));
	}
	$tab_content .= '<div id="'.$location.'-'.str_replace("-", "", $program).'" class="program-tab-content col s12">';
	$tab_content .= get_requirements($location, $program);

	if (isset($page_metas["eng_req_".$location."_".$program])){
		$tab_content .= '<div id="'.$location.'-'.str_replace("-", "", $program).'-requirements" class="eng-req">'.$eng_req.'</div>';
	}
	$tab_content .= get_application_steps($page_metas, $program);
	$tab_content .= '</div>';

	return $tab_content;
}*/

function get_tab_contents($post_id, $location, $programs){
	foreach ($programs as $program) {
		$eng_req_key = 'eng_req_'.$location.'_'.$program->post_name; //eg. eng_req_intl_degree

		$eng_req = mmuautop(get_meta($post_id, $eng_req_key));
		$tab_content_id = $location.'-'.str_replace("-", "", $program->post_name);
		$eng_req_id = $tab_content_id.'-requirements';

		$requirements = get_requirements($location, $program->post_name);

		$steps = get_application_steps($post_id, $location, $program->post_name);

		//CONTINUE HERE
		$output[] = array('program'				=> $program->post_name,
											'tab_id'				=> $tab_content_id,
											'eng_req_id'		=> $eng_req_id,
											'eng_req'				=> $eng_req,
											'requirements'	=> $requirements,
											'steps'					=> $steps);
	}
	return $output;
}

/**
 * Displays the colored icon and brief description
 * Shows logo, location text and description
 * When Location is set
 * @example how-to-apply, courses
 * @return $ouput contains HTML
 **/
function get_academic_page_info($page_metas, $title='', $location='' ) {
	$output = '';
	
	if ($location != '') {
		$location = '_'.$location;
		$desc = mmuautop(implode($page_metas['desc'.$location]));
	} else {
		$desc = mmuautop(implode($page_metas['course_desc']));
	}

	$image = wp_get_attachment_image(implode($page_metas['icon_color'.$location]), 'full', '', array('class' => 'page-info-image'));
	

	$output .= '<section id="course-info" class="row">';
	$output .= '	<div class="page-info">';
	$output .= '		<div class="page-info-image">'.$image.'</div>';
	$output .= '			<h2 class="page-info-title">'.$title.'</h2>';
	$output .= '		<div class="page-info-desc">'.$desc.'</div>';
	$output .= '	</div>';
	$output .= '</section>';

	return $output;
}

function get_page_info($id, $title='', $location='' ) {
	$output = array();

	if ($location != '') {
		$location = '_'.$location;
		$desc = mmuautop(get_meta($id, 'desc'.$location));
	} else {
		$desc = mmuautop(get_meta($id, 'desc'));
	}
	$title2 = get_meta($id, 'secondary_title');
	$reg_number = get_meta($id, 'reg_number');
	$image = wp_get_attachment_image(get_meta($id, 'icon_color'.$location), 'full', '', array('class' => 'page-info-image'));

	$output = array('desc'				=> $desc,
									'reg_number'	=> $reg_number,
									'title'				=> $title,
									'title2'			=> $title2,
									'image'				=> $image);

	return $output;
}

function get_tab_list_template ($icons, $for_course_page = FALSE){
	foreach ($icons as $icon) { 
		include(locate_template('/template-parts/course_tab_list.php')); 
	}

	if ($for_course_page == TRUE){
		echo '<div class="indicator"></div>';
	}
}

function get_template_parts_using_array ($arrays, $template_file){
	foreach ($arrays as $array) {
		include(locate_template('/template-parts/'.$template_file)); 
	}
}

function get_table_template ($table, $classes = '') {
	include(locate_template('/template-parts/table.php'));
}
function get_gallery_template ($gallery_array, $classes = 'col s6 m4 l3') {
	include(locate_template('/template-parts/gallery.php'));
}