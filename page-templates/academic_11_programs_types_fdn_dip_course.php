<?php
/*
Template Name: Academics > Programs > Types > Foundation/Diploma > Courses (Page)
*/

get_header(); 

$page_metas = get_post_meta($post->ID, '', true);
?>

<div id="primary" class="content-area is-course">
  <main id="main" class="site-main" role="main">
    <?php get_template_part( '/template-parts/academic_banner'); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      

      <div class="row first-tab">
        <div class="container">
          <ul class="mmu-icon-tabs" > <!-- Removed .tab to disable tabbing function. -->
            <!-- Program Links-->
            <?php $programs = query_posts_from_taxonomy_category('academic_cat', 'academic-programs', 100, 'menu_order', 'ASC'); ?>
            <?php $icons_array = get_tab_list($programs, '', TRUE) ?>
            <?php echo get_tab_list_template($icons_array, TRUE); ?>
          </ul>
        </div>
        <!-- Course Contents -->
        <div class="tab-content">
          <div class="container">
            <?php 
              //Initialize Variables
              $program_structure_url = wp_get_attachment_url( get_meta($post->ID, 'program_structure_link' ));
              $duration = implode($page_metas['course_duration']);
              $fees = get_permalink(implode($page_metas['course_fees_page_id']));
              $location = implode($page_metas['course_location']);
              $apply_now_link = get_permalink(implode($page_metas['apply_now_page_id']));
            ?>

            <!-- Course Description -->
            <section id="program-info" class="">
              <?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
              <?php include(locate_template('/template-parts/page_info.php')); ?>

              <div class="center-align">
                <?php echo make_blue_btn($program_structure_url, __('View Programme Structure', 'multimedia'), TRUE) ?>
              </div>
            </section>

            <section id="course-details">
              <div class="row s12 circle-col-3">
                <div class="container">
                  <div class="col s4 box">
                    <div class="content">
                      <span class="content-inner tooltipped" data-position="bottom" data-delay="0" data-tooltip="<?php echo $duration ?>">
                        <h6>Duration</h6>
                      </span>
                    </div>
                  </div>
                  <div class="col s4 box">
                    <div class="content">
                      <span class="content-inner tooltipped" data-position="bottom" data-delay="0" data-tooltip="Learn More">
                        <h6><a href="<?php echo $fees ?>">Fees</a></h6></span>
                    </div>
                  </div>
                  <div class="col s4 box">
                    <div class="content">
                      <span class="content-inner tooltipped" data-position="bottom" data-delay="0" data-tooltip="<?php echo $location ?>">
                        <h6>Location</h6>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Entry Requirements -->
            <section id="course-requirements">    

              <div class="mmu-page-icon mmu-requirement"></div>
              <h2 class="center-align with-icon"><?php _e('Entry Requirements', 'multimedia') ?></h2>
              <div class="second-tab">
                <div class="col s12 l8 offset-l2">
                  <ul class="tabs mmu-icon-tabs">
                    <?php get_tab_list_template($_localization_array); ?>
                  </ul>
                </div>
                <div class="tab-content">
                  <?php $requirements = array('intl'  => get_requirement_data(get_meta($post->ID, 'entry_req_page_id'), 'intl', $post->post_type),
                                              'local' => get_requirement_data(get_meta($post->ID, 'entry_req_page_id'), 'local', $post->post_type)); ?>

                  <?php foreach ($requirements as $key => $req): ?>
                    <div id="<?php echo $key ?>">
                      <?php if (empty($req)): ?>
                        <?php 
                          if ($key == 'intl') {
                            echo $_intl_not_available;
                          } else if ($key == 'local') {
                            echo $_local_not_available;
                          }
                        ?>
                      <?php else: ?>
                        <?php echo $req['content']; ?>
                      <?php endif; ?>
                    </div>
                  <?php endforeach; ?>
                  
                  
                </div>  
              </div>
            </section>
            <?php $progression_array = get_degree_progression_urls(get_meta($post->ID, 'faculty_ids')); ?>

            <?php if(!empty($progression_array)): ?>
              <div class="container center-align"><h3 class="text-blue"><?php _e('Upon completion,<br> you can opt for these Degree programmes', 'multimedia') ?></h3></div>
              
              <section id="course-requirements" class="">
                <div class="simple-tables row">
                  <div class="thead center-align">
                    <div class="title"><?php echo get_degree_options_text($post->post_type) ?></div>
                  </div>
                  <div class="tbody">
                    <?php if (is_array($progression_array)): ?>
                      <?php foreach ($progression_array as $faculty): ?>
                        <div class="small-text match-height col s12 m<?php echo (12/count($progression_array)) ?>">
                          <h5><?php echo $faculty['faculty']->name ?></h5>
                          <ul>
                            <?php foreach ($faculty['degrees'] as $degree): ?>
                              <?php $title = get_meta($degree->ID, 'secondary_title').' '.$degree->post_title ?>
                              <li><a href="<?php echo get_permalink($degree->ID); ?>" title="<?php echo $title ?>"><?php echo $title; ?></a></li>
                            <?php endforeach ?>
                          </ul>
                        </div>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <div class="col s12">
                        <h5><?php echo $progression_array; ?></h5>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </section>
            <?php endif; ?>

            <div class="row center-align">
              <?php echo make_blue_btn($apply_now_link, __('Apply Now', 'multimedia')) ?>
            </div>

            <section id="back-button" class="center-align">
              <?php echo make_course_back_button($post->post_type) ?>
            </section>





          <!--  <section id="course-advancements" class="row simple-table">
              <div class="col s12 m6 two-col">
                <div class="thead">Faculty of Engineering (Cyberjaya Campus)</div>
                <div class="tbody">testing123</div>
              </div>
              <div class="col s12 m6 two-col">
                <div class="thead">Faculty of Engineering and Technology (Melaka Campus)</div>
                <div class="tbody">bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla </div>
              </div>
            </section> -->
          </div>
        </div>

      </div>

    </article><!-- #post-## -->

  </main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
