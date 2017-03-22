<?php
/*
Template Name: Page > Personality Test
*/

get_header(); 
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- Edit this file to implement personality test. File in /multimedia/page-templates/page_personality.php -->
    <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="container">

          <div class="entry-content">
            <?php
            the_content();

            wp_link_pages( array(
              'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'multimedia' ) . '</span>',
              'after'       => '</div>',
              'link_before' => '<span>',
              'link_after'  => '</span>',
              'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'multimedia' ) . ' </span>%',
              'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
            ?>
          </div><!-- .entry-content -->

        </div>

      </article><!-- #post-## -->
    <?php endwhile; ?>


  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
