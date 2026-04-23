<!-- Search Form -->
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="email-form" name="email-form" data-name="Email Form" class="form" method="get" role="search">
	<input type="text" class="seach-input w-input" maxlength="256" name="s" data-name="seach" placeholder="Поиск по сайту" id="s" value="<?php echo get_search_query() ?>" title="<?php echo esc_attr_x( 'Поиск для:', 'label' ) ?>" placeholder="Поиск...">
	<input type="submit" value="найти" data-wait="Please wait..." class="seach-btn w-button">
</form>
<!-- Search form EOF -->