<?php
/*
Template Name: Campus Life > Clubs & Societies (Page)
*/
get_header(); 
global $post;

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
<script> var $templateDir = "<?php bloginfo('template_directory') ?>"; //Important</script>

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
          <div class="divider"></div>
        </section>

        <section class="sect-council">
          <div class="container center-align">
            <div>
              <?php echo wp_get_attachment_image(get_meta($post->ID, 'council_icon_color'), 'full') ?>
              <h3><?php _e('Student\'s Representative Council', 'multimedia') ?></h3>
              <?php echo mmuautop(get_meta($post->ID, 'council')); ?>
            </div>
            <div class="divider"></div>
          </div>
        </section>

        <section class="sect-latestevents">
          <div class="container center-align">
              <div>
                <?php echo wp_get_attachment_image(get_meta($post->ID, 'events_icon_color'), 'full') ?>
                <h3><?php _e('Latest Events', 'multimedia') ?></h3>
              </div>

              <?php $args = array(
                  'posts_per_page'  => 3,
                  'tax_query'       => array(
                                         array(
                                           'taxonomy'  => 'news_category',
                                           'field'     => 'id',
                                           'terms'     => get_meta($post->ID, 'events'),
                                         ),
                                       ),
                  'orderby'         => 'date',
                  'order'           => 'DESC',
                  'post_type'       => 'events',
                  'post_status'     => 'publish',
                );
              $events = get_posts( $args );  ?>
              <div class="row">
                <?php foreach ($events as $post): setup_postdata($post); ?>
                  <?php 
                    $thumbnail_url = get_the_post_thumbnail_url($post, 'medium_large');

                    $start_date = new DateTime(get_meta($post->ID, 'start_date'));
                    $start_date = $start_date->format('M d, Y');

                    $end_date = new DateTime(get_meta($post->ID, 'end_date'));
                    $end_date = $end_date->format('M d, Y');
                   ?>
                  <div class="col s12 m6 l4 event-list margin-xs">
                      <div class="event-image" style="background-image: url(<?php echo $thumbnail_url ?>)"></div>
                      <div class="event-details">
                        <h6><?php echo get_the_title() ?></h6>
                        <div><?php echo $start_date .' - '. $end_date ?></div>
                        <div><?php echo get_meta($post->ID, 'venue') ?></div>
                        <div><?php echo get_meta($post->ID, 'organizer') ?></div>
                      </div>
                  </div>
                <?php endforeach; wp_reset_postdata(); ?>
              </div>
              <div class="divider"></div>
          </div>
      </section>

      <section>
        <div class="container center-align">
          <div>
            <?php echo wp_get_attachment_image(get_meta($post->ID, 'campus_icon_color'), 'full') ?>
            <h3><?php _e('Campuses', 'multimedia') ?></h3>
          </div>
        </div>

        <div class="row first-tab">
          <div class="col s12 m8 offset-m2 l6 offset-l3">
            <ul class="tabs mmu-icon-tabs">
              <?php echo get_tab_list_template($icons_array); ?>
            </ul>
          </div>

          <!-- Course Contents -->
          <div class="tab-content">

            <div id="<?php echo $icon_1['slug'] ?>">
              <div class="margin-xs container">
                <div class="col s12"><?php echo mmuautop(get_meta($post->ID, 'cyberjaya')); ?></div>
              </div>
            </div>

            <div id="<?php echo $icon_2['slug'] ?>">
              <div class="margin-xs container">
                <div class="col s12"><?php echo mmuautop(get_meta($post->ID, 'melaka')); ?></div>
              </div>
            </div>

            <div id="<?php echo $icon_3['slug'] ?>">
              <div class="margin-xs container ">
                <div class="col s12"><?php echo mmuautop(get_meta($post->ID, 'nusajaya')); ?></div>
              </div>
            </div>

          </div>
        </div>
      </section>

      <section>
        <div class="container center-align">
          <?php echo wp_get_attachment_image(get_meta($post->ID, 'gallery_icon_color'), 'full') ?>
          <h3><?php _e('Gallery', 'multimedia') ?></h3>
          <?php $gallery = (get_meta($post->ID, 'gallery')) ?>

          <div class="row col1-carousel col1-carousel-slick">
            <?php foreach($gallery as $img): ?>
              <div class="col s12 carousel-item">
                <img src="<?php echo wp_get_attachment_url($img, 'full') ?>">
              </div>
           <?php endforeach; ?>
          </div>

          <?php if(!empty(get_meta($post->ID, 'gallery_more'))): ?>
            <a class="waves-effect waves-light btn mmublue margin-s" href="<?php echo get_meta($post->ID, 'gallery_more') ?>" target="_blank"><?php _e('View More Photos','multimedia') ?></a>
          <?php endif; ?>
        </div>
      </section>

      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
