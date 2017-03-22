<?php
/*
Template Name: Admission > Accreditation (Page)
*/
get_header();
?>
<?php $empty_icon = array('normal'  => '<img src="'.get_template_directory_uri().'/assets/img/icons/empty_icon.png" class="mmu-icon-normal"/>',
                          'hover'   => '<img src="'.get_template_directory_uri().'/assets/img/icons/empty_icon.png" class="mmu-icon-hover"/>'); ?>

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

      <div class="row first-tab">
        <div class="container">
          <ul class="tabs mmu-icon-tabs">
            <!-- Program Links-->
            <?php $contents = query_posts_by_post_type('admission', $post->ID); ?>
            <?php $icons_array = get_tab_list($contents, '') ?>
            <?php echo get_tab_list_template($icons_array); ?>
          </ul>
        </div>

        <!-- Course Contents -->
        <div class="tab-content">
          <?php foreach ($contents as $key => $content): ?>
            <div id="<?php echo clean($icons_array[$key]['link']) ?>">
              <div class="container">
                <section>
                  <h2 class="center-align"><?php echo get_meta($content->ID, 'secondary_title') ?></h2>
                  <?php echo mmuautop(get_meta($content->ID, 'desc')) ?>
                </section>

                
                <?php if(get_meta($content->ID, 'attachment') > 0): ?>
                  <section>
                    <h2 class="center-align"><?php echo get_meta($content->ID, 'attachment_title') ?></h2>
                      <div class="container">
                        <div class="row">
                          <?php for ($i=0; $i<get_meta($content->ID, 'attachment'); $i++): ?>
                          <?php 
                            $string = 'attachment_'.$i.'_';
                            $link = wp_get_attachment_url(get_meta($content->ID, $string.'file'));
                            $icon_normal = wp_get_attachment_image(get_meta($content->ID, $string.'icon_normal'), 'full', '', array('class' => 'mmu-icon-normal'));
                            $icon_hover = wp_get_attachment_image(get_meta($content->ID, $string.'icon_hover'), 'full', '', array('class' => 'mmu-icon-hover'));
                            $title = get_meta($content->ID, $string.'title');
                          ?>
                        
                          <div class="col s4 m4 l4">
                            <div class="mmu-icon-lists">
                              <a href="<?php echo $link ?>" target="_blank">
                                <div class="mmu-icon-wrapper">
                                  <div class="mmu-icon">
                                    <?php echo (!empty($icon_normal)) ? $icon_normal : $empty_icon['normal']; ?>
                                    <?php echo (!empty($icon_hover)) ? $icon_hover : $empty_icon['hover']; ?>
                                  </div>
                                </div>
                                <div class="mmu-icon-text"><?php echo $title; ?></div>
                              </a>
                            </div>
                          </div>
                        <?php endfor; ?>
                      </div>
                    </div>
                  </section>
                <?php endif; ?>
                
              </div>

              <?php if ($footer_desc = mmuautop(get_meta($content->ID, 'footer_desc'))): ?>
                <div class="footer padding-s">
                  <div class="container">
                    <?php echo $footer_desc; ?>
                  </div>
                </div>
              <?php endif; ?>

            </div>
          <?php endforeach; ?>
        </div>
      </div>


    </article><!-- #post-## -->

  </main><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
