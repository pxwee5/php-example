<?php
/*
Template Name: Community > Academic Calendar (Page)
*/

get_header(); 

//var_dump(get_post_meta($post->ID));

$terms = get_hierarchial_term_array(get_terms(array('taxonomy' => 'calendar_filter', 'orderby' => 'slug', 'get' => 'all')));
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <section>
          <div class="row">
            <?php if (!empty($terms)): ?>
              <?php foreach($terms as $term): ?>
                <div class="input-field mmu-input col s12 m<?php echo (12 / count($terms)) ?>">

                    <select id="" class="materialize calendar-filter" name="<?php echo $term['parent']->slug ?>">
                      <!-- <option value="" disabled selected><?php echo $term['parent']->name ?></option> -->
                      <?php foreach ($term['child'] as $child): ?>
                        <option value="<?php echo $child->slug ?>"><?php echo $child->name ?></option>
                      <?php endforeach; ?>
                    </select>
                    <label><?php echo $term['parent']->description ?></label>

                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <!-- Dynamically Generate Table Here -->
          <div class="ajax-load">
            <div class="generate-loader"></div>
            <div id="generate-table"></div>
            <div id="table-legend" class="right-align">
              <span class="legend-icon legend-break"></span><span class="legend-text"><?php _e('Study Break', 'multimedia') ?></span>
              <span class="legend-icon legend-exam"></span><span class="legend-text"><?php _e('Exam Week', 'multimedia') ?></span>
            </div>
          </div>
          
         <!--  <div class="generate-table-wrapper">
            <div class="generate-loader"></div>
            <div id="generate-table"></div>
            <div id="table-legend" class="right-align">
              <span class="legend-icon legend-break"></span><span class="legend-text"><?php _e('Study Break', 'multimedia') ?></span>
              <span class="legend-icon legend-exam"></span><span class="legend-text"><?php _e('Exam Week', 'multimedia') ?></span>
            </div>
          </div> -->
        </section>

        <div class="calendar-file margin-s center-align">
          <?php echo make_blue_btn('', __('Download Calendar', 'multimedia'), TRUE)  ?>
        </div>


      </div>

    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
