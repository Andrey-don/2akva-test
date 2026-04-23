<?php
/**
 * @package WordPress
 * @subpackage 2akva
 * @since 2akva
 */
?>
<!DOCTYPE html>
<html lang="ru-RU" data-wf-page="5bd980176fd44c11279ad6dd" data-wf-site="5bd980176fd44ca92a9ad6de">
<head>
	<meta name="google-site-verification" content="pZAyHfSjBF0OkIu5HLCz_RmW-IQtsGLPMWz-tdDdNaA" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta content="Webflow" name="generator">
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(64700338, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/64700338" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-168703038-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-168703038-1');
</script>
	<title><?php wp_title('&laquo;', true, 'right'); ?></title>
	<?php wp_head(); ?>

	<link href="<?=SPEC_BASE_URL?>/images/favicon.jpg" rel="shortcut icon" type="image/x-icon">
	<link href="<?=SPEC_BASE_URL?>/images/webclip.jpg" rel="apple-touch-icon">
	<link href="<?=SPEC_BASE_URL?>/images/webclip.jpg" rel="apple-touch-icon-precomposed">
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>"/>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(99207484, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/99207484" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
</head>
<body <?php body_class("body"); ?>>
	<?php if(is_front_page()): ?>
		<div class="topsec">
	<?php else: ?>
		<div class="topsec inside">
	<?php endif; ?>
		<div id="top" class="top-blk">
			<a href="<?=HOME_URL?>" class="logo-linl-blk w-inline-block">
				<img src="<?=SPEC_IMAGES?>/logo.svg" alt="" class="image">
			</a>
			<?php $header_text1 = get_field('header_text1',42); ?>
			<?php $header_text2 = get_field('header_text2',42); ?>
			<?php $header_phone = get_field('header_phone',42); ?>
			<div class="top-title-div">
				<?php if($header_text1): ?>
					<div class="text-block-3"><?=$header_text1?></div>
				<?php endif; ?>
				<?php if($header_text2): ?>
					<div class="text-block-3"><?=$header_text2?></div>
				<?php endif; ?>
			</div>
			<div class="phone-txt w-hidden-medium w-hidden-small w-hidden-tiny">
				<?php if($header_phone): ?>
					<div class="phone-num"><?=$header_phone?></div>
				<?php endif; ?>
				<a href="#" class="call-btn w-button" data-ix="open-modal">заказать звонок</a>
			</div>
		</div>
		<div data-collapse="medium" data-animation="default" data-duration="400" class="navbar w-nav">
			<div class="container w-container">
                <?php header_nav_menu(); ?>
				<!-- <nav role="navigation" class="navmenu w-nav-menu">
					<a href="<?=HOME_URL?>/o-kompanii/" class="navlink w-nav-link">О компании</a>
					<div data-delay="0" data-hover="1" class="w-dropdown">
						<div class="navlink w-dropdown-toggle">
							<div class="w-icon-dropdown-toggle"></div>
							<div>Оборудование</div>
						</div>
						<nav class="dropdown-list w-dropdown-list">
							<a href="<?=HOME_URL?>/equipmente/cepnye-skrepery/" class="dlink w-dropdown-link">Цепные скреперы</a>
							<a href="<?=HOME_URL?>/equipmente/modulnaja-drenazhnaja-sistema-2h-geodek/" class="dlink w-dropdown-link">Модульная дренажная система 2H GEOdek™</a>
							<a href="<?=HOME_URL?>/equipmente/giperboloidnye-meshalki-hyperclassic/" class="dlink w-dropdown-link">Гиперболоидные мешалки HYPERCLASSIC®</a>
							<a href="<?=HOME_URL?>/equipmente/komponenty-i-zagruzki-dlja-gradiren-2h/" class="dlink w-dropdown-link">Компоненты и загрузки для градирен 2H</a>
							<a href="<?=HOME_URL?>/equipmente/biodek-zagruzki-dlja-prikreplenija-i-razvitija-bioplenki/" class="dlink w-dropdown-link">BIOdek® — загрузки для прикрепления и развития биопленки</a>
							<a href="<?=HOME_URL?>/equipmente/tonkoslojnye-filtry-separatory-2h-tubedek/" class="dlink w-dropdown-link">Тонкослойные фильтры сепараторы 2H TUBEdek®</a>
						</nav>
					</div>
					<div data-delay="0" data-hover="1" class="w-dropdown">
						<div class="navlink w-dropdown-toggle">
							<div class="w-icon-dropdown-toggle"></div>
							<div>Применение</div>
						</div>
						<nav class="dropdown-list w-dropdown-list">
							<a href="<?=HOME_URL?>/areas_of_use/radialnye-otstojniki/" class="dlink w-dropdown-link">Радиальные отстойники</a>
							<a href="<?=HOME_URL?>/areas_of_use/ochistka-oborotnyh-vod-v-rybnom-hozjajstve/" class="dlink w-dropdown-link">Очистка оборотных вод в рыбном хозяйстве</a>
							<a href="<?=HOME_URL?>/areas_of_use/ochistka-stochnyh-vod-na-galvanicheskom-proizvodstve/" class="dlink w-dropdown-link">Очистка сточных вод на гальваническом производстве</a>
							<a href="<?=HOME_URL?>/areas_of_use/biologicheskaja-ochistka-stochnyh-vod/" class="dlink w-dropdown-link">Биологическая очистка сточных вод</a>
							<a href="<?=HOME_URL?>/areas_of_use/ochistka-promyshlennyh-stochnyh-vod/" class="dlink w-dropdown-link">Очистка промышленных сточных вод</a>
							<a href="<?=HOME_URL?>/areas_of_use/ochistka-pitevoj-vody/" class="dlink w-dropdown-link">Очистка питьевой воды</a>
						</nav>
					</div>
					<a href="<?=HOME_URL?>/kontakty" class="navlink w-nav-link">контакты</a>
				</nav> -->
				<div class="menu-button w-nav-button">
					<div class="w-icon-nav-menu"></div>
				</div>
				<div class="seach-div w-hidden-small w-hidden-tiny">
					<div class="form-block w-form">
						<?php get_search_form(); ?>
					</div>
				</div>
				<div class="phone-txt-copy w-hidden-main">
					<div class="phone-num">+7812 245 60 06</div><a href="#" class="call-btn w-button">заказать звонок</a></div>
			</div>
		</div>
		<?php if(is_front_page()): ?>
			<div class="div-block">
				<div data-delay="10000" data-animation="cross" data-autoplay="1" data-disable-swipe="1" data-duration="1000" data-infinite="1" class="slider w-slider">
					<div class="w-slider-mask">
						<?php if( have_rows('slider',42) ): ?>
							<?php while( have_rows('slider',42) ) : the_row(); ?>
								<div class="slide w-slide" style="background-image: linear-gradient(0deg, transparent, rgba(249, 249, 249, 0.31) 51%, rgba(255, 255, 255, 0.9) 73%, rgb(255, 255, 255)), url(<?php the_sub_field('slide_image') ?>);">
									<div class="div-block-2">
										<div class="top-cont-div">
											<h2 class="hero-titile"><?php the_sub_field('slide_header') ?></h2>
											<div class="div-block-3">
												<div class="text-block-6"><?php the_sub_field('slide_text') ?></div><a href="#" class="cta-btn w-button" data-ix="open-modal">задать вопрос инженеру</a></div>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
					<div class="left-arrow w-slider-arrow-left">
						<div class="w-icon-slider-left"></div>
					</div>
					<div class="right-arrow w-slider-arrow-right">
						<div class="w-icon-slider-right"></div>
					</div>
					<div class="slide-nav-2 w-slider-nav w-round"></div>
				</div>
			</div>
		<?php else: ?>
			<div class="titile-div">
				<?php if ( is_archive()): ?>
					<h2 class="heading-4"><?php the_archive_title(''); ?></h2>
				<?php else: ?>
					<h2 class="heading-4"><?php the_title(); ?></h2>
				<?php endif; ?>


				<div class="bread-div">
					<?php kama_breadcrumbs('&gt;'); ?>
					<!-- <a href="<?=HOME_URL?>" class="breadlink">Главная</a>
					<div class="text-block-8">&gt;</div>
					<a href="o-kompanii.html" class="breadlink w--current">О компании</a> -->
				</div>
			</div>
		<?php endif; ?>
	</div>