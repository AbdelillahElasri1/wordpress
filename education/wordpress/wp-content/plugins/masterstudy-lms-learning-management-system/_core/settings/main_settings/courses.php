<?php

function stm_lms_settings_courses_section()
{

    $pages = WPCFTO_Settings::stm_get_post_type_array('page');

    return array(
        'name' => esc_html__('Courses', 'masterstudy-lms-learning-management-system'),
        'label' => esc_html__('Courses Settings', 'masterstudy-lms-learning-management-system'),
        'icon' => 'fas fa-book',
        'fields' => array(
            'demo_import' => array(
                'type' => 'demo_import',
            ),
            /*GROUP STARTED*/
            'courses_page' => array(
                'group' => 'started',
                'group_title' => esc_html__('Page Layout', 'masterstudy-lms-learning-management-system'),
                'type' => 'select',
                'label' => esc_html__('Courses Page', 'masterstudy-lms-learning-management-system'),
                'options' => $pages,
                'columns' => '50',
            ),
            'courses_view' => array(
                'type' => 'radio',
                'label' => esc_html__('Courses Page Layout', 'masterstudy-lms-learning-management-system'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'masterstudy-lms-learning-management-system'),
                    'list' => esc_html__('List', 'masterstudy-lms-learning-management-system'),
                    'masonry' => esc_html__('Masonry', 'masterstudy-lms-learning-management-system'),
                ),
                'soon' => array( 'masonry' => true ),
                'value' => 'grid',
                'columns' => '50'
            ),
            'courses_per_row' => array(
                'type' => 'select',
                'label' => esc_html__('Courses per row', 'masterstudy-lms-learning-management-system'),
                'options' => array(
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '6' => 6,
                ),
                'value' => '4',
                'columns' => '33'
            ),
            'courses_per_page' => array(
                'type' => 'number',
                'label' => esc_html__('Courses per page', 'masterstudy-lms-learning-management-system'),
                'value' => '9',
                'columns' => '33'
            ),
            'load_more_type' => array(
                'group' => 'ended',
                'type' => 'select',
                'label' => esc_html__('Load More Type', 'masterstudy-lms-learning-management-system'),
                'options' => array(
                    'button' => esc_html__('Button', 'masterstudy-lms-learning-management-system'),
                    'infinite' => esc_html__('Infinite Scrolling', 'masterstudy-lms-learning-management-system'),
                ),
                'value' => 'button',
                'columns' => '33'
            ),
            /*GROUP ENDED*/

            /*GROUP STARTED*/
            'course_card_style' => array(
                'group' => 'started',
                'group_title' => esc_html__('Course Card', 'masterstudy-lms-learning-management-system'),
                'type' => 'radio',
                'label' => esc_html__('Course Card Style', 'masterstudy-lms-learning-management-system'),
                'options' => array(
                    'style_1' => esc_html__('Style 1', 'masterstudy-lms-learning-management-system'),
                    'style_2' => esc_html__('Style 2', 'masterstudy-lms-learning-management-system'),
                    'style_3' => esc_html__('Style 3', 'masterstudy-lms-learning-management-system'),
                ),
                'value' => 'style_1',
                'columns' => '50',
            ),
            'course_card_view' => array(
                'type' => 'radio',
                'label' => esc_html__('Course Card Info', 'masterstudy-lms-learning-management-system'),
                'options' => array(
                    'center' => esc_html__('Center', 'masterstudy-lms-learning-management-system'),
                    'right' => esc_html__('Right', 'masterstudy-lms-learning-management-system'),
                ),
                'dependency' => array(
                    'key' => 'course_card_style',
                    'value' => 'style_1'
                ),
                'value' => 'center',
                'columns' => '50'
            ),
            'courses_image_size' => array(
                'group' => 'ended',
                'type' => 'text',
                'label' => esc_html__('Courses Image Size', 'masterstudy-lms-learning-management-system'),
                'description' => esc_html__('Ex.: 200x100', 'masterstudy-lms-learning-management-system'),
                'value' => '',
                'columns' => '50'
            ),
            /*GROUP ENDED*/

            'disable_lazyload' => array(
                'type' => 'checkbox',
                'toggle' => true,
                'label' => esc_html__('Disable Lazyload', 'masterstudy-lms-learning-management-system'),
                'description' => esc_html__('LazyLoad displays images and/or iframes on a page only when they are visible to the user.', 'masterstudy-lms-learning-management-system'),
            ),
            'courses_categories_slug' => array(
                'type' => 'text',
                'label' => esc_html__('Category parent slug', 'masterstudy-lms-learning-management-system'),
                'value' => 'stm_lms_course_category',
                'description' => esc_html__('Slug in url before category', 'masterstudy-lms-learning-management-system'),
            ),
            'disable_featured_courses' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Disable Featured Courses Top Block on the Course List Page', 'masterstudy-lms-learning-management-system'),
            ),
            'number_featured_in_archive' => array(
                'type' => 'number',
                'label' => esc_html__('Number of Featured Courses in Archive Page', 'masterstudy-lms-learning-management-system'),
                'value' => 3,
                'dependency' => array(
                    'key' => 'disable_featured_courses',
                    'value' => 'empty'
                ),
            ),
            'enable_courses_filter' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Enable Archive Filter', 'masterstudy-lms-learning-management-system'),
            ),

            /*GROUP STARTED*/
            'enable_courses_filter_category' => array(
                'group' => 'started',
                'type' => 'checkbox',
                'group_title' => esc_html__('Course Filters', 'masterstudy-lms-learning-management-system'),
                'label' => esc_html__('Enable filter - Category', 'masterstudy-lms-learning-management-system'),
                'toggle' => false,
                'columns' => '33',
                'dependency' => array(
                    'key' => 'enable_courses_filter',
                    'value' => 'not_empty'
                ),
            ),
            'enable_courses_filter_subcategory' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Enable filter - Subcategory', 'masterstudy-lms-learning-management-system'),
                'toggle' => false,
                'columns' => '33',
                'dependency' => array(
                    'key' => 'enable_courses_filter',
                    'value' => 'not_empty'
                ),
            ),
            'enable_courses_filter_levels' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Enable filter - Levels', 'masterstudy-lms-learning-management-system'),
                'toggle' => false,
                'columns' => '33',
                'dependency' => array(
                    'key' => 'enable_courses_filter',
                    'value' => 'not_empty'
                ),
            ),
            'enable_courses_filter_rating' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Enable filter - Rating', 'masterstudy-lms-learning-management-system'),
                'toggle' => false,
                'columns' => '33',
                'dependency' => array(
                    'key' => 'enable_courses_filter',
                    'value' => 'not_empty'
                ),
            ),
            'enable_courses_filter_status' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Enable filter - Status', 'masterstudy-lms-learning-management-system'),
                'toggle' => false,
                'columns' => '33',
                'dependency' => array(
                    'key' => 'enable_courses_filter',
                    'value' => 'not_empty'
                ),
            ),
            'enable_courses_filter_instructor' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Enable filter - Instructor', 'masterstudy-lms-learning-management-system'),
                'toggle' => false,
                'columns' => '33',
                'dependency' => array(
                    'key' => 'enable_courses_filter',
                    'value' => 'not_empty'
                ),
            ),
            'enable_courses_filter_price' => array(
                'group' => 'ended',
                'type' => 'checkbox',
                'label' => esc_html__('Enable filter - Price', 'masterstudy-lms-learning-management-system'),
                'toggle' => false,
                'columns' => '33',
                'dependency' => array(
                    'key' => 'enable_courses_filter',
                    'value' => 'not_empty'
                ),
            ),
            /*GROUP ENDED*/
        )
    );
}
