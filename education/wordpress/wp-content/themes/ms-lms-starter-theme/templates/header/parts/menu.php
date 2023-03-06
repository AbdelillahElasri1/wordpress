<?php
$menu_args = array(
	'depth'          => 3,
	'container'      => false,
	'items_wrap'     => '%3$s',
	'fallback_cb'    => false,
	'theme_location' => 'stm-header-menu',
);
?>
<div class="navigation-menu">
	<ul class="starter-menu menu">
		<?php wp_nav_menu( $menu_args ); ?>
	</ul>

	<div class="mobile-switcher">
		<span></span> <span></span> <span></span>
	</div>

	<div class="menu-overlay"></div>
</div>
