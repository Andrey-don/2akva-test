<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage diodic
 * @since diodic
 */
get_header();?>


<div <?php post_class('cont-sec'); ?>>
	<div class="wide-blk">
		<div class="tov-flex">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="news-blk">
					<?php if(has_post_thumbnail()): ?>
						<?php $post_id = get_the_ID(); ?>
						<div class="news-img" style="background-image: url('<?php echo get_the_post_thumbnail_url($post_id, 'full' );?>');"></div>
					<?php endif; ?>
					<div class="div-block-6">
						<h4 class="heading-3"><?php the_title(); ?></h4>
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="info-btn w-button">подробнее</a>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php get_footer();?>