<?php
/*
Template Name: Community > Business Support (Page)
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
$icons_array = array($icon_1, $icon_2);

?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <section id="page-info">
          <?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
          <?php include(locate_template('/template-parts/page_info.php')); ?>
        </section>

        <section>

          <ul class="collapsible" data-collapsible="accordion">
            <li class="active">
              <div class="collapsible-header active">
                <!-- <span class="collapsible-icon"></span> -->
                <span class="collapsible-title"><?php echo get_meta($post->ID, 'title_premises') ?></span>
                <span class="dashicons"></span>
              </div>
              <div class="collapsible-body">
                <div class="content">
                  <div class="margin-s"><?php echo mmuautop(get_meta($post->ID, 'desc_premises')) ?></div>
                
                  <div class="row second-tab">
                    <div class="col s12 m8 offset-m2">
                      <ul class="tabs mmu-icon-tabs" >
                        <?php get_tab_list_template($icons_array); ?>
                      </ul>
                    </div>
                  
                    <div class="col tab-content">

                      <div id="cyberjaya">
                        <div class="masonry">
                          <?php for($i=0; $i<get_meta($post->ID, 'premises_cyberjaya'); $i++): ?>
                            <?php 
                              $string = 'premises_cyberjaya_'.$i.'_';
                              $title = get_meta($post->ID, $string.'title');
                              $table = json_decode(get_meta($post->ID, $string.'table'), TRUE);
                            ?>
                            <div class="masonry-item">
                              <div><?php echo $title ?></div>
                              <div><?php get_table_template($table, 'compact') ?></div>
                            </div>
                          <?php endfor; ?>
                        </div>
                      </div>
                      <div id="melaka">
                        <div class="masonry">
                          <?php for($i=0; $i<get_meta($post->ID, 'premises_melaka'); $i++): ?>
                            <?php 
                              $string = 'premises_melaka_'.$i.'_';
                              $title = get_meta($post->ID, $string.'title');
                              $table = json_decode(get_meta($post->ID, $string.'table'), TRUE);
                            ?>
                            <div class="masonry-item">
                              <div><?php echo $title ?></div>
                              <div><?php get_table_template($table, 'compact') ?></div>
                            </div>
                          <?php endfor; ?>
                        </div>
                      </div>
                    </div>
                  </div> <!-- !Business Premises Tabs -->
                </div>
              </div>
            </li>

            <?php if (!empty(get_meta($post->ID, 'collapsible'))): ?>
              <?php for ($i=0; $i<get_meta($post->ID, 'collapsible'); $i++): ?>
                <?php 
                  $string = 'collapsible_'.$i.'_';
                  $title = get_meta($post->ID, $string.'title');
                  $content_types = get_meta($post->ID, $string.'type');
                ?>
                <li>
                  <div class="collapsible-header">
                    <span class="collapsible-title"><?php echo $title ?></span>
                    <span class="dashicons"></span>
                  </div>
                  <div class="collapsible-body">
                    <div class="content">
                      <?php if ($content_types): ?>
                        <?php foreach ($content_types as $key => $type): ?>
                          <?php 
                            $meta_key = $string.'type_'.$key.'_'.$type;
                            $content = get_meta($post->ID, $meta_key);
                          ?>
                          <?php if ($type == 'text'): ?>
                            <div class="margin-s"><?php echo mmuautop($content) ?></div>
                          <?php elseif ($type == 'gallery'): ?>
                            <div class="margin-s"><?php get_gallery_template($content, 'col s6 m4 m4 match-height'); ?></div>
                          <?php elseif ($type == 'table'): ?>
                            <div class="margin-s"><?php get_table_template(json_decode($content, TRUE), 'compact') ?></div>
                          <?php else: ?>
                            <div class="margin-s"><?php echo mmuautop($content) ?></div>
                          <?php endif; ?>

                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </li>
              <?php endfor; ?>
            <?php endif; ?>

            <?php $form_icon = array('normal'  => '<img src="'.get_template_directory_uri().'/assets/img/icons/file_grey.png" class="mmu-icon-normal"/>',
                                     'hover'   => '<img src="'.get_template_directory_uri().'/assets/img/icons/file_white.png" class="mmu-icon-hover"/>'); ?>

            <li>
              <div class="collapsible-header">
                <span class="collapsible-title"><?php _e('Application Forms', 'multimedia') ?></span>
                <span class="dashicons"></span>
              </div>
              <div class="collapsible-body">
                <div class="content">
                  <div class="margin-s margin-xbottom center-align"><strong><?php echo get_meta($post->ID, 'form_text1') ?></strong></div>

                  <?php if (!empty(get_meta($post->ID, 'form'))): ?>
                    <div class="row">
                      <?php for($i=0; $i<get_meta($post->ID, 'form'); $i++): ?>
                        <?php 
                          $string = 'form_'.$i.'_';
                          $type = implode(get_meta($post->ID, $string.'type'));
                          if ($type == 'url') {
                            $url = get_meta($post->ID, $string.'type_0_'.$type);
                          } else if ($type == 'file') {
                            $url = wp_get_attachment_url(get_meta($post->ID, $string.'type_0_'.$type));
                          } else {
                            $url = get_meta($post->ID, $string.'type_0_'.$type);
                          }
                        ?>

                        <div class="col s6 m4 l2-4">
                          <div class="mmu-icon-lists">
                            <a href="<?php echo $url ?>" target="_blank">
                              <div class="mmu-icon-wrapper">
                                <div class="mmu-icon">
                                  <?php echo $form_icon['normal']; ?>
                                  <?php echo $form_icon['hover']; ?>
                                </div>
                              </div>
                              <div class="mmu-icon-text"><?php echo get_meta($post->ID, $string.'title') ?></div>
                            </a>
                          </div>
                        </div>
                      <?php endfor; ?>
                    </div>
                  <?php endif; ?>

                  <div class="center-align"><?php echo get_meta($post->ID, 'form_text2') ?></div>
                    <div class="row">
                      <div class="col s6 offset-s3 m4 offset-m4">
                        <div class="mmu-icon-lists">
                          <a href="<?php echo wp_get_attachment_url(get_meta($post->ID, 'complaint_form')) ?>" target="_blank">
                            <div class="mmu-icon-wrapper">
                              <div class="mmu-icon">
                                <?php echo $form_icon['normal']; ?>
                                <?php echo $form_icon['hover']; ?>
                              </div>
                            </div>
                            <div class="mmu-icon-text"><?php echo get_meta($post->ID, 'complaint_form_text') ?></div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </li>

          </ul>
        </section>
      </div>
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
