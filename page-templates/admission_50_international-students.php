<?php
/*
Template Name: Admission > International Students (Page)
*/

get_header(); 


?>
<?php $abouts = query_posts_by_post_type($post->post_type, $post->ID); ?>
<?php $percentage = 100/(count($abouts)+1); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="row first-tab">
        <div class="container">

         <div class="col with-dropdown-icon" style="width: <?php echo $percentage * count($abouts) ?>%;">
            <ul class="tabs mmu-icon-tabs">
              <!-- About Malaysia Icons -->
              <?php $icons_array = get_tab_list($abouts, '') ?>
              <?php echo get_tab_list_template($icons_array); ?>
            </ul>
        </div>

          <div class="col the-dropdown-icon" style="width: <?php echo $percentage ?>%;"> <!-- Important: Do not change class -->
            <div class="tab mmu-icon-lists info-pdf dropdown-button" data-activates="info-pdf">
                <a href="" class="prevent-default">
                  <div class="mmu-icon-wrapper">
                    <div class="mmu-icon">
                      <img width="150" height="150" src="<?php echo get_template_directory_uri().'/assets/img/icons/international-students/info_grey.png' ?>" class="mmu-icon-normal">
                      <img width="150" height="150" src="<?php echo get_template_directory_uri().'/assets/img/icons/international-students/info_white.png' ?>" class="mmu-icon-hover">
                    </div>
                  </div>
                  <div class="mmu-icon-text"><?php _e('Download University Overview', 'multimedia') ?></div>
                </a>
              
          
              <!-- Dropdown Items -->
              <?php if (!empty(get_meta($post->ID, 'overview'))): ?>
                <ul id="info-pdf" class="dropdown-content overview-dropdown arrow-with-border" >
                  <?php for ($i=0; $i<get_meta($post->ID, 'overview'); $i++): ?>
                    <?php 
                      $string = 'overview_'.$i.'_';
                      $url = wp_get_attachment_url(get_meta($post->ID, $string.'file'));
                      $title = get_meta($post->ID, $string.'title');
                     ?>
                    <li><a href="<?php echo $url ?>" target="_blank"><?php echo $title ?></a></li>
                  <?php endfor; ?>
                </ul>
              <?php endif; ?>
            </div>
          </div> 

        </div>

        <!-- Course Contents -->
        <div class="tab-content">
          <?php foreach ($abouts as $item): ?>
            <div id="<?php echo combine($item->post_name) ?>" class="container">
              <?php 
                if ($item->post_name == 'about-malaysia') {
                  include(locate_template('/template-parts/intlstudent_about_malaysia.php'));
                } else if ($item->post_name == 'entering-malaysia') {
                  include(locate_template('/template-parts/intlstudent_entering_malaysia.php'));
                } else if ($item->post_name == 'studying-in-malaysia') {
                  include(locate_template('/template-parts/intlstudent_studying_in_malaysia.php'));
                } else if ($item->post_name == 'cost-of-living') {
                  include(locate_template('/template-parts/intlstudent_cost_of_living.php'));
                } else {

                }
              ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    

    


    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
