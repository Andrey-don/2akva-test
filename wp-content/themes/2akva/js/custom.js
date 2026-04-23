jQuery(document).ready(function($) {
	if($('nav.navmenu div.w-dropdown')){
		$('nav.navmenu>div.w-dropdown').each(function(){
			//console.log($(this));
			var $th = $(this);
			var $drop_item = $th.prev('a.navlink.w-nav-link:first');
			var tt = '<div>'+$drop_item.text()+'</div>';
			//console.log($drop_item);
			//console.log($th.find('div.navlink.w-dropdown-toggle'));
			$drop_item.prependTo($th.find('div.navlink.w-dropdown-toggle').first()).replaceWith(tt);
		// console.log(tt);
		});
	}
	if($('nav.dropdown-list div.w-dropdown')){
		$('nav.dropdown-list>div.w-dropdown').each(function(){
			//console.log($(this));
			var $th = $(this);
			var $drop_item = $th.prev('a.dlink.w-dropdown-link:first');
			var tt = '<div>'+$drop_item.text()+'</div>';
			//console.log($drop_item);
			//console.log($th.find('div.navlink.w-dropdown-toggle'));
			$drop_item.prependTo($th.find('div.navlink.w-dropdown-toggle').first()).replaceWith(tt);
		// console.log(tt);
		});
	}
});