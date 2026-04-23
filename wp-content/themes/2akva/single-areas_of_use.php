<?php
/**
 * Template name: Применение подробнее
 *
 * @package WordPress
 * @subpackage 2akva
 * @since 2akva
 */
get_header();?>

	<div class="cont-sec">
		<?php while (have_posts()): the_post(); ?>
			<div class="content-div">
				<?php get_sidebar('left'); ?>
				<div class="catalog-div">
					<?php $questionnaire = get_field('questionnaire'); ?>
					<?php if($questionnaire): ?>
						<div class="cta-div">
							<a href="<?=$questionnaire?>" class="cont-btn w-inline-block">
								<img src="<?=SPEC_IMAGES?>/doc.svg" alt="" class="btn-icn">
								<div>скачать опросный лист на подбор оборудования</div>
							</a>
						</div>
					<?php endif; ?>
					<?php $post_id = get_the_ID(); ?>
					<div class="photo-div" style="background-image: url('<?php echo get_the_post_thumbnail_url($post_id, 'full' );?>');"></div>
					<div class="w-richtext">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>

<?php get_footer();?>