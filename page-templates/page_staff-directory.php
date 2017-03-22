<?php
/*
Template Name: Page > Staff Directory
*/

get_header(); 

//var_dump(get_post_meta($post->ID));

$json_campus = json_decode(file_get_contents('http://mmuexpert.mmu.edu.my/api/v1/staff/campus/all'), TRUE);
$json_faculty = json_decode(file_get_contents('http://mmuexpert.mmu.edu.my/api/v1/staff/dept/all'), TRUE);

add_action( 'init', 'allow_origin' );
function allow_origin() {
    header("Access-Control-Allow-Origin: *");
}
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <section>
          <div class="row">

            <div class="mmu-input input-field col s12 m12 l4">
              <input placeholder="<?php _e('Search Text or Leave Blank', 'multimedia') ?>" id="staff_text_search" type="text" class="staff-filter" name="search">
              <label for="staff_text_search">Search by Text</label>
            </div>
            
            <div class="mmu-input input-field col s12 m6 l4">
                <select id="staff_campus_option" class="materialize staff-filter" name="campus">
                  <option value="" selected><?php _e('Select Campus or Leave Blank', 'multimedia') ?></option>
                  <?php foreach ($json_campus['data'] as $campus): ?>
                    <option value="<?php echo $campus['full_name'] ?>"><?php echo $campus['full_name'] ?></option>
                  <?php endforeach; ?>
                </select>
                <label>Filter by Campus</label>
            </div>

            <div class="mmu-input input-field col s12 m6 l4">
                <select id="staff_faculty_option" class="materialize staff-filter" name="faculty">
                  <option value="" selected><?php _e('Select Faculty or Leave Blank', 'multimedia') ?></option>
                  <?php foreach ($json_faculty['data'] as $faculty): ?>
                    <?php if ($faculty['short_form'] != 'IO'): ?>
                      <option value="<?php echo strtolower($faculty['short_form']) ?>"><?php echo ucwords(strtolower($faculty['full_name'])).' ('.$faculty['short_form'].')'; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
                <label>Filter by Faculty</label>
            </div>

          </div>

          <!-- Dynamically Generate Table Here -->
          <div class="ajax-load">
            <div class="generate-loader"></div>
            <div id="generate-table"></div>
            <div id="generate-pagination"></div>
            <div id="generate-null" style="display: none"><?php _e('Cannot Find Any Records', 'multimedia') ?></div>
          </div>
<!--           <div class="generate-table-wrapper">
            <div class="generate-loader"></div>
            <div id="generate-table"></div>
            <div id="generate-pagination"></div>
            <div id="generate-null" style="display: none"><?php _e('Cannot Find Any Records', 'multimedia') ?></div>
          </div>
 -->
          
        </section>



      </div>

    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
