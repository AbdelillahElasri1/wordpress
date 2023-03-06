<?php
$args = array(
	'prev_text' => '&larr; %title',
	'next_text' => '%title &rarr;',
	'class'     => 'single-post-navigation',
);
the_post_navigation( $args );
