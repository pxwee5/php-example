<?php
/*
Template Name: Academics > Programs (Page)
*/
?>

<?php
get_header(); 
?>

<script> var $templateDir = "<?php bloginfo('template_directory') ?>"; //Important</script>

<div id="primary" class="content-area is-course">
	<main id="main" class="site-main" role="main">
		<?php include(locate_template('/template-parts/academic_banner.php')); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="row first-tab">
				<div class="container">
					<ul class="tabs mmu-icon-tabs">
						<!-- Program Links-->
						<?php $programs = query_posts_from_taxonomy_category('academic_cat', 'academic-programs', 100, 'menu_order', 'ASC'); ?>
						<?php $icons_array = get_tab_list($programs, '') ?>
						<?php echo get_tab_list_template($icons_array); ?>
					</ul>
				</div>

				<!-- Course Contents -->
				<div class="tab-content">
					<?php include(locate_template('/template-parts/course_tab_contents.php')); ?>
				</div>
			</div>
		</article>

		

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
