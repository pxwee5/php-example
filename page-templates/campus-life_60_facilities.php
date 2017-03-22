<?php
/*
Template Name: Campus Life > Facilities (Page)
*/
get_header(); 
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <section>
        <div class="container">
          <?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
          <?php include(locate_template('/template-parts/page_info.php')); ?>
        </div>
      </section>

      <section class="container">
        <?php $gallery = get_meta($post->ID, 'gallery'); ?>
        <?php if (!empty($gallery)): ?>
          <div class="row facilities-gallery">
            <?php foreach ($gallery as $image): ?>
              <?php $img = get_post($image); ?>
              <div class="col s12 m6 l4 match-height">
                <a href="<?php echo wp_get_attachment_url($image, 'full') ?>" title="<?php echo $img->post_title ?>" alt="<?php echo $img->post_excerpt ?>">
                  <?php echo wp_get_attachment_image($image, 'medium_large'); ?>
                </a>
                <h6><?php echo $img->post_title ?></h6>
                <span><?php echo $img->post_excerpt ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </section>
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
