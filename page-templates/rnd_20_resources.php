<?php
/*
Template Name: R&D > Resources (Page)
*/

get_header(); 

//Important Constants. Do not change title and link.

$excellence_icon = array( 'normal'  => wp_get_attachment_image(get_meta($post->ID, 'excellence_icon_normal'), 'full', '', array('class' => 'mmu-icon-normal')), 
                          'hover'   => wp_get_attachment_image(get_meta($post->ID, 'excellence_icon_hover'), 'full', '', array('class' => 'mmu-icon-hover')),
                          'title'   => get_meta($post->ID,'excellence_title'), 
                          'slug'    => 'excellence',
                          'link'    => '#excellence',
                          'active'  => '');
                      
$centres_icon = array('normal'  => wp_get_attachment_image(get_meta($post->ID, 'centres_icon_normal'), 'full', '', array('class' => 'mmu-icon-normal')), 
                      'hover'   => wp_get_attachment_image(get_meta($post->ID, 'centres_icon_hover'), 'full', '', array('class' => 'mmu-icon-hover')),
                      'title'   => get_meta($post->ID,'centres_title'), 
                      'slug'    => 'centres',
                      'link'    => '#centres',
                      'active'  => '');
$icons_array = array($excellence_icon, $centres_icon);
?>
<script> var $templateDir = "<?php bloginfo('template_directory') ?>"; //Important</script>

<?php $percentage = 100/(count($icons_array)+1); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="row first-tab">
        <div class="container">

          <div class="col with-dropdown-icon" style="width: <?php echo $percentage * count($icons_array) ?>%;">
            <ul class="tabs mmu-icon-tabs">
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
                <div class="mmu-icon-text"><?php _e('Download info on IP, Ethics & Disclosure', 'multimedia') ?></div>
              </a>
          
              <!-- Dropdown Items -->
              <?php if (!empty(get_meta($post->ID, 'files'))): ?>
                <ul id="info-pdf" class="dropdown-content overview-dropdown arrow-with-border" >
                  <?php for ($i=0; $i<get_meta($post->ID, 'files'); $i++): ?>
                    <?php 
                      $string = 'files_'.$i.'_';
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
          <?php foreach ($icons_array as $tab): ?>
            <div id="<?php echo strtolower(combine($tab['slug'])) ?>">
              <section>

                <div class="page-info container">
                  <!-- Logo -->
                  <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, $tab['slug'].'_icon_color'), 'full'); ?></div>
                  <h2 class="page-info-title"><?php echo $tab['title']; ?></h2>
                  <div class="page-info-desc"><?php echo mmuautop(get_meta($post->ID, $tab['slug'].'_desc')); ?></div>
                </div>

                <?php if ($tab['slug'] == 'excellence'): ?>
                  <!-- List of Centres of Excellence -->
                  <?php $carousel = get_array_from_repeater($post, 'excellent_centres', array('title', 'image', 'desc', 'pic')); ?>
                  <div class="carousel-mmu resources-carousel">
                    <?php foreach ($carousel as $carousel_item): ?>
                      <?php include(locate_template('/template-parts/carousel_excellence.php')); ?>
                    <?php endforeach; ?>
                  </div>
       
                <?php elseif ($tab['slug'] == 'centres'): ?>
                  <!-- List of Research Centres -->

                  <?php 
                    $args = array(
                      'taxonomy'    => 'faculty', 
                      //'include'     => get_meta($program->ID, 'faculty_select'),
                      'orderby'     => 'slug', 
                      'pad_counts'  => true,
                      'hide_empty'  => true,
                      'get'         => 'all',
                    )
                  ?>
                  <?php $faculties = get_terms($args); ?>
                  <div class="container">
                    <div class="row">
                      <div class="input-field mmu-input col s12 m8 offset-m2 l6 offset-l3">
                        <select id="faculty-load-research-centre" class="materialize lecturer-filter">
                          <?php foreach ($faculties as $faculty): ?>
                            <option value="<?php echo $faculty->term_id ?>"><?php echo $faculty->name ?></option>
                          <?php endforeach; ?>
                        </select>
                        <label><?php _e('Filter by Faculty', 'multimedia'  ) ?></label>
                      </div>
                    </div>

                    <div class="ajax-load">
                      <div class="row load-research-centre"></div>
                      <div class="generate-loader"></div>
                    </div>
                    
                    <div class="research-centre-template hide"></div>
                  </div>
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
