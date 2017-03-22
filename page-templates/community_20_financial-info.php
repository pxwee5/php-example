<?php
/*
Template Name: Community > Financial Info (Page)
*/

get_header(); 

//var_dump(get_post_meta($post->ID));
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <section>
          <?php if ($accordion = get_meta($post->ID, 'repeater')): ?>
            <ul class="collapsible" data-collapsible="accordion">
            <?php for ($i=0; $i<$accordion; $i++): ?>
              <?php $string = 'repeater_'.$i.'_'; ?>
              <li>
                <div class="collapsible-header">
                  <!-- <span class="collapsible-icon"></span> -->
                  <span class="collapsible-title"><?php echo get_meta($post->ID, $string.'title') ?></span>
                  <span class="dashicons"></span>
                </div>
                <div class="collapsible-body">
                  <div class="container">
                  <?php if (get_meta($post->ID, $string.'content')): ?>
                    <?php $flex_content = get_array_from_flexcontent($post, $string.'content'); ?>
                    <?php include(locate_template('/template-parts/flex_content.php')); ?>
                  <?php endif; ?>
                  </div>
                </div>
              </li>

            <?php endfor; ?>
            </ul>
          <?php endif; ?>
        </section>
      </div>

    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>

