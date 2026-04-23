<?php 
/**
* Functions and definitions
*
*/

// убираем первый пункт админ бара со ссылками на WP
function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );


// Удаление параметра ver из добавляемых скриптов и стилей
function rem_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'rem_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'rem_wp_ver_css_js', 9999 );


// Удаление параметра ver из добавляемых скриптов и стилей
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','wp_generator');
add_filter('the_generator', '__return_empty_string');

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

remove_action( 'wp_head','wp_shortlink_wp_head', 10, 0 ); 


# выводим время генерации, запросы и потребление памяти
// function usage(){
// printf( ('SQL запросов:%d. Время генерации:%s сек. Потребление памяти:'), get_num_queries(), timer_stop(0, 3) );
// if ( function_exists('memory_get_usage') ) echo round( memory_get_usage()/1024/1024, 2 ) . ' mb ';
// }
// add_filter('admin_footer_text', 'usage');
// add_filter('wp_footer', 'usage');


// Отключение обновления темы
remove_action('load-update-core.php','wp_update_themes');
add_filter('pre_site_transient_update_themes', function($a) {
    return null;
});
wp_clear_scheduled_hook('wp_update_themes');


// // Отключение обновления плагинов
// remove_action( 'load-plugins.php', 'wp_update_plugins' );
// remove_action( 'load-update.php', 'wp_update_plugins' );
// remove_action( 'admin_init', '_maybe_update_plugins' );
// remove_action( 'wp_update_plugins', 'wp_update_plugins' );
// add_filter( 'pre_transient_update_plugins', create_function( '$a',
// "return null;" ) );


// // Отключение обновления движка
// remove_action( 'wp_version_check', 'wp_version_check' );
// remove_action( 'admin_init', '_maybe_update_core' );
// add_filter( 'pre_transient_update_core', create_function( '$a',
// "return null;" ) );

// // Отключаем вывод "новых обновлений"
// add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
// wp_clear_scheduled_hook('wp_version_check');
// remove_action( 'load-update-core.php', 'wp_update_plugins' );
// add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ));

// Отключаем RSS
function fb_disable_feed() {
wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}
add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);

// Удаляем лишние теги
// remove_filter( 'the_content', 'wpautop' );
// remove_filter( 'the_excerpt', 'wpautop' );
remove_filter( 'the_excerpt', 'wptexturize'); // Отключаем автоформатирование в кратком(анонсе) посте


// Выпиливаем админ бар у всех пользователей:
// function disable_admin_bar() {
//     add_filter( 'show_admin_bar', '__return_false' );
//     add_action( 'admin_print_scripts-profile.php',
//         'hide_admin_bar_settings' );
// }
// add_action( 'init', 'disable_admin_bar' , 9 );



// Замена лого при логине
function my_login_logo(){
echo '<style type="text/css">#login h1 a { background: url(/images/logo_color_small.svg) no-repeat 0 0 !important; height: 135px; width: 195px; }</style>';
}
add_filter('login_headerurl', function() {
    return get_home_url();
});

add_filter('login_headertitle', function() {
    return "Ваше описание";
});




// Отменить регистрацию ненужных виджетов
// add_action('widgets_init', 'unregister_default_widgets', 11);
// function unregister_default_widgets() {
//   unregister_widget('WP_Widget_Pages');
//   unregister_widget('WP_Widget_Calendar');
//   unregister_widget('WP_Widget_Archives');
//   unregister_widget('WP_Widget_Links');
//   unregister_widget('WP_Widget_Meta');
//   unregister_widget('WP_Widget_Recent_Comments');
//   unregister_widget('WP_Widget_RSS');
//   unregister_widget('WP_Widget_Tag_Cloud');
//   unregister_widget('Akismet_Widget');
// }


// allow SVG uploads
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
    $existing_mimes['svg'] = 'image/svg+xml';
    return $existing_mimes;
}
function fix_svg() {
    echo '<style type="text/css">.attachment-266x266,.thumbnail img{width:100% !important;height:auto !important;}
        </style>';}
add_action('admin_head', 'fix_svg');
// allow SVG uploads END


/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param string/array $args Параметры.
 *
 * @return string HTML
 *
 * @ver 2.6.3
 */
function kama_excerpt( $args = '' ){
    global $post;

    if( is_string($args) )
        parse_str( $args, $args );

    $rg = (object) array_merge( array(
        'maxchar'   => 350,   // Макс. количество символов.
        'text'      => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
                              // Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется все до <!--more--> вместе с HTML.
        'autop'     => true,  // Заменить переносы строк на <p> и <br> или нет?
        'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
        'more_text' => 'Читать дальше...', // Текст ссылки `Читать дальше`.
    ), $args );

    $rg = apply_filters( 'kama_excerpt_args', $rg );

    if( ! $rg->text )
        $rg->text = $post->post_excerpt ?: $post->post_content;

    $text = $rg->text;
    $text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text ); // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
    $text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text ); // убираем шоткоды: [singlepic id=3]. Учитывает markdown
    $text = trim( $text );

    // <!--more-->
    if( strpos( $text, '<!--more-->') ){
        preg_match('/(.*)<!--more-->/s', $text, $mm );

        $text = trim( $mm[1] );

        $text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
    }
    // text, excerpt, content
    else {
        $text = trim( strip_tags($text, $rg->save_tags) );

        // Обрезаем
        if( mb_strlen($text) > $rg->maxchar ){
            $text = mb_substr( $text, 0, $rg->maxchar );
            $text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
        }
    }

    // Сохраняем переносы строк. Упрощенный аналог wpautop()
    if( $rg->autop ){
        $text = preg_replace(
            array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
            array('',     '</p><p>',  '<br />', '</p>'),
            $text
        );
    }

    $text = apply_filters( 'kama_excerpt', $text, $rg );

    if( isset($text_append) )
        $text .= $text_append;

    return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}
/* Сhangelog:
 * 2.6.3 - Рефакторинг
 * 2.6.2 - Добавил регулярку для удаления блочных шорткодов вида: [foo]some data[/foo]
 * 2.6   - Удалил параметр 'save_format' и заменил его на два параметра 'autop' и 'save_tags'.
 *       - Немного изменил логику кода.
 */
?>