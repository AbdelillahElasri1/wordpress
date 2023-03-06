<?php
$args = array(
	'before'           => '<ul class="pagination"><li>',
	'after'            => '</li></ul>',
	'link_before'      => '<span>',
	'link_after'       => '</span>',
	'next_or_number'   => 'number',
	'separator'        => '</li><li>',
	'nextpagelink'     => esc_html__( 'Next', 'starter-text-domain' ),
	'previouspagelink' => esc_html__( 'Previous', 'starter-text-domain' ),
	'pagelink'         => '%',
	'echo'             => 1,
);

wp_link_pages( $args );
