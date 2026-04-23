<?php
/**
 * Template name: Архив оборудования
 *
 * @package WordPress
 * @subpackage 2akva
 * @since 2akva
 */
get_header();?>

	<div <?php post_class('cont-sec') ?>>
		<div class="content-div">
			<?php get_sidebar('left'); ?>
			<div class="tov-flex">
				<?php if (have_posts()):
					while(have_posts()) : the_post();
						$post_id = get_the_ID(); 
						if(get_post_status( $post_id )!='publish')
							continue;
						$area_of_use_icon = get_field('area_of_use_icon'); ?>
						<div class="tov-chld">
							<?php //echo $post_id; ?>
							<div class="tov-img" style="background-image: url('<?php echo get_the_post_thumbnail_url($post_id, 'full' );?>');"></div>
							<div class="div-block-4">
								<a href="<?php the_permalink() ?>" class="tov-link"><?php the_title(); ?></a>
								<p><?php do_excerpt(get_the_content(),150); ?></p><a href="<?php the_permalink() ?>" class="info-btn w-button">подробнее</a>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<br>
				<br>
				<br>

				<?php $oborudovanie = get_field('oborudovanie',2);
				if( $oborudovanie ):
					foreach ($oborudovanie as $key => $value) {
						$item_img = $value['item_img'];
						$item_header = $value['item_header'];
						$item_text = $value['item_text'];
						$item_link = $value['item_link']; ?>
						<div class="tov-chld">
							<div class="tov-img" style="background-image: url('<?=$item_img ?>');"></div>
							<div class="div-block-4">
								<a href="<?= $item_link ?>" class="tov-link"><?= $item_header ?></a>
								<p><?= $item_text ?></p><a href="<?= $item_link ?>" class="info-btn w-button">подробнее</a>
							</div>
						</div>
					<?php }
				endif; ?>
			</div>
		</div>
		<div class="wide-blk-copy">
			<div class="div-block-10">
				<div class="content-div-copy">
					<div class="main-wrap">
						<?php $questionnaire = get_field('questionnaire',2); ?>
						<?php if($questionnaire): ?>
							<div class="cta-div">
								<a href="<?=$questionnaire?>" class="cont-btn w-inline-block">
									<img src="<?=SPEC_IMAGES?>/doc.svg" alt="" class="btn-icn">
									<div>скачать опросный лист на подбор оборудования</div>
								</a>
							</div>
						<?php endif; ?>
						<div class="w-richtext">
							<?php $post = get_post(2);
							echo $post->post_content;
							?>
						</div>
					</div>
					<?php get_sidebar('right'); ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer();?>