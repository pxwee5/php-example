<?php
/*
Template Name: R&D > About (Page)
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

      <section class="blue-bg padding-s margin-xboth">
        <div class="container">
          <div class="page-info">
            <div class="page-info-image center-align"><?php echo wp_get_attachment_image(get_meta($post->ID, 'mgmt_icon_color'), 'full') ?></div>
            <h2 class="page-info-title center-align"><?php echo get_meta($post->ID, 'mgmt_title') ?></h2>
          </div>

          <?php if (!empty($mgmt_team = get_meta($post->ID, 'mgmt_team'))): ?>
            <div class="row">
              <?php for ($i=0; $i<$mgmt_team; $i++): ?>
                <?php $string = 'mgmt_team_'.$i.'_'; ?>
                <div class="col s12 m4 mmu-card">
                  <div class="card-container match-height">
                    <div class="card-image"><?php echo wp_get_attachment_image(get_meta($post->ID, $string.'image'), 'full') ?></div>
                    <div class="card-desc"><?php echo get_meta($post->ID, $string.'desc'); ?></div>
                  </div>
                </div>
              <?php endfor; ?>
            </div>
          <?php endif; ?>

        </div>
      </section>

      <section class="dark-blue-bg padding-s text-white margin-xboth small-text">
        <div class="container">
          <?php echo mmuautop(get_meta($post->ID, 'contact_us')) ?>
        </div>
      </section>
      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
