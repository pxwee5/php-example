<?php
/*
Template Name: About > Corporate Identity (Page)
*/
get_header(); 
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <section id="identity">
        <div class="container">
          <?php echo mmuautop(get_meta($post->ID, 'desc')); ?>

          <div class="row">
            <div class="col s12 m6 center-align">
              <?php echo wp_get_attachment_image(get_meta($post->ID, 'primary_logo'), 'full'); ?>
            </div>
            <div class="col s12 m6 center-align">
              <?php echo wp_get_attachment_image(get_meta($post->ID, 'secondary_logo'), 'full'); ?>
            </div>
          </div>

          <?php $table = json_decode(get_meta($post->ID, 'logo_specification'), true) ?>
          <?php include_table($table, 'layout-auto'); ?>

          <h2 class="center-align"><?php echo get_meta($post->ID, 'tagline_title') ?></h2>
          <div><?php echo get_meta($post->ID, 'tagline_desc') ?></div>

          <hr />

          <div class="page-info">
            <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, 'mascot_icon'), 'full'); ?></div>
            <h2 class="page-info-title"><?php echo get_meta($post->ID, 'mascot_title'); ?></h2>
            <div class="page-info-desc"><?php echo mmuautop(get_meta($post->ID, 'mascot_desc')); ?></div>
          </div>
        </div>

      </section>

      <section id="song" class="blue-bg padding-s">
        <div class="container">
          <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3 page-info">
              <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, 'song_icon'), 'full'); ?></div>
              <h2 class="page-info-title"><?php echo get_meta($post->ID, 'song_title'); ?></h2>
              <div class="page-info-desc"><?php echo mmuautop(get_meta($post->ID, 'song_desc')); ?></div>
            </div>
          </div>
        </div>
      </section>

      <section id="certificate">
        <div class="container">
          <div class="page-info">
            <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, 'cert_icon'), 'full'); ?></div>
            <h2 class="page-info-title"><?php echo get_meta($post->ID, 'cert_title'); ?></h2>
            <div class="page-info-desc"><?php echo mmuautop(get_meta($post->ID, 'cert_desc')); ?></div>
          </div>
        </div>
      </section>

      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
