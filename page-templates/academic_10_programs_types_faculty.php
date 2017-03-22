<?php
/*
Template Name: Academics > Programs > Types > Faculty (Pages)
*/

//var_dump($post);
?>

<?php get_header(); ?>

<div id="primary" class="content-area is-course">
	<main id="main" class="site-main" role="main">
		<?php include(locate_template('/template-parts/academic_banner.php')); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="row first-tab">
				<div class="container">
					<ul class="mmu-icon-tabs" > <!-- Removed .tab to disable tabbing function. -->
						<!-- Program Links-->
						<?php $programs = query_posts_from_taxonomy_category('academic_cat', 'academic-programs', 100, 'menu_order', 'ASC'); ?>
						<?php $icons_array = get_tab_list($programs, '', TRUE) ?>
						<?php echo get_tab_list_template($icons_array, TRUE); ?>
					</ul>
				</div>

				<div class="col tab-content">
					<div class="container">
						<?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
						<?php include(locate_template('/template-parts/page_info.php')); ?>

						<?php $course_list = query_posts_by_post_type('degree', $post->ID); ?>
						<?php include(locate_template('/template-parts/course_list.php')); ?>

						<section id="knowmore-faculty-button" class="center-align">
							<?php echo make_blue_btn('', __('Know More About ').$post->post_title); ?>
							<!-- PENDING FIX WHEN FACULTY PAGE IS CREATED -->
						</section>

						<section id="back-button" class="center-align">
							<?php echo make_course_back_button($post->post_type) ?>
						</section>
					</div>
				</div>

			</div>
		</article>

		

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
