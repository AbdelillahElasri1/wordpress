<?php

new STM_LMS_Curriculum_Log();

class STM_LMS_Curriculum_Log
{

    public function __construct()
    {
        add_action('stm_lms_inserted_item_1', array($this, 'item_inserted'), 10, 2);
        add_action('stm_lms_deleted_item_1', array($this, 'item_deleted'), 10, 2);

        add_action("save_post", array($this, 'save_lesson'), 99);
    }

    static function get_last_change($item_id, $fields = '*') {
        global $wpdb;
        if (is_array($fields)) $fields = implode(',', $fields);
        $table_name = stm_lms_curriculum_log_name($wpdb);
        $results = $wpdb->get_results("SELECT {$fields} FROM {$table_name} WHERE item_id = {$item_id} ORDER BY date DESC LIMIT 1", ARRAY_A);
        return $results;
    }

    function item_inserted($course_id, $item_id)
    {
        self::log_item($course_id, $item_id, 'added');
    }

    function item_deleted($course_id, $item_id)
    {
        self::log_item($course_id, $item_id, 'deleted');
    }

    static function log_item($course_id, $item_id, $action_code, $old_title = '')
    {
        global $wpdb;

        $table_name = stm_lms_curriculum_log_name($wpdb);

        $bind_item = array(
            'course_id' => $course_id,
            'item_id' => $item_id,
            'item_title' => get_the_title($item_id),
            'item_action' => $action_code,
            'item_type' => get_post_type($item_id),
            'date' => time(),
            'old_title' => $old_title,
        );

        $inserted = $wpdb->insert(
            $table_name,
            $bind_item
        );

        return $inserted;
    }

    function save_lesson($item_id)
    {

        $items = array(
            'stm-lessons',
            'stm-quizzes',
            'stm-assignments',
        );

        if (!in_array(get_post_type($item_id), $items)) return;

        $courses = STM_LMS_Curriculum::get_items_by_item($item_id, array('course_id'));

        if(empty($courses)) return;

        /*Get Courses where item included in curriculum*/
        $courses = wp_list_pluck($courses, 'course_id');

        /*Set that lesson in course updated*/
        foreach($courses as $course_id) {

            self::renamed($course_id, $item_id);

            self::log_item($course_id, $item_id, 'updated');
        }

    }

    static function renamed($course_id, $item_id) {

        $change = STM_LMS_Helpers::simplify_db_array(self::get_last_change($item_id, array('item_title')));

        if(empty($change) and empty($change['item_title'])) return;

        if($change['item_title'] == get_the_title($item_id)) return;

        self::log_item($course_id, $item_id, 'renamed', $change['item_title']);

    }

}