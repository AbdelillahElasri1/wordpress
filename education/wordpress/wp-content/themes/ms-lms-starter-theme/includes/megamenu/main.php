<?php
if ( is_admin() ) {
	require_once( get_template_directory() . '/includes/megamenu/admin-part/includes/xteam/xteam.php' );
	require_once( get_template_directory() . '/includes/megamenu/admin-part/includes/config.php' );
	require_once( get_template_directory() . '/includes/megamenu/admin-part/includes/enqueue.php' );
	require_once( get_template_directory() . '/includes/megamenu/admin-part/includes/fontawesome.php' );
} else {
	require_once( get_template_directory() . '/includes/megamenu/includes/walker.php' );
	require_once( get_template_directory() . '/includes/megamenu/includes/enqueue.php' );
}
