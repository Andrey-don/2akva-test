<?php
/**
 * Displays 404 page
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
				<h1 class="text-center">404</h1>
				<div class="w-richtext">
					<p>Страница не найдена или была перемещена. Попробуйте воспользоваться меню.</p>
					<p class="text-center"><a href="<?=HOME_URL?>">На главную</a></p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer();?>