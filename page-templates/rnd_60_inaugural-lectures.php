<?php
/*
Template Name: R&D > Inaugural Lectures (Page)
*/
get_header(); 
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      
      <section id="page-info">
        <div class="container">
        <?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
        <?php include(locate_template('/template-parts/page_info.php')); ?>
        </div>
      </section>

      <section class="blue-bg">

        <div class="container">
          <div class="row">
            <div class="input-field mmu-input col s12 m8 offset-m2 l6 offset-l3">
              <select id="select-lecturers" class="materialize lecturer-filter">
                <option value="upcoming"><?php _e('Upcoming Lectures') ?></option>
                <option value="previous" selected><?php _e('Previous Lectures') ?></option>
              </select>
              <label><?php _e('Inaugural Lecturers', 'multimedia'  ) ?></label>
            </div>
          </div>
        </div>

        <?php $lecturers = get_array_from_repeater($post, 'lecturers', array('name', 'faculty', 'photo', 'status', 'summary')); ?>
        <div id="upcoming-lecturers" class="inaugural-lecturers-tab animated fadeIn">
          <?php if (array_count_value_by_key($lecturers, 'status', 'upcoming') > 0): ?>
            <div class="carousel-mmu inaugural-lecturers">
              <?php foreach ($lecturers as $lecturer): if ($lecturer['status'] == 'upcoming'): ?>
                <?php include(locate_template('/template-parts/inaugural_lecturers.php')); ?>
              <?php endif; endforeach; ?>
            </div>
          <?php else: ?>
            <div class="center-align">
              <?php _e('Currently no upcoming inaugural lecturers', 'multimedia') ?>
            </div>
          <?php endif; ?>
        </div>

        <div id="previous-lecturers" class="inaugural-lecturers-tab animated fadeIn">
          <?php if (array_count_value_by_key($lecturers, 'status', 'previous') > 0): ?>
            <div class="carousel-mmu inaugural-lecturers">
              <?php foreach ($lecturers as $lecturer): if ($lecturer['status'] == 'previous'): ?>
                <?php include(locate_template('/template-parts/inaugural_lecturers.php')); ?>
              <?php endif; endforeach; ?>
            </div>
          <?php else: ?>
            <div class="center-align">
              <?php _e('No previous inaugural lecturers', 'multimedia') ?>
            </div>
          <?php endif; ?>
        </div>  
        
      </section>
      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>

<script type="text/javascript">
  
</script>