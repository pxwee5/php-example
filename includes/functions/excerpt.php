<?php 

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return ' ... ';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
/*function wpdocs_excerpt_more( $more ) {
  var_dump(get_the_ID());
  var_dump($more);
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>', 
      get_permalink( get_the_ID() ), 
      __(' ...<br>Read More', 'multimedia'));
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );*/

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );