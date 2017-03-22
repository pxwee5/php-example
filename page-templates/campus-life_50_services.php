<?php
/*
Template Name: Campus Life > Services (Page)
*/
get_header(); 
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <?php $children = get_posts('posts_per_page=-1&post_parent='.$post->ID.'&post_status=published&post_type=campus-life&order_by=menu_order&order=ASC'); ?>
      <?php $icons_array = get_tab_list($children); ?>

      <div class="row first-tab">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
          <ul class="tabs mmu-icon-tabs">
            <?php echo get_tab_list_template($icons_array); ?>

          </ul>
        </div>

        <!-- Course Contents -->
        <div class="tab-content">

          <?php foreach ($children as $key => $child): ?>
            <div id="<?php echo combine($icons_array[$key]['slug']) ?>">

              <section>
                <div class="container">
                  <?php $page = get_page_info($child->ID, $child->post_title); //page_info.php dependency ?>
                  <?php include(locate_template('/template-parts/page_info.php')); ?>
                </div>
              </section>

              <section>
                <?php if ( preg_match('/(services.*insurance)/', get_meta($child->ID, '_wp_page_template')) ): ?>
                  <div class="container"><?php include(locate_template('/template-parts/services_insurance.php')); ?></div>
                <?php elseif ( preg_match('/(services.*welfare)/', get_meta($child->ID, '_wp_page_template')) ): ?>
                  <div class="container"><?php include(locate_template('/template-parts/services_welfare.php')) ?></div>
                <?php else: ?>
                  <div class="container"><?php include(locate_template('/template-parts/services_others.php')) ?></div>
                <?php endif; ?>
              </section>
               
            </div>
          <?php endforeach; ?>

        </div>
      </div>
      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
