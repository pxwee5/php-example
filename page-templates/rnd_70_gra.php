<?php
/*
Template Name: R&D > Graduate Research Assistant (Page)
*/
get_header(); 
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      
      <section id="page-info">
        <div class="container">
        <?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
        <?php include(locate_template('/template-parts/page_info.php')); ?>
        </div>
      </section>
      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
