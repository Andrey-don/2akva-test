<?php
/**
 * Template name: Оборудование подробнее
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
					<?php 
					$cur_id = get_the_ID();
					$childrens = get_children(array('post_parent' => $cur_id,'post_type' => 'equipmente','numberposts' => -1));
					if($childrens){ ?>
						<div class="tov-flex">
							<?php foreach( $childrens as $children ){
								$post_id = $children->ID; 
								$area_of_use_icon = get_field('area_of_use_icon',$post_id); ?>
								<div class="tov-chld">
									<div class="tov-img" style="background-image: url('<?php echo get_the_post_thumbnail_url($post_id, 'full' );?>');"></div>
									<div class="div-block-4">
										<a href="<?php the_permalink($post_id) ?>" class="tov-link"><?=$children->post_title ?></a>
										<?php echo kama_excerpt(array('maxchar'=>150,'text'=>$children->post_content)); ?><a href="<?php the_permalink($post_id) ?>" class="info-btn w-button">подробнее</a>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php }
					else{
						?>
						<?php $questionnaire = get_field('questionnaire'); ?>
						<?php if($questionnaire): ?>
							<div class="cta-div">
								<a href="<?=$questionnaire?>" class="cont-btn w-inline-block">
									<img src="<?=SPEC_IMAGES?>/doc.svg" alt="" class="btn-icn">
									<div>Посмотреть каталог</div>
								</a>
							</div>
						<?php endif; ?>
						<?php $post_id = get_the_ID();
						$thumbnail_url = get_the_post_thumbnail_url($post_id, 'full' );?>
						<?php if($thumbnail_url): ?>
							<div class="photo-div" style="background-image: url('<?php echo $thumbnail_url;?>');"></div>
						<?php endif; ?>
						<div class="w-richtext">
							<?php the_content(); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php endwhile; ?>
	</div>

<?php get_footer();?>