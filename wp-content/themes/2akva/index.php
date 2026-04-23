<?php
/**
 * Displays single page
 *
 * @package WordPress
 * @subpackage 2akva
 * @since 2akva
 */
get_header();?>

<div class="cont-sec">
	<div class="content-div">
		<div class="main-wrap">
			<?php $post_id = get_the_ID(); ?>
			<?php if(has_post_thumbnail()): ?>
				<div class="photo-div" style="background-image: url('<?php echo get_the_post_thumbnail_url($post_id, 'full' );?>');"></div>
			<?php endif; ?>
			<div class="w-richtext">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer();?>