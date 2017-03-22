<?php
/*
declared in core
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

  
          
*/