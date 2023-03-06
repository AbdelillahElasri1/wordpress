<?php
$settings = get_option( 'stm_theme_settings', array() );

$sidebar = ( $settings['post-sidebar'] ) ? $settings['post-sidebar'] : 'primary-sidebar';

dynamic_sidebar( $sidebar );
