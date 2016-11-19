<!-- Mobile -->
<?php 
// get cookie details
$parent_page = $_COOKIE["page_name"];
global $post;
$id = $post->ID;
if ($id == 6 || $id == 4) {
	$menu_class = 'transparent';
} else {
	$menu_class = $parent_page;
}
?>
<div class="mobile-nav hidden-lg <?php echo $menu_class; ?>">
	<div class="container">
		<?php 
			$logo_white = get_field('mobile_logo', 'options');
			$logo_color = get_field('mobile_logo_color', 'options');
		?>

		<a href="<?php echo esc_url( home_url() ); ?>"><img class="show logo" src="<?php echo $logo_white['url'] ?>" alt="<?php echo $logo_white['alt'] ?>"></a>
		<img class="hidden logo" src="<?php echo $logo_color['url'] ?>" alt="<?php echo $logo_color['alt'] ?>">

		<div class="vdc-mobile-header-btns">
			<a id="vol" href="<?php echo esc_url( home_url( '/vol' ) ); ?>" class="vdc-mobile-header-btn blue">Volunteers</a>		
			<a id="org" href="<?php echo esc_url( home_url( '/org' ) ); ?>" class="vdc-mobile-header-btn purple">Organisation</a>	
		</div>
		
		<button type="button" class="hamburger <?php echo get_field('mobile_menu_icon', 'options'); ?>" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
	    </button>
	</div>

	
	
	<div class="mobile-menu">
		<?php
			wp_nav_menu( array(
				'menu'              	=> 'general_top',
				'theme_location'    => 'general_top',
				'depth'             		=> 2,
				'container'         	=> 'div',
				'container_class'   	=> '',
				'container_id'     	=> '',
				'menu_class'        	=> '',
				// 'link_before' 		=> '<span>',
				// 'link_after' 			=> '</span>',
				'fallback_cb'       	=> 'wp_bootstrap_navwalker::fallback',
				'walker'           		=> new vdc_navwalker())
			);
		?>
		<?php 
		if ($parent_page == 'vol') {
			wp_nav_menu( array(
				'menu'              	=> 'vol_mob',
				'theme_location'    => 'vol_mob',
				'depth'             		=> 1,
				'container'         	=> 'div',
				'container_class'   	=> '',
				'container_id'     	=> '',
				'menu_class'        	=> '',
				// 'link_before' 		=> '<span>',
				// 'link_after' 			=> '</span>',
				'fallback_cb'       	=> 'wp_bootstrap_navwalker::fallback',
				'walker'           		=> new vdc_navwalker())
			);
		} elseif ($parent_page == 'org') {
			wp_nav_menu( array(
				'menu'              	=> 'org_mob',
				'theme_location'    => 'org_mob',
				'depth'             		=> 1,
				'container'         	=> 'div',
				'container_class'   	=> '',
				'container_id'     	=> '',
				'menu_class'        	=> '',
				// 'link_before' 		=> '<span>',
				// 'link_after' 			=> '</span>',
				'fallback_cb'       	=> 'wp_bootstrap_navwalker::fallback',
				'walker'           		=> new vdc_navwalker())
			);
		} else {

		}
		?>
	</div>
	
</div>