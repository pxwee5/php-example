<?php
/*
Template Name: Campus Life > Exchange Programme > In/Outbound (Inner)
*/
$parent_url = get_permalink( $post->post_parent );
$hash = combine($post->post_name);
wp_redirect( $parent_url.'#'.$hash, 301 ); 
exit();
?>