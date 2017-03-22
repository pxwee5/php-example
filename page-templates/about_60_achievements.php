<?php
/*
Template Name: About > Award & Achievements (Page)
*/
get_header(); 

global $wp_query;

$post_type = 'awards-achievements';
$current_year = date("Y");
//$research_term = get_term_by('slug', 'research', 'awards_category'); //Does not have term filter. Comment this line.
$post_count = post_count_by_year($post_type);
if (!empty($post_count)) { 
  $start_year = $post_count[0]['year'];
}
$post_per_page = 6;
$current_posts_count = 0;
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <section>


        <div class="container">
          <?php if (!empty($post_count)): ?>
            <ul class="collapsible" data-collapsible="accordion">

              <?php for ($year=$current_year; $year>=$start_year; $year--): ?>
                <?php $current_posts_count = 0; ?>
                <?php $active = ($year == $current_year) ? 'active' : '' ?>
                <?php $query = query_award_pages($post_per_page, $post_type, 1, $year); ?> 

                <?php if (!empty($query)): ?>
                <li>
                  <div class="collapsible-header <?php echo $active ?>">
                    <span class="collapsible-title"><?php echo $year; ?></span>
                    <span class="dashicons"></span>
                  </div>

                  <div class="collapsible-body">
                    <div class="content">

                      <div class="row margin-xs awards <?php echo $year ?>">
                        <?php foreach ($query as $post): ?>
                          <?php setup_postdata($post); ?>
                          <div class="col s12 m6 l4 margin-xs">
                            <div class="thumbnail" style="background-image: url(<?php echo the_post_thumbnail_url( 'medium_large' ); ?>)"></div>
                            <h3 class="title"><?php echo the_title(); ?></h3>
                            <div class="excerpt">
                              <?php echo the_excerpt(); ?>
                              <?php echo sprintf( '<a class="read-more" href="%1$s" title="%2$s">%3$s</a>', get_permalink( get_the_ID() ), get_the_title(), __('Continue Reading', 'multimedia')); ?>
                            </div>
                          </div>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php $current_posts_count += $post_per_page; ?>
                      </div>

                      <!-- Load More -->
                      <?php $data_to_js = array('ppp'       => $post_per_page, 
                                                'post_type' => $post_type, 
                                                'page'      => 1,
                                                'year'      => $year); ?>

                      <?php foreach ($post_count as $year_count): ?>
                        <?php if ($year == $year_count['year']): if ( $current_posts_count < $year_count['count']): ?>
                          <div class="load-more center-align margin-xs">
                            <a href="#" title="Load More" class="waves-effect waves-light btn mmublue" data-query="<?php echo base64_encode(json_encode($data_to_js)) ?>">Load More</a>
                            <span class="generate-loader"></span>
                            <div class="end-of-post hide"><?php _e('End of Posts', 'multimedia') ?></div>
                          </div>
                        <?php endif; endif; ?>
                      <?php endforeach; ?>

                    </div>
                  </div><!-- End Collapsible Body -->
                </li>
                <?php endif; ?>
              <?php endfor; ?>
            </ul>
          <?php endif; ?>
        
        </div>
      </section>
      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
