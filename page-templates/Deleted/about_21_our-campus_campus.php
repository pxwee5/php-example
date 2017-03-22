<?php
/*
Template Name: About > Our Campus > Individual Campus (Pages)
*/

get_header(); 
var_dump(get_post_meta($post->ID));

$international = __( 'International', 'multimedia' );
$local = __( 'Local (Malaysian)', 'multimedia' );

global $_localization_array;

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<header class="entry-header">
			<?php echo get_the_post_thumbnail( $post, 'full' ); ?>
			<div class="header-text-wrapper">
				<span class="header-text">
					<h1 class="entry-title"><?php echo get_the_title(); ?></h1>
					<p><?php echo get_meta($post->ID, 'title_desc'); ?></p>
				</span>
			</div>
		</header><!-- .entry-header -->


		<!-- WP -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="container">
				<section id="page-info">
					<?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
					<?php include(locate_template('/template-parts/page_info.php')); ?>
				</section>


		</article><!-- #post-## -->

	</main><!-- .site-main -->

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
