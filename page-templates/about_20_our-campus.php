<?php
/*
Template Name: About > Our Campus (Page)
*/
get_header(); 
//var_dump(get_post_meta($post->ID));
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php include(locate_template('/template-parts/header_banner.php')); ?>

		<!-- WP -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="container-wide">
				<section>
					<div class="row">
					<?php $campuses = get_campus_details ('all'); ?>
					<?php if (!empty($campuses)): ?>
						<?php foreach ($campuses as $campus): ?>
							<div class="col s12 m4 match-height simple-tables">
								<div class="thead center-align">
		              <img src="<?php echo $campus['image']; ?>" alt="<?php echo $campus['title']; ?>" title="<?php echo $campus['title']; ?>" />
		              <div class="title"><?php echo $campus['title'] ?></div>
		            </div>
		            <div class="tbody campus-tbody">
		              <div class="col s12 center-align small-text">
		                <?php echo $campus['desc'] ?>
		              </div>
		            </div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
					</div>
				</section>
			</div>
			


		</article><!-- #post-## -->

	</main><!-- .site-main -->

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
