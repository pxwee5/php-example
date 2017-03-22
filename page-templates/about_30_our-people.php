<?php
/*
Template Name: About > Our People (Page)
*/
get_header(); 

$peoples = query_posts_by_post_type('about', $post->ID);
$templates = array('biography', 'bod', 'committee', 'organization');
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="container">
        <section id="apply-online-table" class="row margin-xboth">
          <!-- Select Field -->
          <div class="mmu-input input-field col s10 offset-s1 m8 offset-m2 l6 offset-l3">
            <select id="people-select" class="materialize">
              <?php foreach ($peoples as $key => $people): ?>
                <option value="<?php echo $people->post_name ?>"><?php echo $people->post_title ?></option>
              <?php endforeach; ?>
            </select>
            <label><?php _e('Browse Our People', 'multimedia') ?></label>
          </div>
        </section>
      </div>
      
      <div class="container-wide">
        <?php foreach ($peoples as $people): ?>
          <section id="<?php echo $people->post_name ?>" class="people-page">
            <?php foreach ($templates as $string) { if (stripos(get_meta($people->ID, '_wp_page_template'), $string)) break; } //Determine which template is used by looking through all the template arrays ?>
            <?php if ($string): ?>
              <?php if ($string == 'biography'): ?>
                <!-- People > Biography Template -->
                <div class="biography">
                  <div class="row margin-xboth">
                    <div class="col s12 m5"><?php echo wp_get_attachment_image(get_meta($people->ID, 'photo'), 'full') ?></div>
                    <div class="col s12 m7">
                      <h2><?php echo get_meta($people->ID, 'name') ?></h2>
                      <div><?php echo mmuautop(get_meta($people->ID, 'biography')) ?></div>
                    </div>
                  </div>
                </div>
              <?php elseif($string == 'bod'): ?>
                <!-- People > Board of Director Template -->
                <div class="board-of-director">
                  <?php if (!empty($bod = get_meta($people->ID, 'bod'))): ?>
                    <div class="row">
                      <?php for ($i=0; $i<$bod; $i++): ?>
                        <div class="col s6 m4 l3 bod-col">
                          <div class="bod-wrapper">
                            <div class="photo"><?php echo wp_get_attachment_image(get_meta($people->ID, 'bod_'.$i.'_photo'), 'full') ?>  </div>
                            <div class="name center-align">
                              <div style="font-weight: bold;"><?php echo get_meta($people->ID, 'bod_'.$i.'_name') ?></div>
                              <div><?php echo get_meta($people->ID, 'bod_'.$i.'_title') ?></div>
                            </div>
                          </div>
                        </div>
                      <?php endfor; ?>
                    </div>
                  <?php endif; ?>
                </div>
              <?php elseif($string == 'committee'): ?>
                <?php 
                  if (!empty(get_meta($people->ID, 'committee'))) {
                    $flex_content = get_array_from_flexcontent($people, 'committee');
                    include(locate_template('/template-parts/flex_content.php'));
                  } 
                ?>
              <?php elseif ($string == 'organization'): ?>
                <div class="org-chart">
                  <?php echo mmuautop(get_meta($people->ID, 'text')); ?>
                </div>
              <?php endif; //End Bio/BoD/Committee?> 
            <?php endif; ?>
          </section>
        <?php endforeach; ?>
        
      </div>
      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
