<?php

STM_LMS_Lesson::init();

class STM_LMS_Lesson
{

	public static function init()
	{
		add_action('wp_ajax_stm_lms_complete_lesson', 'STM_LMS_Lesson::complete_lesson');
		add_action('wp_ajax_nopriv_stm_lms_complete_lesson', 'STM_LMS_Lesson::complete_lesson');

		add_action('wp_ajax_stm_lms_total_progress', 'STM_LMS_Lesson::total_progress');
	}

	public static function get_lesson_url($post_id, $lesson_id)
	{
		if (empty($lesson_id)) {
            $lesson_id = self::get_first_lesson($post_id);

            if(empty($lesson_id)) return get_the_permalink($post_id);
		}

		$base_url = get_permalink($post_id);
		return $base_url . $lesson_id;
	}

	public static function is_lesson_completed($user_id, $course_id, $lesson_id)
	{
		if (empty($user_id)) {
			$user = STM_LMS_User::get_current_user();
			if (empty($user)) return false;
			$user_id = $user['id'];
		}

		if(get_post_type($lesson_id) === 'stm-lessons') {
            $already_completed = stm_lms_get_user_lesson($user_id, $course_id, $lesson_id, array('lesson_id'));
        } elseif (get_post_type($lesson_id) === 'stm-assignments') {
		    /*If addon is disabled we can skip it*/
		    if(!class_exists('STM_LMS_Assignments')) return true;
            $already_completed = STM_LMS_Assignments::has_passed_assignment($lesson_id);
        } else {
            $already_completed = stm_lms_check_quiz($user_id, $lesson_id);
        }

		return (count($already_completed) > 0) ? true : false;
	}

	public static function complete_lesson()
	{

	    check_ajax_referer('stm_lms_complete_lesson', 'nonce');

		$user = STM_LMS_User::get_current_user();
		if (empty($user['id']) or empty($_GET['course']) or empty($_GET['lesson'])) die;

		$user_id = $user['id'];
		$course_id = intval($_GET['course']);
		$lesson_id = intval($_GET['lesson']);

		/*Check if already passed*/
		if (STM_LMS_Lesson::is_lesson_completed($user_id, $course_id, $lesson_id)) {
			wp_send_json(compact('user_id', 'course_id', 'lesson_id'));
			die;
		};

		/*Check if lesson in course*/
		$curriculum = get_post_meta($course_id, 'curriculum', true);

		if (empty($curriculum)) die;
		$curriculum = STM_LMS_Helpers::only_array_numbers(explode(',', $curriculum));

		if (!in_array($lesson_id, $curriculum)) die;

		$end_time = time();
		$start_time = get_user_meta($user_id, "stm_lms_course_started_{$course_id}_{$lesson_id}", true);
		stm_lms_add_user_lesson(compact('user_id', 'course_id', 'lesson_id', 'start_time', 'end_time'));
		STM_LMS_Course::update_course_progress($user_id, $course_id);

		do_action('stm_lms_lesson_passed', $user_id, $lesson_id);

		delete_user_meta($user_id, "stm_lms_course_started_{$course_id}_{$lesson_id}");

		wp_send_json(compact('user_id', 'course_id', 'lesson_id'));
	}

	public static function lesson_has_preview($lesson_id)
	{
		return (!empty(get_post_meta($lesson_id, 'preview', true)));
	}

	public static function is_previewed($course_id, $lesson_id)
	{
		return (STM_LMS_Lesson::lesson_has_preview($lesson_id) and !STM_LMS_User::has_course_access($course_id));
	}

	public static function get_lesson_info($curriculum, $lesson_id)
	{
		$r = array(
			'section' => esc_html__('Section 1', 'masterstudy-lms-learning-management-system'),
			'lesson'  => ''
		);

		if (is_string($curriculum)) $curriculum = explode(',', $curriculum);

		if (empty($curriculum) or !in_array($lesson_id, $curriculum)) return $r;

		$current_lesson_id = array_search($lesson_id, $curriculum);
		$lesson_number = 0;

		while ($current_lesson_id >= 0) {
			if (!is_numeric($curriculum[$current_lesson_id])) {
				$r['section'] = $curriculum[$current_lesson_id];
				break;
			}
			$lesson_number++;
			$current_lesson_id--;
		}

		if (!empty($lesson_number) and get_post_type($lesson_id) === 'stm-lessons') {
		    $r['type'] = 'lesson';
            $r['lesson'] = sprintf(esc_html__('Lecture %s', 'masterstudy-lms-learning-management-system'), $lesson_number);
            //$r['text'] = sprintf(esc_html__('%s, %s', 'masterstudy-lms-learning-management-system'), $r['section'], $r['lesson']);
            $r['text'] = $r['section'];
        } elseif (!empty($lesson_number) and get_post_type($lesson_id) === 'stm-assignments') {
            $r['type'] = 'assignment';
            $r['lesson'] = sprintf(esc_html__('Assignment %s', 'masterstudy-lms-learning-management-system'), $lesson_number);
            //$r['text'] = sprintf(esc_html__('%s, %s', 'masterstudy-lms-learning-management-system'), $r['section'], $r['lesson']);
            $r['text'] = $r['section'];
		} else {
            $r['type'] = 'quiz';
			$r['lesson'] = sprintf(esc_html__('Quiz %s', 'masterstudy-lms-learning-management-system'), $lesson_number);
			//$r['text'] = sprintf(esc_html__('%s, %s', 'masterstudy-lms-learning-management-system'), $r['section'], $r['lesson']);
            $r['text'] = $r['section'];
		}

		return $r;

	}

	public static function create_sections($curriculum)
	{
		$sections = array();
		if (empty($curriculum)) return $sections;

		$section_number = 0;
		$current_section = 0;
		foreach ($curriculum as $key => $curriculum_item) {
			if (is_numeric($curriculum_item) and $key == 0) {
			    if(empty($current_section)) $current_section = '';
				$section_number++;
				$sections[$current_section] = array(
					'number' => sprintf(esc_html__('Section %s', 'masterstudy-lms-learning-management-system'), $section_number),
					'title'  => $current_section,
					'items'  => array($curriculum_item)
				);
			} elseif (!is_numeric($curriculum_item)) {
				$section_number++;
				$current_section = $key;
				$sections[$current_section] = array(
					'number' => sprintf(esc_html__('Section %s', 'masterstudy-lms-learning-management-system'), $section_number),
					'title'  => $curriculum_item,
					'items'  => array()
				);
			} else {
				$sections[$current_section]['items'][] = $curriculum_item;
			}
		}

		return $sections;
	}

	public static function aio_front_scripts()
	{

		$js_path = UAVC_URL . 'assets/min-js/';
		$ext = '.min';

		$ultimate_smooth_scroll_compatible = get_option('ultimate_smooth_scroll_compatible');

		// register js
		wp_register_script('ultimate-script', UAVC_URL . 'assets/min-js/ultimate.min.js', array('jquery', 'jquery-ui-core'), ULTIMATE_VERSION, false);
		wp_register_script('ultimate-appear', $js_path . 'jquery-appear' . $ext . '.js', array('jquery'), ULTIMATE_VERSION);
		wp_register_script('ultimate-custom', $js_path . 'custom' . $ext . '.js', array('jquery'), ULTIMATE_VERSION);
		wp_register_script('ultimate-vc-params', $js_path . 'ultimate-params' . $ext . '.js', array('jquery'), ULTIMATE_VERSION);
		if ($ultimate_smooth_scroll_compatible === 'enable') {
			$smoothScroll = 'SmoothScroll-compatible.min.js';
		} else {
			$smoothScroll = 'SmoothScroll.min.js';
		}
		wp_register_script('ultimate-smooth-scroll', UAVC_URL . 'assets/min-js/' . $smoothScroll, array('jquery'), ULTIMATE_VERSION, true);
		wp_register_script("ultimate-modernizr", $js_path . 'modernizr-custom' . $ext . '.js', array('jquery'), ULTIMATE_VERSION);
		wp_register_script("ultimate-tooltip", $js_path . 'tooltip' . $ext . '.js', array('jquery'), ULTIMATE_VERSION);

		// register css

		if (is_rtl()) {
			$cssext = '-rtl';
		} else {
			$cssext = '';
		}

		Ultimate_VC_Addons::ultimate_register_style('ultimate-animate', 'animate');
		Ultimate_VC_Addons::ultimate_register_style('ult_hotspot_rtl_css', UAVC_URL . 'assets/min-css/rtl-common' . $ext . '.css', true);
		Ultimate_VC_Addons::ultimate_register_style('ultimate-style', 'style');
		Ultimate_VC_Addons::ultimate_register_style('ultimate-style-min', UAVC_URL . 'assets/min-css/ultimate.min' . $cssext . '.css', true);
		Ultimate_VC_Addons::ultimate_register_style('ultimate-tooltip', 'tooltip');

		$ultimate_smooth_scroll = get_option('ultimate_smooth_scroll');
		if ($ultimate_smooth_scroll == "enable" || $ultimate_smooth_scroll_compatible === 'enable') {
			$ultimate_smooth_scroll_options = get_option('ultimate_smooth_scroll_options');
			$options = array(
				'step'  => (isset($ultimate_smooth_scroll_options['step']) && $ultimate_smooth_scroll_options['step'] != '') ? ( int )$ultimate_smooth_scroll_options['step'] : 80,
				'speed' => (isset($ultimate_smooth_scroll_options['speed']) && $ultimate_smooth_scroll_options['speed'] != '') ? ( int )$ultimate_smooth_scroll_options['speed'] : 480,
			);
			wp_enqueue_script('ultimate-smooth-scroll');
			if ($ultimate_smooth_scroll == "enable") {
				wp_localize_script('ultimate-smooth-scroll', 'php_vars', $options);
			}
		}

		if (function_exists('vc_is_editor')) {
			if (vc_is_editor()) {
				wp_enqueue_style('vc-fronteditor', UAVC_URL . 'assets/min-css/vc-fronteditor.min.css');
			}
		}
		$fonts = get_option('smile_fonts');
		if (is_array($fonts)) {
			foreach ($fonts as $font => $info) {
				$style_url = $info['style'];
				if (strpos($style_url, 'http://') !== false) {
					wp_enqueue_style('bsf-' . $font, $info['style']);
				}
			}
		}


		wp_enqueue_script('ultimate-modernizr');
		wp_enqueue_script('jquery_ui');
		wp_enqueue_script('masonry');
		if (defined('DISABLE_ULTIMATE_GOOGLE_MAP_API') && (DISABLE_ULTIMATE_GOOGLE_MAP_API == true || DISABLE_ULTIMATE_GOOGLE_MAP_API == 'true'))
			$load_map_api = false;
		else
			$load_map_api = true;
		if ($load_map_api)
			wp_enqueue_script('googleapis');
		/* Range Slider Dependecy */
		wp_enqueue_script('jquery-ui-mouse');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('ult_range_tick');
		/* Range Slider Dependecy */
		wp_enqueue_script('ultimate-script');
		wp_enqueue_script('ultimate-modal-all');
		wp_enqueue_script('jquery.shake', $js_path . 'jparallax' . $ext . '.js');
		wp_enqueue_script('jquery.vhparallax', $js_path . 'vhparallax' . $ext . '.js');

		wp_enqueue_style('ultimate-style-min');
		wp_enqueue_style("ult-icons");
		wp_enqueue_style('ultimate-vidcons', UAVC_URL . 'assets/fonts/vidcons.css');
		wp_enqueue_script('jquery.ytplayer', $js_path . 'mb-YTPlayer' . $ext . '.js');

		$Ultimate_Google_Font_Manager = new Ultimate_Google_Font_Manager;
		$Ultimate_Google_Font_Manager->enqueue_selected_ultimate_google_fonts();

	}// end aio_front_scripts

    public static function get_first_lesson($course_id) {
	    $curriculum = get_post_meta($course_id, 'curriculum', true);
        if(empty($curriculum)) return 0;

        $curriculum = explode(',', $curriculum);
        if(!is_array($curriculum)) return 0;

        foreach($curriculum as $lesson) {
            if(!empty(intval($lesson))) return $lesson;
        }

        return 0;

    }

    static function get_last_lesson($post_id, $item_id) {
        $curriculum = STM_LMS_Helpers::only_array_numbers(explode(',', get_post_meta($post_id, 'curriculum', true)));
        return end($curriculum);
    }

    public static function total_progress() {

	    check_ajax_referer('stm_lms_total_progress', 'nonce');

	    $user_id = get_current_user_id();
	    $post_id = intval($_GET['course_id']);

	    wp_send_json(self::get_total_progress($user_id, $post_id));
    }

    static function get_total_progress($user_id, $course_id) {

	    if(empty($user_id)) {
	        return null;
        }

	    $data = array(
	        'course' => STM_LMS_Helpers::simplify_db_array(stm_lms_get_user_course($user_id, $course_id)),
            'curriculum' => array(),
            'course_completed' => false
        );

	    if((!empty($data['course']['progress_percent'])) && $data['course']['progress_percent'] > 100) $data['course']['progress_percent'] = 100;

	    /*Curriculum*/
        $curriculum = STM_LMS_Helpers::only_array_numbers(explode(',', get_post_meta($course_id, 'curriculum', true)));
        $curriculum_data = array();
        foreach($curriculum as $item_id) {
            $type = get_post_meta($item_id, 'type', true);
            if(empty($type)) $type = 'text';
            $lesson = self::get_lesson_info($curriculum, $item_id);
            $lesson['completed'] = self::is_lesson_completed($user_id, $course_id, $item_id);
            if($lesson['type'] === 'lesson') {
                $lesson_type = get_post_meta($item_id, 'type', true);
                if(empty($lesson_type)) $lesson_type = 'text';
                $lesson['lesson_type'] = $lesson_type;
            }
            $curriculum_data[] = $lesson;
        }

        foreach($curriculum_data as $item_data) {
            $type = ($item_data['type'] === 'lesson' && $item_data['lesson_type'] !== 'text') ? 'multimedia' : $item_data['type'];
            if(empty($data['curriculum'][$type])) $data['curriculum'][$type] = array(
                'total' => 0,
                'completed' => 0
            );

            $data['curriculum'][$type]['total']++;

            if($item_data['completed']) $data['curriculum'][$type]['completed']++;

        }

        $data['title'] = get_the_title($course_id);
        $data['url'] = get_permalink($course_id);

        if(empty($data['course'])) {
            $data['course'] = array(
                'progress_percent' => 0,
            );
            return $data;
        }

        /*Completed label*/
        $threshold = STM_LMS_Options::get_option('certificate_threshold', 70);
        $data['course_completed'] = intval($threshold) <= intval($data['course']['progress_percent']);
        $data['certificate_url'] = STM_LMS_Course::certificates_page_url($course_id);

	    return $data;

    }

}