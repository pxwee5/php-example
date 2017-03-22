<?php
/*
Template Name: Admission > Fees (Page)
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
				<div class="col s10 offset-s1 m6 offset-m3">
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
							
							<section>
								<ul class="collapsible" data-collapsible="accordion">
									<?php $fees_array = get_fees_array($post->ID, 'intl') ?>

									<?php foreach($fees_array as $accordion): ?>
										<li>
											<div class="collapsible-header">
												<span class="collapsible-icon"><?php echo $accordion['normal'].$accordion['color'] ?></span>
												<span class="collapsible-title"><?php echo $accordion['title'] ?></span>
												<span class="dashicons"></span>
											</div>
											<div class="collapsible-body">
												<div class="container">
													<?php if (!empty($accordion['content'])): ?>
														<?php foreach ($accordion['content'] as $component): ?>
															<div class="margin-xs">
																<?php 
																	if (key($component) == 'table') {
																		include_table($component['table'], 'layout-fees');
																	} else if (key($component) == 'notes') {
																		echo '<div class="collapsible-notes">'.$component['notes'].'</div>';
																	}
															  ?> 
														  </div>
														<?php endforeach; ?>
													<?php endif; ?>
													
													<div class="margin-xs center-align">
														<?php echo make_blue_btn(get_permalink(get_meta($post->ID,'payment_id')), __('Make A Payment', 'multimedia'), FALSE); ?>
													</div>
												</div>
												
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</section>

						</div><!-- END INTERNATIONAL -->



						<!-- START LOCAL -->
						<div id="local" class="tab-content-local">

							<section>
								<ul class="collapsible" data-collapsible="accordion">
									<?php $fees_array = get_fees_array($post->ID, 'local') ?>

									<?php foreach($fees_array as $accordion): ?>
										<li>
											<div class="collapsible-header">
												<span class="collapsible-icon"><?php echo $accordion['normal'].$accordion['color'] ?></span>
												<span class="collapsible-title"><?php echo $accordion['title'] ?></span>
												<span class="dashicons"></span>
											</div>
											<div class="collapsible-body">
												<div class="container">
													<?php if (!empty($accordion['content'])): ?>
														<?php foreach ($accordion['content'] as $component): ?>
															<div class="margin-xs">
																<?php 
																	if (key($component) == 'table') {
																		include_table($component['table'], 'layout-fees');
																	} else if (key($component) == 'notes') {
																		echo '<div class="collapsible-notes">'.$component['notes'].'</div>';
																	}
															  ?> 
														  </div>
														<?php endforeach; ?>
													<?php endif; ?>
													
													<div class="margin-xs center-align">
														<?php echo make_blue_btn(get_permalink(get_meta($post->ID,'payment_id')), __('Make A Payment', 'multimedia'), FALSE); ?>
													</div>
												</div>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</section>

						</div><!-- END LOCAL -->

					</div>
				</div>

			</div>

			<div class="footer center-align padding-m">
					<div class="margin-xs"><?php echo get_meta($post->ID, 'financial_assistance_text') ?></div>
					<div class="margin-xs"><?php echo make_white_btn(get_permalink(get_meta($post->ID,'financial_assistance_id')), __('Get Financial Assistance', 'multimedia'), TRUE); ?></div>
			</div>




		</article><!-- #post-## -->

	</main><!-- .site-main -->

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
