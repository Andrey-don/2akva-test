<?php 
class magomra_walker_nav_header_menu extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
			);
		$class_names = implode( ' ', $classes );

		// build html
		// $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
		// $output .= '<div class="w-dropdown" data-delay="0" data-hover="1" style="left: -40px;top: 10px;width: 10px;"><div class="navlink w-dropdown-toggle">';
		// $output .= '<div class="w-dropdown" data-delay="0" data-hover="1"><div class="navlink w-dropdown-toggle">';
		$output .= '<div class="';
		if ($display_depth >=2)
			$output .= 'dropdown '; 
		$output .= 'w-dropdown" data-delay="0" data-hover="0"><div class="navlink ';
		// $output .= '<div class="w-icon-dropdown-toggle"></div>'.$item.'</div><nav class="dropdown-list w-dropdown-list">';
		if ($display_depth >=2)
			$output .= 'dropdown-toggle w-dropdown-toggle"><div class="icn w-icon-dropdown-toggle">';
		else $output .= 'w-dropdown-toggle"><div class="w-icon-dropdown-toggle">';
		$output .= '</div></div><nav class="dropdown-list';
		if($display_depth >=2)
			$output .= '-2';
		$output .= ' w-dropdown-list">';
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );
		// $output .= "$indent</ul>{$n}";
		$output .= "</nav></div>";
	}

	// add main/sub classes to li's and links
	// function start_el( &$output, $item, $depth, $args ) {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		// $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		// $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
		$attributes .= ' class=" ' . ( $depth > 0 ? 'dlink w-dropdown-link' : 'navlink w-nav-link' ) . '"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		// $output .= "</li>{$n}";
		$output .= "";
	}
}

class magomra_walker_nav_footer_menu extends Walker_Nav_Menu {

	// add main/sub classes to li's and links
	// function start_el( &$output, $item, $depth, $args ) {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		// $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		// $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
		$attributes .= ' class=" ' . ( $depth > 0 ? 'dlink w-dropdown-link' : 'foot-link' ) . '"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		// $output .= "</li>{$n}";
		$output .= "";
	}
}

// И там, где нужно выводим меню так:
function header_nav_menu() {
	// main navigation menu
	$args = array(
		'theme_location'    => 'header_menu',
		// 'container'     => 'div',
		'container'     => '',
		'container_id'      => 'top-navigation-primary',
		'conatiner_class'   => 'top-navigation',
		'menu_class'        => 'menu main-menu menu-depth-0 menu-even', 
		'echo'          => true,
		// 'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'items_wrap'        => '<nav class="navmenu w-nav-menu" role="navigation">%3$s</nav>',
		'depth'         => 10,
		'walker'        => new magomra_walker_nav_header_menu
	);

	// print menu
	wp_nav_menu( $args );
}

// И там, где нужно выводим меню так:
function footer_nav_menu() {
	// main navigation menu
	$args = array(
		'theme_location'    => 'footer_menu',
		// 'container'     => 'div',
		'container'     => '',
		'container_id'      => '',
		'conatiner_class'   => '',
		'menu_class'        => '', 
		'echo'          => true,
		// 'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'items_wrap'        => '%3$s',
		'depth'         => 10,
		'walker'        => new magomra_walker_nav_footer_menu
	);

	wp_nav_menu( $args );
}
?>