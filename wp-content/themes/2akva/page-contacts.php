<?php
/**
 * Template name: Шаблон контакты
 *
 * @package WordPress
 * @subpackage 2akva
 * @since 2akva
 */
get_header();?>

<div class="cont-sec">
	<div class="content-div">
		<div class="main-wrap">
			<div class="w-richtext">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
			<div class="map-div">
				<div class="w-embed w-script">
					<script type="text/javascript" charset="utf-8" async="" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A34d61a1d32fdbd0ffb848a370e3e2e329f265b0bba5d8b9abc04f4878585335b&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
				</div>
			</div>
		</div>
		<?php get_sidebar('right'); ?>
	</div>
</div>

<?php get_footer();?>