<?php
/*
Template Name: Admission > International Students > Studying in Malaysia (Page)
*/
$parent_url = get_permalink( $post->post_parent );
$hash = combine($post->post_name);
wp_redirect( $parent_url.'#'.$hash, 301 ); 
exit();
?>