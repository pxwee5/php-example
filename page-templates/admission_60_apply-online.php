<?php
/*
Template Name: Admission > Apply Online (Page)
*/

get_header(); 

?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="container">
        <section id="page-info">
          <h2 class="center-align"><?php echo get_meta($post->ID, 'secondary_title') ?></h2>
        </section>

        <section id="apply-online-table" class="row">

          <!-- Select Field -->
          <div class="mmu-input input-field col s10 offset-s1 m6 offset-m3">
            <select id="program-select" class="materialize">
              <option value="" disabled selected><?php _e('List of Available Programs', 'multimedia') ?></option>
              <?php for ($i=0;$i<get_meta($post->ID, 'program_table');$i++): ?>
                <?php $title = get_meta($post->ID, 'program_table_'.$i.'_title'); ?>
                <?php $table_array[$i] = json_decode(get_meta($post->ID, 'program_table_'.$i.'_table'), TRUE) ?>
                <?php $table_array[$i]['t'] = $title ?>
                <option value="<?php echo $i ?>"><?php echo $table_array[$i]['t'] ?></option>
              <?php endfor; ?>
            </select>
            <label><?php _e('Select a Program To See More Information', 'multimedia') ?></label>
          </div>

          <script type="text/javascript">
            <?php $table_array = json_encode($table_array); ?> //Encoding in JSON before passing to javascript
            var $tables = <?php echo ($table_array) ?> //Passing Variables to Javascript 
          </script>

          <!-- Dynamically Generate Table Here -->
          <div id="generate-table" class="center-align col s12"></div>

        </section>

        <div id="apply-online-buttons" class="center-align">
          <span style="margin: 0.5rem 2rem; display: inline-block"><?php echo make_white_btn(get_meta($post->ID, 'application_status_link'), __('Check Your Application Status', 'multimedia')); ?></span>
          <span style="margin: 0.5rem 2rem; display: inline-block"><?php echo make_blue_btn(get_meta($post->ID, 'apply_link'), __('Apply Online', 'multimedia')); ?></span>
        </div>
      </div>

      <div id="contact-form">
        <div class="container">
          <?php if(empty($_GET['thankyou'])): ?>
            <h2 class="center-align"><?php _e('Questions? Contact Us Now', 'multimedia') ?></h2>
            <?php echo do_shortcode('[contact-form-7 title="Admission > Apply Now (Contact Form)"]'); ?>
          <?php else: ?>
            <div class="center-align">
              <?php _e('This form has been submitted', 'multimedia') ?>
              <script type="text/javascript">
                swal({title: "<?php _e('Success!', 'multimedia') ?>",
                      text: "<?php echo get_meta($post->ID, 'thank_you_message') ?>",
                      type: "success",
                      confirmButtonText: "OK" });
              </script>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="container">
        <?php $campuses = query_posts_by_post_type('campus', 0); ?>
        <?php if (!empty($campuses)): ?>
          <?php foreach ($campuses as $campus) { $campus_id[] = $campus->ID; } ?>
          <?php $campus_details = get_campus_details($campus_id); ?>

          <section id="campus-details" class="row">
            
            <?php foreach($campus_details as $campus): ?>
              <div class="simple-tables col s12 m6">
                <div class="thead center-align">
                  <img src="<?php echo $campus['image']; ?>" alt="<?php echo $campus['title']; ?>" title="<?php echo $campus['title']; ?>" />
                  <div class="title"><?php echo $campus['title'] ?></div>
                </div>
                <div class="tbody campus-tbody">
                  <div class="col s12 center-align">
                    <div class="campus-address"><?php echo $campus['address'] ?></div>
                    <?php if (!empty($campus['contacts'])): ?>
                      <?php foreach ($campus['contacts'] as $contact): ?>
                        <div class="campus-contacts">
                          <div class="contact-title"><?php echo $contact['department'] ?></div>
                          <div class="contact-info">
                            <div><?php echo $contact['toll_free'] ?></div>
                            <div><?php echo $contact['tel'] ?></div>
                            <div><?php echo $contact['fax'] ?></div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="campus-map-link center-align margin-xs margin-xtop"><?php echo make_blue_btn('https://www.google.com/maps/place/'.$campus['location']['address'] , __('View Map', 'multimedia'), TRUE ) ?></div>
                  </div>
                  
                </div>
              </div>
            <?php endforeach; ?>
          </section>

        <?php endif; ?>
        
      </div>


    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
