<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; //Exit if accessed directly
}

function stm_lms_user_courses_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_courses';
}

function stm_lms_user_quizzes_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_quizzes';
}

function stm_lms_user_quizzes_times_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_quizzes_times';
}

function stm_lms_user_answers_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_answers';
}

function stm_lms_user_lessons_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_lessons';
}

function stm_lms_user_cart_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_cart';
}

function stm_lms_user_chat_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_chat';
}

function stm_lms_user_conversation_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_conversation';
}

function stm_lms_user_subscription_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_subscription_name';
}

function stm_lms_user_searches_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_searches';
}

function stm_lms_user_searches_stats_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_user_searches_stats';
}

function stm_lms_curriculum_log_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_curriculum_log';
}

function stm_lms_curriculum_bind_name( $wpdb ) {
	return $wpdb->prefix . 'stm_lms_curriculum_bind';
}
