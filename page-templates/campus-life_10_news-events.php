<?php
/*
Template Name: Campus Life > News & Events (Page)
*/
get_header(); 

/*$term_research = get_term_by('slug', 'research', 'news_category'); //Important*/

$news_date = (isset($_COOKIE['newsDate'])) ? $_COOKIE['newsDate'] : '';
$news_category = (isset($_COOKIE['newsCategory'])) ? $_COOKIE['newsCategory'] : '';
$events_date = (isset($_COOKIE['eventsDate'])) ? $_COOKIE['eventsDate'] : '';
$events_category = (isset($_COOKIE['eventsCategory'])) ? $_COOKIE['eventsCategory'] : '';

$in_news_flag = false;
$in_events_flag = false;

$news_title = get_meta($post->ID, 'news_title');
$events_title = get_meta($post->ID, 'events_title');

$icon_1 = array('normal'  => wp_get_attachment_image(get_meta($post->ID, 'news_icon_normal'), 'full', '', array('class' => 'mmu-icon-normal')),
                'hover'   => wp_get_attachment_image(get_meta($post->ID, 'news_icon_hover'), 'full','', array('class' => 'mmu-icon-hover')),
                'title'   => $news_title, 
                'slug'    => strtolower(clean($news_title)), 
                'link'    => '#'.strtolower(clean($news_title)),
                'active'  => '');
$icon_2 = array('normal'  => wp_get_attachment_image(get_meta($post->ID, 'events_icon_normal'), 'full', '', array('class' => 'mmu-icon-normal')),
                'hover'   => wp_get_attachment_image(get_meta($post->ID, 'events_icon_hover'), 'full','', array('class' => 'mmu-icon-hover')),
                'title'   => $events_title, 
                'slug'    => strtolower(clean($events_title)), 
                'link'    => '#'.strtolower(clean($events_title)),
                'active'  => '');
$icons_array = array($icon_1, $icon_2);

$terms = get_terms(array('taxonomy' => 'news_category', 'hide_empty' => true,));
/*$news_options = wp_get_archives( 'type=monthly&format=link&echo=0&post_type=news&limit=12' );
$events_options = wp_get_archives( 'type=monthly&format=link&echo=0&post_type=events&limit=12' );

preg_match_all('/title=\'(.*?)\'/m', $news_options, $news_options);
$news_options = get_news_date_options($news_options[1]);

preg_match_all('/title=\'(.*?)\'/m', $events_options, $events_options);
$events_options = get_news_date_options($events_options[1]);*/

/* Url Param To Determine Which Tab is active */



$news_options = get_news_date_options(get_news_dates_by_term('news'));
$events_options = get_news_date_options(get_news_dates_by_term('events'));

/*
var_dump($_COOKIE['newsDate']);

foreach ($icons_array as $key => $icon) {
  if ($icon['slug'] == strtolower($url_type_param)) {
    $icons_array[$key]['active'] = 'active';
  }
}*/


?>
<script> var $templateDir = "<?php bloginfo('template_directory') ?>"; //Important</script>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php include(locate_template('/template-parts/header_banner.php')); ?>

    <!-- WP -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="row first-tab">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
          <ul class="tabs mmu-icon-tabs">
            <?php echo get_tab_list_template($icons_array); ?>
          </ul>
        </div>

        <!-- Course Contents -->
        <div class="tab-content">

          <!-- NEWS CONTENTS -->
          <div id="<?php echo $icon_1['slug']; ?>">
            <div class="container">
              <div class="page-info">
                <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, 'news_icon_color'), 'full') ?></div>
                <h2 class="page-info-title"><?php echo $icon_1['title']; ?></h2>
              </div>

              <div class="row">
                <div class="mmu-input input-field col s12 m6 l5">
                  <select id="news_option_month" class="materialize" name="campus">
                    <?php foreach ($news_options as $option): ?>

                      <?php if ($news_date == $option['value']): ?>
                        <option value="<?php echo $option['value'] ?>" selected><?php echo $option['text'] ?></option>
                        <?php $in_news_flag = true; ?>
                      <?php else: ?>
                        <option value="<?php echo $option['value'] ?>"><?php echo $option['text'] ?></option>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </select>
                  <label><?php _e('Filter by Month', 'multimedia') ?></label>
                </div>

                <div class="mmu-input input-field col s12 m6 l5 offset-l2">
                  <select id="news_option_category" class="materialize" name="faculty">
                    <option value="all"><?php _e('All Category', 'multimedia') ?></option>
                    <?php foreach ($terms as $term): ?>

                      <?php if ($news_category == $term->term_id): ?>
                        <option value="<?php echo $term->term_id ?>" selected><?php echo $term->name; ?></option>
                      <?php elseif ($term->slug == 'ccu'): ?>
                        <option value="<?php echo $term->term_id ?>" selected><?php echo $term->name; ?></option>
                      <?php else: ?>
                        <option value="<?php echo $term->term_id ?>"><?php echo $term->name; ?></option>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </select>
                  <label><?php _e('Filter by News &amp; Events Category', 'multimedia') ?></label>
                </div>
              </div>

              <div class="ajax-load">
                <div class="load-news row">
                  <!-- AJAX LOAD HERE -->
                </div>
                <div class="generate-loader"></div>
                <div class="ajax-empty news hide"><?php _e('No News In This Month/Category', 'multimedia') ?></div>
              </div>

              <div class="news-list-template hide"></div>


            </div>
          </div>

          <!-- EVENTS CONTENTS -->
          <div id="<?php echo $icon_2['slug'] ?>">
            <div class="container">
              <div class="page-info">
                <div class="page-info-image"><?php echo wp_get_attachment_image(get_meta($post->ID, 'events_icon_color'), 'full') ?></div>
                <h2 class="page-info-title"><?php echo $icon_2['title']; ?></h2>
              </div>

              <div class="row">
                <div class="mmu-input input-field col s12 m6 l5">
                  <select id="events_option_month" class="materialize" name="campus">
                    <?php foreach ($events_options as $option): ?>

                      <?php if ($events_date == $option['value']): ?>
                        <option value="<?php echo $option['value'] ?>" selected><?php echo $option['text'] ?></option>
                        <?php $in_events_flag = true; ?>
                      <?php else: ?>
                        <option value="<?php echo $option['value'] ?>"><?php echo $option['text'] ?></option>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </select>
                  <label><?php _e('Filter by Month', 'multimedia') ?></label>
                </div>

                <div class="mmu-input input-field col s12 m6 l5 offset-l2">
                  <select id="events_option_category" class="materialize" name="faculty">
                    <option value="all"><?php _e('All Category', 'multimedia') ?></option>
                    <?php foreach ($terms as $term): ?>
                      <?php if ($events_category == $term->term_id): ?>
                        <option value="<?php echo $term->term_id ?>" selected><?php echo $term->name; ?></option>
                      <?php elseif ($term->slug == 'ccu'): ?>
                        <option value="<?php echo $term->term_id ?>" selected><?php echo $term->name; ?></option>
                      <?php else: ?>
                        <option value="<?php echo $term->term_id ?>"><?php echo $term->name; ?></option>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </select>
                  <label><?php _e('Filter by News &amp; Events Category', 'multimedia') ?></label>
                </div>
              </div>

              <div class="ajax-load">
                <!-- <div class="load-events row"></div> -->

                <div class="simple-tables load-events row">
                  <div class="thead">
                    <div class="title center-align col s12 m4 l4 hide-on-small-only"><?php _e('Date', 'multimedia'); ?></div>
                    <div class="title center-align col s12 m8 l8"><?php _e('Upcoming Event Details', 'multimedia'); ?></div>
                  </div>

                  <div class="tbody">
                    <!-- AJAX LOAD HERE -->
                  </div>
                </div>

                <div class="generate-loader"></div>
                <div class="ajax-empty events hide"><?php _e('No Events In This Month/Category', 'multimedia') ?></div>
              </div>

              <div class="events-list-template hide"></div>

            </div>
          </div>
        </div>
      </div>

      
    </article><!-- #post-## -->

  </main><!-- .site-main -->

  <?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
