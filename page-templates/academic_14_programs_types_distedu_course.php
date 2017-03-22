<?php
/*
Template Name: Academics > Programs > Types > Distance Edu. > Courses (Page)
*/


get_header(); 

//Debug
//var_dump($fields);
?>

<div id="primary" class="content-area is-course">
	<main id="main" class="site-main" role="main">
	<?php include(locate_template('/template-parts/academic_banner.php')); ?>

		<!-- WP -->
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

						<section id="program-info" class="row">
							<?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
							<?php include(locate_template('/template-parts/page_info.php')); ?>
						</section>

						<div class="center-align margin-s margin-xtop row">
							<?php $program_structure_url = wp_get_attachment_url( get_meta($post->ID, 'program_structure_link' )); ?>
							<?php echo make_blue_btn($program_structure_url, __('View Programme Structure', 'multimedia')) ?>
						</div>

						<section id="program-requirement" class="row">
							<div class="col s12">
								<div class="mmu-page-icon mmu-requirement"></div>
								<h2 class="center-align with-icon"><?php _e('Entry Requirements', 'multimedia') ?></h2>
								<div class="row second-tab">
									<div class="col s12 l8 offset-l2">
										<ul class="tabs mmu-icon-tabs">
											<?php get_tab_list_template($_localization_array); ?>
										</ul>
									</div>
									<div class="col tab-content">
										<?php $requirements = array('intl'  => get_requirement_data(get_meta($post->ID, 'entry_req_page_id'), 'intl', $post->post_type),
																								'local' => get_requirement_data(get_meta($post->ID, 'entry_req_page_id'), 'local', $post->post_type)); ?>

										<?php foreach ($requirements as $key => $req): ?>
											<div id="<?php echo $key ?>">
												<?php if (empty($req)): ?>
													<?php 
														if ($key == 'intl') {
															echo $_intl_not_available;
														} else if ($key == 'local') {
															echo $_local_not_available;
														}
													?>
												<?php else: ?>
													<?php echo $req['content']; ?>
												<?php endif; ?>
											</div>
										<?php endforeach; ?>
									</div>  
								</div>
							</div>
						</section>


					</div>
				</div>

			</div>



			</div>  

		</article><!-- #post-## -->

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
