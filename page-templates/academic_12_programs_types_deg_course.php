<?php
/*
Template Name: Academics > Programs > Types > Degree > Courses (Page)
*/

get_header(); 

global $_localization_array; 

?>


<div id="primary" class="content-area is-course">
	<main id="main" class="site-main" role="main">
	<?php get_template_part( '/template-parts/academic_banner'); ?>

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
						<?php 
							$program_structure_url = wp_get_attachment_url( get_meta($post->ID, 'program_structure_link' ));
							$program_objective = get_meta($post->ID, 'program_objective');
							$program_outcome = get_meta($post->ID, 'program_outcome');
							$apply_now_link = get_permalink(get_meta($post->ID, 'apply_now_page_id'));
						?>
						<section id="program-info" class="">
							<?php $page = get_page_info($post->ID, $post->post_title); //page_info.php dependency ?>
							<?php include(locate_template('/template-parts/page_info.php')); ?>

							<div class="center-align margin-s">
								<?php echo make_blue_btn($program_structure_url, __('View Programme Structure', 'multimedia'), TRUE) ?>
							</div>
							<hr class=""></hr>
						</section>

						<?php if(!empty($program_objective)): ?>
							<section id="program-objective" class="">
								<div class="mmu-page-icon mmu-objective"></div>
								<h2 class="mmu-"><?php _e('Programme Educational Objectives', 'multimedia') ?></h2>
								<div class=""><?php echo mmuautop($program_objective) ?></div>
								<hr class=""></hr>
							</section>
						<?php endif; ?>

						<?php if(!empty($program_outcome)): ?>
							<section id="program-outcome" class="">
								<div class="mmu-page-icon mmu-outcome"></div>
								<h2 class=""><?php _e('Programme Outcomes', 'multimedia') ?></h2>
								<div class=""><?php echo mmuautop($program_outcome) ?></div>
								<hr class=""></hr>
							</section>
						<?php endif; ?>

						<section id="program-requirement" class="">
							<div class="mmu-page-icon mmu-requirement"></div>
							<h2 class=""><?php _e('Entry Requirements', 'multimedia') ?></h2>
							<div class="second-tab">
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

							<div class="center-align margin-s">
								<?php echo make_blue_btn($apply_now_link, __('Apply Now', 'multimedia')) ?>
							</div>

						<hr class=""></hr>
						</section>

						<?php if (!empty(get_meta($post->ID, 'campus_id'))): ?>
							<section id="program-availability" class="">
								<div class="mmu-page-icon mmu-availability"></div>
								<h2 class=""><?php _e('Programme Availability', 'multimedia') //_e('Available at', 'multimedia') ?></h2>
								<?php $campus_details = get_campus_details(get_meta($post->ID, 'campus_id')); ?>
								<?php foreach ($campus_details as $campus): ?>
									<?php include(locate_template('/template-parts/campus.php')); ?>
								<?php endforeach; ?>
							</section>
						<?php endif; ?>

						<section id="back-button" class="center-align">
							<?php echo make_course_back_button($post->post_type, $post) ?>
						</section>

					</div>
				</div>

			</div>

		

		</article><!-- #post-## -->

	</main><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
