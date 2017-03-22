<?php
/*
Template Name: About > Demographics (Page)
*/
get_header(); 

$total_graduates = json_decode(get_meta($post->ID, 'total_graduates'), TRUE);
$graduates_by_level = json_decode(get_meta($post->ID, 'graduates_by_level'), TRUE);
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

      <section id="student-count">
        <div class="container">
          <?php $count_tables = get_meta($post->ID, 'student_count'); ?>
          <?php if ($count_tables > 0): ?>
            <div class="row">
              <?php for ($i=0; $i<$count_tables; $i++): ?>
                <?php $table = json_decode(get_meta($post->ID, 'student_count_'.$i.'_table'), TRUE); ; ?>
                <div class="col s12 m6 match-height margin-xxs">
                  <?php include_table($table, 'margin-xboth'); ?>
                </div>
              <?php endfor; ?>
            </div>
          <?php endif; ?>
        </div>
      </section>

      <hr class="margin-xboth container" />

      <?php $total_graduates_array = parse_array_into_tables($total_graduates) ?>
      <?php $graduates_by_level_array = parse_array_into_tables($graduates_by_level) ?>
      <?php $start = min(array_keys($total_graduates_array)) ?>
      <?php $end = max(array_keys($total_graduates_array)) ?>
      <?php $sum = 0 ?>
      <?php foreach ($total_graduates_array as $total) { $sum += $total['Total']; } ?>

      <section id="student-count">
        <div class="container">
          <div class="center-align">
            <?php echo sprintf(__('MMU Graduates %1$d - %2$d', 'multimedia'), $start, $end ) ?>
            <h6 class="text-blue"><?php echo sprintf(__('Grandtotal from %1$d - %2$d: %3$d', 'multimedia'), $start, $end, $sum ) ?></h6>
          </div>

          <div class="row margin-s margin-xbottom">

            <div class="col s12 m6">
              <div class="col s8 offset-s2 input-field mmu-input">
                <select id="select-graduates-total" class="materialize select-year-filter">
                  <?php foreach($total_graduates_array as $key => $array): ?>
                    <option value="<?php echo $key ?>"><?php echo sprintf(__('Year %1$d', 'multimedia'), $key) ?></option>
                  <?php endforeach ?>
                </select>
                <label><?php _e('Total Graduates', 'multimedia') ?></label>  
              </div>

              <div class="s12 load-table" data-array="<?php echo base64_encode(strip_tags(json_encode($total_graduates_array, JSON_HEX_TAG))) ?>">
                &nbsp;
              </div>
            </div>
            
            <div class="col s12 m6">
              <div class="col s8 offset-s2 input-field mmu-input">
                <select id="select-graduates-level" class="materialize select-year-filter">
                  <?php foreach($graduates_by_level_array as $key => $array): ?>
                    <option value="<?php echo $key ?>"><?php echo sprintf(__('Year %1$d', 'multimedia'), $key) ?></option>
                  <?php endforeach ?>
                </select>
                <label><?php _e('Graduates By Level', 'multimedia') ?></label>
              </div>
              <div class="s12 load-table" data-array="<?php echo base64_encode(strip_tags(json_encode($graduates_by_level_array))) ?>">
                &nbsp;
              </div>
            </div>
          </div>

        </div>
      </section>

      <hr class="margin-xboth container" />

      <section>
        <div class="container">
          <div id="map-container">
            <div id="map" data-countries="<?php echo base64_encode(strip_tags(json_encode(get_meta($post->ID, 'countries')))) ?>"></div>
          </div>
        </div>
      </section>
      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHfeptY0-x3CtemnE5ZuP4fyWyZswZ_Ss&callback=initMap"></script>
