<?php

/**
 * stm lms order statistics
 */

add_action('rest_api_init', function () {
    register_rest_route('lms', '/stm-lms/order/items', array(
        'permission_callback' => '__return_true',
        'methods' => 'GET',
        'callback' => function () {
            return(\stmLms\Classes\Models\StmStatistics::get_user_orders_api());
        },
    ));
});

add_action('rest_api_init', function () {
    register_rest_route('lms', '/stm-lms-user/search', array(
        'permission_callback' => '__return_true',
        'methods' => 'GET',
        'callback' => function () {
            if (isset($_GET['search'])) return(\stmLms\Classes\Models\StmUser::search($_GET['search']));
            return ([]);
        },
    ));
});


add_action('rest_api_init', function () {
    register_rest_route('lms', '/stm-lms-user/course-list', array(
        'permission_callback' => '__return_true',
        'methods' => 'GET',
        'callback' => function () {

            if (isset($_GET['author_id']) AND $user = new \stmLms\Classes\Models\StmUser($_GET['author_id'])) {
                $course_list = [];
                $courses = $user->get_courses();
                foreach ($courses as $course) {
                    $course_list[] = [
                        "id" => $course->ID,
                        "title" => $course->post_title,
                    ];
                }
                return ($course_list);
            }
            return ([]);
        },
    ));
});

/**
 * stm lms payout
 */
add_action('rest_api_init', function () {
    register_rest_route('lms', '/stm-lms-pauout/settings', array(
        'permission_callback' => '__return_true',
        'methods' => 'POST',
        'callback' => function () {
            return(\stmLms\Classes\Models\StmLmsPayout::settings_payment_method());
        },
    ));
});

add_action('rest_api_init', function () {
    register_rest_route('lms', '/stm-lms-pauout/payment/set_default', array(
        'permission_callback' => '__return_true',
        'methods' => 'POST',
        'callback' => function () {
            return(\stmLms\Classes\Models\StmLmsPayout::payment_set_default());
        },
    ));
});

add_action('rest_api_init', function () {
    register_rest_route('lms', '/stm-lms-pauout/pay-now', array(
        'permission_callback' => '__return_true',
        'methods' => 'GET',
        'callback' => function () {
            return(\stmLms\Classes\Models\StmLmsPayout::pay_now());
        },
    ));
});

add_action('rest_api_init', function () {
    register_rest_route('lms', '/stm-lms-pauout/pay-now/(?P<id>\d+)', array(
        'permission_callback' => '__return_true',
        'methods' => 'GET',
        'callback' => function ($request) {

            return(\stmLms\Classes\Models\StmLmsPayout::pay_now_by_payout_id(intval($request->get_param('id'))));
        },
    ));
});

add_action('rest_api_init', function () {
    register_rest_route('lms', '/stm-lms-pauout/payed/(?P<id>\d+)', array(
        'permission_callback' => '__return_true',
        'methods' => 'GET',
        'callback' => function ($request) {
            return(\stmLms\Classes\Models\StmLmsPayout::payed(intval($request->get_param('id'))));

        },
    ));
});

add_action('init', function() {
	if(!empty($_GET['stm_lms_save_paypal_email'])) {
		wp_send_json(\stmLms\Classes\Models\StmUser::save_paypal_email($_GET['stm_lms_save_paypal_email']));
	}
});