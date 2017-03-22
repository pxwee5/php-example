<?php
/*
Template Name: Admission > Financial Assistance (Page)
*/

get_header(); 

$icon_1 = array('normal'	=> wp_get_attachment_image(get_meta($post->ID, 'icon_normal_0'), 'full', '', array('class' => 'mmu-icon-normal')),
								'hover' 	=> wp_get_attachment_image(get_meta($post->ID, 'icon_hover_0'), 'full','', array('class' => 'mmu-icon-hover')),
								'title'		=> __('Loan', 'multimedia'), 
								'slug'		=> 'loan',
								'link'		=> '#loan',
								'active'	=> '');
$icon_2 = array('normal'	=> wp_get_attachment_image(get_meta($post->ID, 'icon_normal_1'), 'full', '', array('class' => 'mmu-icon-normal')),
								'hover' 	=> wp_get_attachment_image(get_meta($post->ID, 'icon_hover_1'), 'full','', array('class' => 'mmu-icon-hover')),
								'title'		=> __('Scholarship', 'multimedia'), 
								'slug'		=> 'scholarship', 
								'link'		=> '#scholarship',
								'active'	=> '');
$icon_3 = array('normal'	=> wp_get_attachment_image(get_meta($post->ID, 'icon_normal_2'), 'full', '', array('class' => 'mmu-icon-normal')),
								'hover' 	=> wp_get_attachment_image(get_meta($post->ID, 'icon_hover_2'), 'full','', array('class' => 'mmu-icon-hover')),
								'title'		=> __('Bursary', 'multimedia'), 
								'slug'		=> 'bursary', 
								'link'		=> '#bursary',
								'active'	=> '');
$icons_array = array($icon_1, $icon_2, $icon_3);

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php include(locate_template('/template-parts/header_banner.php')); ?>

		<!-- WP -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="row first-tab">
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<ul class="tabs mmu-icon-tabs" > <!-- Removed .tab to disable tabbing function. -->
						<?php echo get_tab_list_template($icons_array); ?>
					</ul>
				</div>

				<!-- Tab Contents -->
				<div class="tab-content">
					<div class="container">
						<?php $tab_arrays = get_financial_assistance_array($post->ID); ?>

						<?php foreach($icons_array as $key => $tab_content): ?>
							<div id="<?php echo $tab_content['slug'] ?>">
								<?php $page = $tab_arrays[$key]['page_info'] ?>
								<?php include(locate_template('/template-parts/page_info.php')); ?>
								
								<ul class="collapsible" data-collapsible="accordion">
									<?php if (!empty($tab_arrays[$key]['accordion'])): ?>
										<?php foreach($tab_arrays[$key]['accordion'] as $item): ?>
											<li>
												<div class="collapsible-header">
													<!-- <span class="collapsible-icon"></span> -->
													<span class="collapsible-title"><?php echo $item['title'] ?></span>
													<span class="dashicons"></span>
												</div>
												<div class="collapsible-body">
													<div class="container">
														<?php foreach($item['content'] as $key => $component): ?>
															<div class="margin-s">
																<?php 
																	if (key($component) == 'table') {
																		include_table(json_decode($component['table'], TRUE));
																	} else if (key($component) == 'text') {
																		echo '<div class="">'.mmuautop($component['text']).'</div>';
																	} else if (key($component) == 'container_text') {
																		echo '<div class="container-text">'.$component['container_text'].'</div>';
																	} else if (key($component) == 'three_circles') {
																		echo '<div class="">'.$component['three_circles'].'</div>';
																	}
															 	?>
															</div>
														<?php endforeach; ?>
													</div>
												</div>
											</li>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>

							</div>
						<?php endforeach; ?>

					</div>
				</div>
			</div>


		</article><!-- #post-## -->

	</main><!-- .site-main -->

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
