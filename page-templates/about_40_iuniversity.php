<?php
/*
Template Name: About > i-University (Page)
*/
get_header(); 
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      
      <section id="i-university">
        <div class="container">
          <?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
          <?php include(locate_template('/template-parts/page_info.php')); ?>

          <div class="row">
            <div class="col s12 m6">
              <div class="container-text match-height">
                <div class="col s4 l3"><?php echo wp_get_attachment_image(get_meta($post->ID, 'feature_icon_1'), 'full'); ?></div>
                <div class="col s8 l9"><?php echo mmuautop(get_meta($post->ID, 'feature_desc_1')); ?></div>
              </div>
            </div>

            <div class="col s12 m6">
              <div class="container-text match-height">
                <div class="col s4 l3"><?php echo wp_get_attachment_image(get_meta($post->ID, 'feature_icon_2'), 'full'); ?></div>
                <div class="col s8 l9"><?php echo mmuautop(get_meta($post->ID, 'feature_desc_2')); ?></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="iuni-concept" class="blue-bg padding-s">
        <div class="container">
          <div class="page-info">
            <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, 'concept_icon'), 'full'); ?></div>
            <h2 class="page-info-title"><?php echo get_meta($post->ID, 'concept_title'); ?></h2>
            <div class="page-info-desc"><?php echo mmuautop(get_meta($post->ID, 'concept_desc')); ?></div>
          </div>

          <div class="row margin-xboth">
            <div class="col s12 m6">
              <div class="container-text match-height">
                <div class=""><?php echo mmuautop(get_meta($post->ID, 'vision')); ?></div>
              </div>
            </div>
            <div class="col s12 m6">
              <div class="container-text match-height">
                <div class=""><?php echo mmuautop(get_meta($post->ID, 'outcome')); ?></div>
              </div>
            </div>
          </div>

          <div class="container-text margin-xtop">
            <div class=""><?php echo mmuautop(get_meta($post->ID, 'objective')); ?></div>
          </div>

        </div>
      </section>

      <section id="iuni-framework">
        <div class="container">
          <div class="page-info">
            <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, 'framework_icon'), 'full'); ?></div>
            <h2 class="page-info-title"><?php echo get_meta($post->ID, 'framework_title'); ?></h2>
            <div class="page-info-desc"><?php echo mmuautop(get_meta($post->ID, 'framework_desc')); ?></div>
          </div>
        </div>
      </section>

      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
