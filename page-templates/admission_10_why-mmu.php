<?php
/*
Template Name: Admission > Why MMU (Page)
*/
get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="container">
        <section id="why-mmu-features" class="row">
          <?php for ($i=0;$i<get_meta($post->ID, 'features');$i++): ?>
            <?php 
              $title = get_meta($post->ID, 'features_'.$i.'_title');
              $image = wp_get_attachment_image(get_meta($post->ID, 'features_'.$i.'_image'), 'full');
              $desc = mmuautop(get_meta($post->ID, 'features_'.$i.'_desc'));
            ?>
            <div class="simple-tables col s12 m6">
              <!-- <div class="thead center-align"></div> -->
              <div class="tbody">
                <div class="details center-align">
                  <div class="image"><?php echo $image ?></div>
                  <div class="col s12">
                    <div class="title"><h4 class="text-blue"><?php echo $title ?></h4></div>
                    <div class="desc"><?php echo $desc ?></div>
                  </div>
                </div>
                
              </div>
            </div>

          <?php endfor; ?>

          
          <?php if (!empty($additional_features = get_meta($post->ID, 'additional_features'))): ?>
            <?php foreach ($additional_features as $id): ?>
              <div class="simple-tables col s12 m6">
                <!-- <div class="thead center-align"></div> -->
                <div class="tbody">
                  <div class="details center-align">
                    <div class="image"><?php echo wp_get_attachment_image(get_meta($id, 'excerpt_image'), 'full') ?></div>
                    <div class="col s12">
                      <div class="title"><h4 class="text-blue"><?php echo get_meta($id, 'secondary_title') ?></h4></div>
                      <div class="desc-with-button">
                        <?php echo get_meta($id, 'excerpt') ?>
                        <?php echo make_blue_btn(get_permalink($id) , __('Know More', 'multimedia'), FALSE ) ?>
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </section>

      </div>


    </article><!-- #post-## -->

  </main><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
