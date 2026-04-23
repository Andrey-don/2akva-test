<?php
/**
 * Template name: Шаблон о компании
 *
 * @package WordPress
 * @subpackage 2akva
 * @since 2akva
 */
get_header();?>


	<div class="cont-sec">
		<?php while (have_posts()) : the_post(); ?>
		<div class="content-div">
			<div class="main-wrap">
				<?php $post_id = get_the_ID(); ?>
				<?php if(has_post_thumbnail()): ?>
					<div class="photo-div" style="background-image: url('<?php echo get_the_post_thumbnail_url($post_id, 'full' );?>');"></div>
				<?php endif; ?>
				<div class="w-richtext">
					<?php the_content(); ?>
				</div>
			</div>
			<?php get_sidebar('right'); ?>
		</div>
		<div class="wide-blk-2">
			<?php $reviews = get_field('reviews'); ?>
			<?php if($reviews): $index1 = 0; ?>
				<h2 class="heading-2">Наши партнеры и отзывы</h2>
				<div data-animation="slide" data-duration="500" data-infinite="1" class="slider-2 w-slider">
					<div class="mask w-slider-mask">
						<?php foreach ($reviews as $key => $value) {
							if($index1 % 2==0) echo '<div class="w-slide"><div class="tov-flex-copy">';
							$review_name 	 = $value['review_name'];
							$review_position = $value['review_position'];
							$review_text 	 = $value['review_text'];
							$review_image 	 = $value['review_image']; ?>
							<div class="otziv-div-2 index<?=$index1?>">
								<div class="otziv-ing-2">
									<div><strong><?=$review_name?></strong><br><?=$review_position?></div>
								</div>
								<div class="div-block-6">
									<?=$review_text;?>
									<?php if($review_image): ?>
										<img src="<?=$review_image;?>" width="126" alt="">
									<?php endif; ?>
								</div>
							</div>
							<?php $index1++;if($index1 % 2==0) echo '</div></div><!--'.$index1.'-->';
						}
						if($index1 % 2!=0) echo '</div></div>'; ?>
					</div>
					<div class="arrow-2 w-slider-arrow-left">
						<div class="w-icon-slider-left"></div>
					</div>
					<div class="arrow-2 w-slider-arrow-right">
						<div class="w-icon-slider-right"></div>
					</div>
					<div class="slide-nav w-slider-nav w-shadow w-round"></div>
				</div>
			<?php endif; ?>
			<h2 class="heading-2">Ведущие промышленные компании</h2>
			<div class="text-block-7">Используют оборудование и решения 2H Akva</div>
			<div class="client-flex">
				<?php if(have_rows('partners')): ?>
					<?php while (have_rows('partners')) : the_row();
						$partner = get_sub_field('partner'); ?>
						<div class="client-chld">
							<img src="<?=$partner?>" alt="" class="image-4">
						</div>
					<?php endwhile ?>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
	</div>

<?php get_footer();?>