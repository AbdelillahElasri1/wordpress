<?php

function stm_lms_demo_import_load_template( $tpl )
{
    require STM_LMS_PATH . "/settings/demo_import/tpls/{$tpl}.php";
}

add_filter( 'wpcfto_field_demo_import', function() {
    return STM_LMS_PATH . '/settings/demo_import/demo_import.php';
} );

add_action( 'wp_ajax_stm_lms_import_sample_data', 'stm_lms_import_sample_data' );

function stm_lms_import_sample_data($post_type = '', $die = true)
{
    $step = !empty( $_GET[ 'stm_lms_step' ] ) ? sanitize_text_field( $_GET[ 'stm_lms_step' ] ) : $post_type;
    if( !empty( $step ) ) {

        if( !defined( 'WP_LOAD_IMPORTERS' ) ) {
            define( 'WP_LOAD_IMPORTERS', true );
        }
        require_once STM_LMS_PATH . '/settings/demo_import/wordpress-importer.php';

        $file = STM_LMS_PATH . '/settings/demo_import/sample_data/' . $step . '.xml';
        if( file_exists( $file ) ) {

            $wp_import = new STM_LMS_Import();
            ob_start();
            $wp_import->import( $file );
            ob_end_clean();
            if( $step === 'courses' ) {
                $placeholder_id = stm_lms_upload_placeholder();

                $curriculum = stm_lms_get_demo_curriculum();

                $q = array(
                    'post_type' => 'stm-courses',
                    'posts_per_page' => -1,
                );
                $query = new WP_Query( $q );

                if( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $course_id = get_the_ID();

                        if(!has_post_thumbnail(get_the_ID()) || !wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()))){
                            set_post_thumbnail( get_the_ID(), $placeholder_id );
                        }

                        $curriculum_current = get_post_meta($course_id, 'curriculum', true);

                        if(empty($curriculum_current)) update_post_meta($course_id, 'curriculum', $curriculum);

                    }
                }

                wp_reset_postdata();
            }
            if($die) {
                wp_send_json( 'ok' );
            }

        }
    }
}


function stm_lms_get_placeholder()
{
    $placeholder_id = 0;
    $placeholder_array = get_posts(
        array(
            'post_type' => 'attachment',
            'posts_per_page' => 1,
            'meta_key' => '_wp_attachment_image_alt',
            'meta_value' => 'stm_lms_placeholder'
        )
    );
    if( $placeholder_array ) {
        foreach( $placeholder_array as $val ) {
            $placeholder_id = $val->ID;
        }
    }
    return $placeholder_id;
}


function stm_lms_upload_placeholder()
{

    $placeholder = stm_lms_get_placeholder();
    if( empty( $placeholder ) ) {

        global $wp_filesystem;

        if( empty( $wp_filesystem ) ) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $upload_dir = wp_upload_dir();

        $placeholder_path = STM_LMS_PATH . '/assets/img/placeholder.gif';
        $image_data = $wp_filesystem->get_contents( $placeholder_path );

        $filename = basename( $placeholder_path );

        if( wp_mkdir_p( $upload_dir[ 'path' ] ) ) {
            $file = $upload_dir[ 'path' ] . '/' . $filename;
        }
        else {
            $file = $upload_dir[ 'basedir' ] . '/' . $filename;
        }
        $wp_filesystem->put_contents( $file, $image_data, FS_CHMOD_FILE );

        $wp_filetype = wp_check_filetype( $filename, null );

        $attachment = array(
            'post_mime_type' => $wp_filetype[ 'type' ],
            'post_title' => sanitize_file_name( $filename ),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment( $attachment, $file );
        update_post_meta( $attach_id, '_wp_attachment_image_alt', 'stm_lms_placeholder' );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
        $placeholder = $attach_id;
    }
    return $placeholder;
}

function stm_lms_get_demo_curriculum() {
    $post_titles = array(
        'Nvidia New Technologies Slides',
        'Quiz: Mobile / Native Apps',
        'Engine Target Audience',
        'Realistic Graphic on UE4',
        'Volta GPU for optimization.',
        'Deep Learning',
    );

    $curriculum = array(
        'Starting Course'
    );
    $i = 0;
    foreach($post_titles as $title) {
        if($i === 2) {
            $curriculum[] = 'After Intro';
            $i++;
        }
        else {
            $post = get_page_by_title($title, OBJECT, array('stm-lessons', 'stm-quizzes'));

            if(!empty($post)){
                $curriculum[] = $post->ID;
                $i++;
            }
        }
    }
    return implode(',', $curriculum);
}

add_action('stm_masterstudy_importer_done', 'stm_lms_update_curriculum');
function stm_lms_update_curriculum() {
    $curriculum = stm_lms_get_demo_curriculum();

    $q = array(
        'post_type' => 'stm-courses',
        'posts_per_page' => -1,
    );
    $query = new WP_Query( $q );

    if( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $course_id = get_the_ID();

            update_post_meta($course_id, 'curriculum', $curriculum);

        }
    }

    wp_reset_postdata();
}