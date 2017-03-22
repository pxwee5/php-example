<?php
/*
Template Name: Academics > Programs > Types > Postgraduate > Courses (Page)
*/

get_header(); 

//$fields = get_fields();
$metas = get_post_meta($post->ID);

//Important Constants. Do not change title and link.
$icons_array = array();
$research_icon = array( 'normal'  => '<img src="'.get_template_directory_uri().'/assets/img/icons/academic/postgraduate/research_grey.png" class="mmu-icon-normal" />', 
                        'hover'   => '<img src="'.get_template_directory_uri().'/assets/img/icons/academic/postgraduate/research_white.png" class="mmu-icon-hover" />',
                        'title'   => 'By Research', 
                        'slug'    => 'research',
                        'link'    => '#research',
                        'active'  => '');
                      
$coursework_icon = array( 'normal'  => '<img src="'.get_template_directory_uri().'/assets/img/icons/academic/postgraduate/coursework_grey.png" class="mmu-icon-normal" />', 
                          'hover'   => '<img src="'.get_template_directory_uri().'/assets/img/icons/academic/postgraduate/coursework_white.png" class="mmu-icon-hover" />',
                          'title'   => 'By Coursework', 
                          'slug'    => 'coursework',
                          'link'    => '#coursework',
                          'active'  => '');

$mixedmode_icon = array('normal'  => '<img src="'.get_template_directory_uri().'/assets/img/icons/academic/postgraduate/mixedmode_grey.png" class="mmu-icon-normal" />', 
                        'hover'   => '<img src="'.get_template_directory_uri().'/assets/img/icons/academic/postgraduate/mixedmode_white.png" class="mmu-icon-hover" />',
                        'title'   => 'By Mixed Mode', 
                        'slug'    => 'mixedmode',
                        'link'    => '#mixedmode',
                        'active'  => '');

if (get_meta($post->ID, 'research_boolean') == 1) array_push ($icons_array, $research_icon);
if (get_meta($post->ID, 'coursework_boolean') == 1) array_push ($icons_array, $coursework_icon);
if (get_meta($post->ID, 'mixedmode_boolean') == 1) array_push ($icons_array, $mixedmode_icon);


?>

<div id="primary" class="content-area is-course">
  <main id="main" class="site-main" role="main">
  <?php get_template_part( '/template-parts/academic_banner'); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
      <!-- FIRST TAB -->
      <div class="row first-tab">
        <div class="container">
          <ul class="mmu-icon-tabs" > <!-- Removed .tab to disable tabbing function. -->
            <!-- Program Links-->
            <?php $programs = query_posts_from_taxonomy_category('academic_cat', 'academic-programs', 100, 'menu_order', 'ASC'); ?>
            <?php $academic_icons_array = get_tab_list($programs, '', TRUE) ?>
            <?php echo get_tab_list_template($academic_icons_array, TRUE); ?>

          </ul>
        </div>

        <div class="col tab-content">
          <div class="container">
          
            <section id="program-info" class="">
              <?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
              <?php include(locate_template('/template-parts/page_info.php')); ?>
            </section>

            <!-- SECOND TAB -->
            <div class="second-tab">

              <div class="col s12 m10 offset-m1">
                <ul class="tabs mmu-icon-tabs" > <!-- Removed .tab to disable tabbing function. -->
                  <?php foreach ($icons_array as $icon) { include(locate_template('/template-parts/course_tab_list.php')); } ?> 
                </ul>
              </div>

              <div class="col tab-content">
                <?php foreach ($icons_array as $content): ?>
                <?php $requirement_details = array() ?>
                  <div id="<?php echo $content['slug'] ?>" class="program-tab-content">
                    <section id="program_desc">
                      <h2><?php echo ($content['slug'] == 'research') ? __('Fields of Research:', 'multimedia') : __('Available Programmes:', 'multimedia'); ?></h2>
                      <?php echo mmuautop(get_meta($post->ID, $content['slug'].'_desc')); ?>
                    </section>

                    <section id="program_req">
                      <h2><?php _e('Entry Requirements:', 'multimedia'); ?></h2>
                      <?php $requirement_details = get_postgraduate_req($post->ID, $content); ?>
                      <?php include(locate_template('/template-parts/postgraduate_requirements.php')); ?>
                    </section>
                  </div>
                <?php endforeach; ?>
              </div>

            </div>
            

            <section id="back-button" class="center-align">
              <?php echo make_course_back_button($post->post_type, $post) ?>
            </section>

          </div>
        </div>

      </div>

    

    </article><!-- #post-## -->

  </main><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
