<?php
/*
Template Name: Campus Life > Accommodation (Page)
*/
get_header(); 

$icon_1 = array('normal'  => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/icons/campus/cyberjaya_grey.png" class="mmu-icon-normal" alt="Cyberjaya Icon" />',
                'hover'   => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/icons/campus/cyberjaya_white.png" class="mmu-icon-hover" alt="Cyberjaya Icon" />',
                'title'   => 'Cyberjaya',
                'slug'    => 'cyberjaya',
                'link'    => '#cyberjaya',
                'active'  => '');
$icon_2 = array('normal'  => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/icons/campus/melaka_grey.png" class="mmu-icon-normal" alt="Melaka Icon" />',
                'hover'   => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/icons/campus/melaka_white.png" class="mmu-icon-hover" alt="Melaka Icon" />',
                'title'   => 'Melaka', 
                'slug'    => 'melaka', 
                'link'    => '#melaka',
                'active'  => '');
$icon_3 = array('normal'  => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/icons/campus/nusajaya_grey.png" class="mmu-icon-normal" alt="Nusajaya Icon" />',
                'hover'   => '<img width="150" height="150" src="'.get_template_directory_uri().'/assets/img/icons/campus/nusajaya_white.png" class="mmu-icon-hover" alt="Nusajaya Icon" />',
                'title'   => 'Nusajaya', 
                'slug'    => 'nusajaya', 
                'link'    => '#nusajaya',
                'active'  => '');
$icons_array = array($icon_1, $icon_2, $icon_3);
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="row first-tab">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
          <ul class="tabs mmu-icon-tabs">
            <?php echo get_tab_list_template($icons_array); ?>
          </ul>
        </div>

        <!-- Course Contents -->
        <div class="tab-content">

          <!-- Cyberjaya CONTENTS -->
          <?php foreach ($icons_array as $campus): ?>
            <div id="<?php echo $campus['slug']; ?>" class="container">
              <div class="row margin-xbottom">

                <div class="col s12 m6">
                  <div class="simple-tables row">
                    <div class="thead center-align">
                      <div class="title"><?php _e('On-Campus', 'multimedia') ?></div>
                    </div>
                    <div class="tbody">
                      <div class="small-text match-height col s12">
                        <?php echo mmuautop(get_meta($post->ID, $campus['slug'].'_on_campus')) ?>
                        <!-- Gallery -->
                        <?php $gallery = get_meta($post->ID, $campus['slug'].'_on_campus_gallery'); ?>
                        <?php if (!empty($gallery)): ?>
                          <div class="row accommodation-gallery">
                            <?php foreach($gallery as $image): ?>
                              <a class="col s6 l3" href="<?php echo wp_get_attachment_url($image, 'full'); ?>">
                                <?php echo wp_get_attachment_image($image, 'thumbnail'); ?>  
                              </a>
                            <?php endforeach; ?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col s12 m6">
                  <div class="simple-tables row">
                    <div class="thead center-align">
                      <div class="title"><?php _e('Off-Campus', 'multimedia') ?></div>
                    </div>
                    <div class="tbody">
                      <div class="small-text match-height col s12">
                        <?php echo mmuautop(get_meta($post->ID, $campus['slug'].'_off_campus')) ?>
                        <!-- Gallery -->
                        <?php $gallery = get_meta($post->ID, $campus['slug'].'_off_campus_gallery'); ?>
                        <?php if (!empty($gallery)): ?>
                          <div class="row accommodation-gallery">
                            <?php foreach($gallery as $image): ?>
                              <a class="col s6 l3" href="<?php echo wp_get_attachment_url($image, 'full'); ?>">
                                <?php echo wp_get_attachment_image($image, 'thumbnail'); ?>  
                              </a>
                            <?php endforeach; ?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <?php if (!empty($checking_file = get_meta($post->ID, $campus['slug'].'_check_in_file'))): ?>
                <h6>
                  <a href="<?php echo wp_get_attachment_url($checking_file); ?>" title="" class="">
                    <?php echo get_meta($post->ID, $campus['slug'].'_check_in_title'); ?>
                  </a>
                </h6>
              <?php endif; ?>
            </div>  

          <?php endforeach; ?>
        </div>
      </div>

    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
