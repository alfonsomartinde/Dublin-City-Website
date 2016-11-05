<?php
/**
 * Template part for displaying General Menu
 */
// get cookie details
$parent_page = $_COOKIE["page_name"];

if ($parent_page == 'vol') {
	wp_nav_menu( array(
		'menu'              	=> 'vol_top',
		'theme_location'    => 'vol_top',
		'depth'             		=> 2,
		'container'         	=> 'div',
		'container_class'   	=> 'vdc-specific-menu',
		'container_id'     	=> '',
		'menu_class'        	=> 'top-menu',
		// 'link_before' 		=> '<span>',
		// 'link_after' 			=> '</span>',
		'fallback_cb'       	=> 'wp_bootstrap_navwalker::fallback',
		'walker'           		=> new vdc_navwalker())
	);
}
elseif ($parent_page == 'org') {
	wp_nav_menu( array(
		'menu'              	=> 'org_top',
		'theme_location'    => 'org_top',
		'depth'             		=> 2,
		'container'         	=> 'div',
		'container_class'   	=> 'vdc-specific-menu',
		'container_id'     	=> '',
		'menu_class'        	=> 'top-menu',
		// 'link_before' 		=> '<span>',
		// 'link_after' 			=> '</span>',
		'fallback_cb'       	=> 'wp_bootstrap_navwalker::fallback',
		'walker'           		=> new vdc_navwalker())
	);
}
else {
	wp_nav_menu( array(
		'menu'              	=> 'vol_top',
		'theme_location'    => 'vol_top',
		'depth'             		=> 2,
		'container'         	=> 'div',
		'container_class'   	=> 'vdc-specific-menu',
		'container_id'     	=> '',
		'menu_class'        	=> 'top-menu',
		// 'link_before' 		=> '<span>',
		// 'link_after' 			=> '</span>',
		'fallback_cb'       	=> 'wp_bootstrap_navwalker::fallback',
		'walker'           		=> new vdc_navwalker())
	);
}

