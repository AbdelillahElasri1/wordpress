<?php

function stm_lms_curriculum_v2_load_template( $tpl ) {
	require STM_LMS_PATH . "/settings/curriculum/tpls/{$tpl}.php";
}

add_action(
	'wp_ajax_stm_lms_get_curriculum_v2',
	function () {
		check_ajax_referer( 'stm_lms_get_curriculum_v2', 'nonce' );
		$ids  = ( isset( $ids ) ? $ids : '' );
		$args = array(
			'post_type'      => array( 'stm-lessons', 'stm-quizzes', 'stm-assignments' ),
			'posts_per_page' => - 1,
		);

		$user  = wp_get_current_user();
		$roles = (array) $user->roles;

		if ( ! in_array( 'administrator', $roles, true ) ) {
			$args['author'] = get_current_user_id();
		}

		if ( ! empty( $_GET['course_id'] ) ) {
			$course_id          = intval( $_GET['course_id'] );
			$authors            = array();
			$authors[]          = intval( get_post_field( 'post_author', $course_id ) );
			$authors[]          = get_post_meta( $course_id, 'co_instructor', true );
			$args['author__in'] = $authors;
		}
		if ( ! empty( $_GET['ids'] ) ) {
			$ids              = wp_unslash( esc_html( $_GET['ids'] ) );
			$args['post__in'] = explode( ',', $ids );
			$args['orderby']  = 'post__in';
		} else {
			$args['posts_per_page'] = 30;
		}
		if ( ! empty( $_GET['exclude_ids'] ) ) {
			$args['post__not_in'] = explode( ',', sanitize_text_field( $_GET['exclude_ids'] ) );
		}
		if ( ! empty( $_GET['s'] ) ) {
			$args['s'] = sanitize_text_field( $_GET['s'] );
		}
		$args       = apply_filters( 'stm_lms_search_posts_args', $args );
		$q          = new WP_Query( $args );
		$r          = array();
		$curriculum = STM_LMS_Lesson::create_sections( explode( ',', $ids ) );
		if ( $q->have_posts() ) {
			while ( $q->have_posts() ) {
				$q->the_post();
				$post_id       = get_the_ID();
				$response      = array(
					'id'        => get_the_ID(),
					'title'     => get_the_title(),
					'post_type' => get_post_type( $post_id ),
					'edit_link' => html_entity_decode( get_edit_post_link( $post_id ) ),
				);
				$r[ $post_id ] = $response;
			}
			wp_reset_postdata();
		}
		if ( ! empty( $curriculum ) ) {
			foreach ( $curriculum as &$section ) {
				$section['opened']              = true;
				$section['touched']             = true;
				$section['editingSectionTitle'] = false;
				if ( apply_filters( 'stm_lms_allow_add_lesson', true ) ) {
					$section['activeTab'] = 'stm-lessons';
				} else {
					$section['activeTab'] = 'stm-quizzes';
				}
				if ( empty( $section['title'] ) ) {
					$section['opened']  = true;
					$section['touched'] = false;
				}
				if ( empty( $section['items'] ) ) {
					continue;
				}
				foreach ( $section['items'] as $key => &$item ) {
					if ( empty( $r[ $item ] ) ) {
						unset( $section['items'][ $key ] );
						continue;
					}
					$item = $r[ $item ];
				}
				$section['items'] = array_values( $section['items'] );
			}
		}
		if ( ! empty( $_GET['only_items'] ) ) {
			wp_send_json( array_values( $r ) );
		};
		wp_send_json( array_values( $curriculum ) );
	}
);
