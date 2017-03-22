<?php
/*
Template Name: R&D > Publication (Page)
*/
get_header(); 

if (!empty($tabs = get_meta($post->ID, 'display_tabs'))){
  foreach ($tabs as $tab) {
    $tab_icon = array('normal'  => wp_get_attachment_image(get_meta($post->ID, $tab.'_icon_normal'), 'full','', array('class' => 'mmu-icon-normal')), 
                      'hover'   => wp_get_attachment_image(get_meta($post->ID, $tab.'_icon_hover'), 'full','', array('class' => 'mmu-icon-hover')),
                      'title'   => ucwords($tab), 
                      'slug'    => $tab, 
                      'link'    => '#'.$tab,
                      'active'  => '');

    $icons_array[] = $tab_icon;
  }
}
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if (!empty($icons_array)): ?>
    <div class="row first-tab">
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <ul class="tabs mmu-icon-tabs" >
          <?php get_tab_list_template($icons_array); ?>
        </ul>
      </div>
    
      <div class="tab-content">
      <?php foreach ($icons_array as $tab): ?>
        <div id="<?php echo $tab['slug'] ?>">
          <section class="page-info">
            <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, $tab['slug'].'_icon_color'), 'full') ?></div> 
            <h2 class="page-info-title"><?php echo ucwords(get_meta($post->ID, $tab['slug'].'_title')) ?></h2>
          </section>

          <section>
            <div class="container">
              <?php $files = get_meta($post->ID, $tab['slug'].'_files') ?>
              <?php if (!empty($files)): ?>
                <ul class="file-list">
                <?php for ($i=0; $i<$files; $i++): ?>
                  <?php 
                    $string = $tab['slug'].'_files_'.$i.'_'; 
                    $url = wp_get_attachment_url(get_meta($post->ID, $string.'file'));
                    $title = get_meta($post->ID, $string.'title');

                  ?>

                  <li><a href="<?php echo $url ?>" title="<?php echo $title ?>"><?php echo $title ?></a></li>
                <?php endfor; ?>
                </ul>
              <?php endif; ?>
            </div>
          </section>



        </div>
      <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

      

      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
