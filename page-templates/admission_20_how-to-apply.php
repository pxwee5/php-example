<?php
/*
Template Name: Admission > How to Apply (Page)
*/

get_header(); 

$international = __( 'International', 'multimedia' );
$local = __( 'Local (Malaysian)', 'multimedia' );

global $_localization_array;
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php include(locate_template('/template-parts/header_banner.php')); ?>

		<!-- WP -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="row first-tab">
				<div class="col s10 offset-s1 m8 offset-m2">
					<ul class="tabs mmu-icon-tabs" >
						<!-- First: Tab Links-->
						<?php get_tab_list_template($_localization_array); ?>
					</ul>
				</div>
				<!-- First: Tab Contents -->
				<div class="col tab-content">
					<div class="container">
						<!-- START INTERNATIONAL -->
						<div id="intl" class="tab-content-intl">
							<?php $page = get_page_info($post->ID, $international, 'intl'); //page_info.php dependency ?>
							<?php include(locate_template('/template-parts/page_info.php')); ?>
							
							<div class="row second-tab">
								<!-- Second: Intl Tab Links -->
								<div class="col s12 l10 offset-l1">
									<ul class="tabs mmu-icon-tabs">
										<?php $intl_posts = query_posts_from_taxonomy_category('academic_cat', 'how-to-apply-programs-intl', 100, 'menu_order', 'ASC'); ?>
										<?php $icons_array = get_tab_list($intl_posts, 'intl')?>
										<?php echo get_tab_list_template($icons_array); ?>
									</ul>
								</div>

								<!-- Second: International Tab Contents -->
								<div class="col tab-content">
									<?php $contents_array = get_tab_contents($post->ID, 'intl', $intl_posts); ?>
									<?php get_template_parts_using_array($contents_array, 'requirement_tab_contents.php') ?>
								</div>
							</div>

						</div><!-- END INTERNATIONAL -->

						<!-- START LOCAL -->
						<div id="local" class="tab-content-local">
							<?php $page = get_page_info($post->ID, $local, 'local'); //page_info.php dependency ?>
							<?php include(locate_template('/template-parts/page_info.php')); ?>

							<div class="row second-tab">
								<!-- Second: Local Tab Links -->
								<div class="col s12 l10 offset-l1">
									<ul class="tabs mmu-icon-tabs">
										<?php $local_posts = query_posts_from_taxonomy_category('academic_cat', 'how-to-apply-programs-local', 100, 'menu_order', 'ASC'); ?>
										<?php $icons_array = get_tab_list($local_posts, 'local')?>
										<?php echo get_tab_list_template($icons_array); ?>
									</ul>
								</div>

								<!-- Second: Local Tab Contents -->
								<div class="col tab-content">
									<?php $contents_array = get_tab_contents($post->ID, 'local', $local_posts); ?>
									<?php get_template_parts_using_array($contents_array, 'requirement_tab_contents.php') ?>
								</div>
							</div>

						</div><!-- END LOCAL -->

					</div>
				</div>

			</div>




		</article><!-- #post-## -->

	</main><!-- .site-main -->

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
