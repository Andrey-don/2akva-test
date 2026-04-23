<?php
/**
 * Template name: Архив применения
 *
 * @package WordPress
 * @subpackage 2akva
 * @since 2akva
 */
get_header();?>

	<div <?php post_class('cont-sec') ?>>
		<div class="content-div">
			<?php get_sidebar('left'); ?>
			<div class="prim-flex">
				<?php if (have_posts()):
					while(have_posts()) : the_post();
						$area_of_use_icon = get_field('area_of_use_icon'); ?>
						<a href="<?php the_permalink() ?>" class="prim-chld-copy w-inline-block">
							<div class="prim-img"><img src="<?=$area_of_use_icon?>" alt="" class="image-3">
								<div class="div-block-7"></div>
							</div>
							<div><?php the_title(); ?></div>
						</a>
					<?php endwhile; ?>
				<?php endif; ?>
				<br><br><br><br>
				<?php $oblasti_primenenija = get_field('oblasti_primenenija',46);
					if( $oblasti_primenenija ):
						foreach ($oblasti_primenenija as $key => $value) {
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
						<?php $questionnaire = get_field('questionnaire',46);
						$questionnaire_url = is_array($questionnaire) ? $questionnaire['url'] : $questionnaire; ?>
						<?php if($questionnaire_url): ?>
							<div class="cta-div">
								<a href="<?=$questionnaire_url?>" class="cont-btn w-inline-block">
									<img src="<?=SPEC_IMAGES?>/doc.svg" alt="" class="btn-icn">
									<div>скачать опросный лист на подбор оборудования</div>
								</a>
							</div>
						<?php endif; ?>
						<div class="w-richtext">
							<?php $post = get_post(46);
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