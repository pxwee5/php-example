<?php
/*
Template Name: Community > Alumni (Page)
*/
get_header(); 
global $post;
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if(!empty($desc_1 = get_meta($post->ID, 'desc_1'))): ?>
        <section class="">
          <div class="container">
            <div class=""><?php echo mmuautop($desc_1); ?></div>

              <div class="row">

                <div class="col s12">
                  <div class="col s12 container-text">
                    <div class="col s12 m3 center-align">
                      <?php echo wp_get_attachment_image(get_meta($post->ID, 'icon_benefits'), 'full'); ?>
                    </div>
                    <div class="col s12 m9">
                      <?php echo mmuautop(get_meta($post->ID, 'desc_benefits')) ?>
                    </div>
                  </div>
                </div>

              </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if(!empty($desc_2 = get_meta($post->ID, 'desc_2'))): ?>
        <section class="blue-bg">
          <div class="container padding-s">
            <?php echo mmuautop($desc_2) ?>
            <div class="row">
              <?php for ($i=0; $i<get_meta($post->ID, 'perks'); $i++): ?>
                <?php 
                  $string = 'perks_'.$i.'_';
                  $perk_icon = wp_get_attachment_image(get_meta($post->ID, $string.'icon'));
                  $perk_desc = get_meta($post->ID, $string.'desc');
                ?>
                <div class="col s6 m3">
                  <div class="center-align">
                    <?php echo $perk_icon ?>
                  </div>
                  <div class="center-align">
                    <?php echo $perk_desc ?>
                  </div>
                </div> 
              <?php endfor; ?>
            </div>
          </div>
        </section>
      <?php endif; ?>


      <?php if(!empty($desc_3 = get_meta($post->ID, 'desc_3'))): ?>
        <section>
          <div class="container">
            <?php echo mmuautop($desc_3) ?>
          </div> 
        </section>
      <?php endif; ?>

      <?php if(!empty($news_desc = get_meta($post->ID, 'news_desc'))): ?>
      <section class="blue-bg">
        <div class="container">
          <?php echo mmuautop($news_desc); ?>
          <div class="row">
            <div class="container">
              <?php $news = get_news_events_options(2, get_meta($post->ID, 'news_cat')); ?>
              <?php foreach ($news as $post): ?>
                <?php setup_postdata($post); ?>
                <div class="col s12 m6 animated fadeIn">
                  <div class="news-grid grid-border match-height">
                    <div class="news-img" style="background-image: url('<?php echo get_the_post_thumbnail_url('', 'medium_large') ?>')"></div>
                    <div class="news-content">
                      <div class="news-title"><?php echo get_the_title() ?></div>
                      <p class="news-excerpt"><?php echo get_the_excerpt() ?>...</p> 
                    </div>
                    <div class="news-footer">
                      <a class="waves-effect waves-light btn mmuwhite" href="<?php the_permalink() ?>">Read More</a>
                    </div>
                  </div>    
                </div>
              <?php endforeach; ?>
              <?php wp_reset_postdata(); ?>
            </div>
          </div>

          
        </div>
      </section>
      <?php endif; ?>
      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
