<?php


/*
* Create MMU News and Events Menu Item
*/
function mmu_create_news_and_events() {

  $page_title = "News &amp; Events";
  $menu_title = "News &amp; Events";
  $capability = "view_news_events_menu";
  $menu_slug  = "edit.php?post_type=news";
  $function   = "";
  $icon_url   = 'dashicons-feedback';
  $position   = 178;

  //Add Parent Menus
  add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);

  $submenu_pages = array(
    //edit.php 
    array(
      'parent_slug'   => 'edit.php?post_type=news',
      'page_title'    => 'All News',
      'menu_title'    => 'All News',
      'capability'    => 'edit_newss',
      'menu_slug'     => 'edit.php?post_type=news',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
    array(
      'parent_slug'   => 'edit.php?post_type=news',
      'page_title'    => 'All Events',
      'menu_title'    => 'All Events',
      'capability'    => 'edit_eventss',
      'menu_slug'     => 'edit.php?post_type=events',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
    //post-new.php HIDDEN
    array(
      'parent_slug'   => 'null', //Don't display on menu
      'page_title'    => 'Add News',
      'menu_title'    => 'Add News',
      'capability'    => 'create_newss',
      'menu_slug'     => 'post-new.php?post_type=news',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
    array(
      'parent_slug'   => 'null', //Don't display on menu
      'page_title'    => 'Add Events',
      'menu_title'    => 'Add Events',
      'capability'    => 'create_eventss',
      'menu_slug'     => 'post-new.php?post_type=events',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
    //Taxonomy
    array(
      'parent_slug'   => 'edit.php?post_type=news',
      'page_title'    => 'News &amp; Events Category',
      'menu_title'    => 'News &amp; Events Category',
      'capability'    => 'manage_categories',
      'menu_slug'     => 'edit-tags.php?taxonomy=news_category',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
  );

  // Add each submenu item to custom admin menu.
  foreach($submenu_pages as $submenu){
    add_submenu_page(
      $submenu['parent_slug'],
      $submenu['page_title'],
      $submenu['menu_title'],
      $submenu['capability'],
      $submenu['menu_slug'],
      $submenu['function']
    );
  }
}
add_action('admin_menu', 'mmu_create_news_and_events');

/*
* Create MMU News and Events Menu Item
*/
function mmu_create_programmes_menu() {

  $page_title = "Programmes";
  $menu_title = "Programmes";
  $capability = "view_programmes_menu";
  $menu_slug  = "edit.php?post_type=foundation";
  $function   = "";
  $icon_url   = 'dashicons-welcome-learn-more';
  $position   = 168;

  //Add Parent Menus
  add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);

  $submenu_pages = array(
    //Edit.php
    array(
      'parent_slug'   => 'edit.php?post_type=foundation',
      'page_title'    => 'Foundation',
      'menu_title'    => 'Foundation',
      'capability'    => 'edit_foundations',
      'menu_slug'     => 'edit.php?post_type=foundation',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
    array(
      'parent_slug'   => 'edit.php?post_type=foundation',
      'page_title'    => 'Diploma',
      'menu_title'    => 'Diploma',
      'capability'    => 'edit_diplomas',
      'menu_slug'     => 'edit.php?post_type=diploma',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
      array(
      'parent_slug'   => 'edit.php?post_type=foundation',
      'page_title'    => 'Degree',
      'menu_title'    => 'Degree',
      'capability'    => 'edit_degrees',
      'menu_slug'     => 'edit.php?post_type=degree',
      'function'      => null,// Uses the same callback function as parent menu. 
    ), 
    array(
      'parent_slug'   => 'edit.php?post_type=foundation',
      'page_title'    => 'Postgraduate',
      'menu_title'    => 'Postgraduate',
      'capability'    => 'edit_postgraduates',
      'menu_slug'     => 'edit.php?post_type=postgraduate',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
    array(
      'parent_slug'   => 'edit.php?post_type=foundation',
      'page_title'    => 'Distance Education',
      'menu_title'    => 'Distance Education',
      'capability'    => 'edit_distance-educations',
      'menu_slug'     => 'edit.php?post_type=distance-education',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),

    //post-new (HIDDEN)
    array(
      'parent_slug'   => 'null',
      'page_title'    => 'Foundation',
      'menu_title'    => 'Foundation',
      'capability'    => 'create_foundations',
      'menu_slug'     => 'post-new.php?post_type=foundation',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
    array(
      'parent_slug'   => 'null',
      'page_title'    => 'Diploma',
      'menu_title'    => 'Diploma',
      'capability'    => 'create_diplomas',
      'menu_slug'     => 'post-new.php?post_type=diploma',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
      array(
      'parent_slug'   => 'null',
      'page_title'    => 'Degree',
      'menu_title'    => 'Degree',
      'capability'    => 'create_degrees',
      'menu_slug'     => 'post-new.php?post_type=degree',
      'function'      => null,// Uses the same callback function as parent menu. 
    ), 
    array(
      'parent_slug'   => 'null',
      'page_title'    => 'Postgraduate',
      'menu_title'    => 'Postgraduate',
      'capability'    => 'create_postgraduates',
      'menu_slug'     => 'post-new.php?post_type=postgraduate',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
    array(
      'parent_slug'   => 'null',
      'page_title'    => 'Distance Education',
      'menu_title'    => 'Distance Education',
      'capability'    => 'create_distance-educations',
      'menu_slug'     => 'post-new.php?post_type=distance-education',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),

    //Taxonomy
    array(
      'parent_slug'   => 'edit.php?post_type=foundation',
      'page_title'    => 'Faculty Categories',
      'menu_title'    => 'Faculty Categories',
      'capability'    => 'manage_categories',
      'menu_slug'     => 'edit-tags.php?taxonomy=faculty',
      'function'      => null,// Uses the same callback function as parent menu. 
    ),
  );

  // Add each submenu item to custom admin menu.
  foreach($submenu_pages as $submenu){
    add_submenu_page(
      $submenu['parent_slug'],
      $submenu['page_title'],
      $submenu['menu_title'],
      $submenu['capability'],
      $submenu['menu_slug'],
      $submenu['function']
    );
  }
}
add_action('admin_menu', 'mmu_create_programmes_menu');



/*
* Do not display Category Meta Box
* Doc: https://github.com/WebDevStudios/custom-post-type-ui/blob/master/custom-post-type-ui.php#L512-L522
*/
function mmu_hide_faculty($args, $taxonomy){
  if ($taxonomy == 'faculty' || $taxonomy == 'news_category'){
    $args['meta_box_cb'] = false;
  }
  
  return $args;
}
add_filter( 'cptui_pre_register_taxonomy', 'mmu_hide_faculty', 10,2);