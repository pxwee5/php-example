<?php


// init process for registering our button
add_action('init', 'mmu_editor_buttons_init');

function mmu_editor_buttons_init() {
  //Abort early if the user will never see TinyMCE
/*  if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
       return;*/

  //Add a callback to regiser our tinymce plugin   
  add_filter("mce_external_plugins", "mmu_register_tinymce_plugin"); 

  // Add a callback to add our button to the TinyMCE toolbar
  add_filter('mce_buttons_2', 'mmu_add_tinymce_button');
}


//This callback registers our plug-in
function mmu_register_tinymce_plugin($plugin_array) {
    $plugin_array['mmu_column2_button'] = get_template_directory_uri().'/assets/tinymce/column_2.js';
    $plugin_array['mmu_column3_button'] = get_template_directory_uri().'/assets/tinymce/column_3.js';
    return $plugin_array;
}

//This callback adds our button to the toolbar
function mmu_add_tinymce_button($buttons) {
    //Add the button ID to the $button array
    $buttons[] = "mmu_column2_button";
    $buttons[] = "mmu_column3_button";
    return $buttons;
}

/* Add Buttons into mce_buttons */
add_filter( 'mce_buttons', 'fb_mce_editor_buttons' );
function fb_mce_editor_buttons( $buttons ) {
  array_push( $buttons, 'styleselect' );
  return $buttons;
}


/* Add Buttons into mce_buttons_2 */
/*add_filter( 'mce_buttons_2', 'fb_mce_editor_buttons_2' );
function fb_mce_editor_buttons_2( $buttons ) {
  array_push( $buttons, 'hr' );
  return $buttons;
}*/


/**
 * Add styles/classes to the "Styles" drop-down
 */ 
add_filter( 'tiny_mce_before_init', 'mmu_mce_before_init' );
function mmu_mce_before_init( $settings ) {

  $style_formats = array(
    array(
      'title' => 'Container Text',
      'block' => 'div',
      'classes' => 'container-text',
      'wrapper' => true,
    ),
    array(
      'title' => 'Border Image',
      'selector' => 'img',
      'classes' => 'bordered',
      'wrapper' => false,
    ),
    array(
      'title' => 'Text Styles',
      'items' => array(
        array(
          'title' => 'Black',
          'inline' => 'span',
          'classes' => 'text-black',
        ),
        array(
          'title' => 'Blue Text',
          'inline' => 'span',
          'classes' => 'text-blue',
        ),
        array(
          'title' => 'Red Text',
          'inline' => 'span',
          'classes' => 'text-red',
        ),
        array(
          'title' => 'Big Text (5x)',
          'inline' => 'span',
          'classes' => 'big-text',
        ),
        /*array(
          'title' => 'White Text',
          'inline' => 'span',
          'classes' => 'text-white',
        ),*/
      ),
    ),
   
    array(
      'title' => 'Text Columns (Pick 1 Only)',
      'items' => array(
        array(
          'title' => 'Columns 2',
          'selector' => 'p,div,ul,ol,span',
          'classes' => 'col-2',
          'wrapper' => false,
        ),
        array(
          'title' => 'Columns 3',
          'selector' => 'p,div,ul,ol,span',
          'classes' => 'col-3',
          'wrapper' => false,
        ),
        array(
          'title' => 'Columns 4',
          'selector' => 'p,div,ul,ol,span',
          'classes' => 'col-4',
          'wrapper' => false,
        ),
      )
    ),
    array(
      'title' => 'Button Links (Select Links)',
      'items' => array(
        array(
          'title' => 'Blue Buttons',
          'selector' => 'a',
          'classes' => 'mmublue waves-effect waves-light btn',
        ),
        array(
          'title' => 'White Buttons',
          'selector' => 'a',
          'classes' => 'mmuwhite waves-effect waves-light btn',
        ),
      ),
    ),
  );

  $settings['height'] = "250"; //Set Editor Height
  $settings['preview_styles'] = "font-family font-size font-weight font-style text-decoration text-transform color background-color border border-radius"; //Limit the following styles
  $settings['style_formats'] = json_encode( $style_formats );

  return $settings;
}