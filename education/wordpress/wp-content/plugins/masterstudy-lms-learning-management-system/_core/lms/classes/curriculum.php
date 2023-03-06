<?php

new STM_LMS_Curriculum();

class STM_LMS_Curriculum
{

    static $courses_slug = 'stm-courses';

    public function __construct()
    {
        add_action("save_post", array($this, 'save_course'), 999);
        add_action('stm_lms_pro_course_added', array($this, 'save_course_from_frontend'), 999, 2);
    }

    function save_course_from_frontend($validated_data, $course_id) {
        $this->save_course($course_id);
    }

    function save_course($post_id)
    {
        if (get_post_type($post_id) !== $this::$courses_slug) return;

        $curriculum = STM_LMS_Course::get_course_curriculum($post_id);

        if (empty($curriculum['curriculum'])) return;

        $curriculum = $curriculum['curriculum'];

        $curriculum = array_filter($curriculum, function($item) {
            return is_numeric($item);
        });

        foreach ($curriculum as $item_id) {
            self::bind_item($post_id, $item_id);
        }

        $saved_items = self::get_items($post_id, array('item_id'));
        if (!empty($saved_items)) {
            $saved_items = wp_list_pluck($saved_items, 'item_id');
            $deleted_items = array_diff($saved_items, $curriculum);
            if (!empty($deleted_items)) {
                foreach ($deleted_items as $deleted_item) {
                    self::delete_item($post_id, $deleted_item);
                }
            }
        }

    }

    static function bind_item($course_id, $item_id)
    {

        if (empty(self::get_item($course_id, $item_id))) {
            self::insert_item($course_id, $item_id);
        }

    }

    static function get_items($course_id, $fields = '*')
    {
        global $wpdb;
        if (is_array($fields)) $fields = implode(',', $fields);
        $table_name = stm_lms_curriculum_bind_name($wpdb);
        $results = $wpdb->get_results("SELECT {$fields} FROM {$table_name} WHERE course_id = {$course_id}", ARRAY_A);
        return $results;
    }

    static function get_items_by_item($item_id, $fields = '*')
    {
        global $wpdb;
        if (is_array($fields)) $fields = implode(',', $fields);
        $table_name = stm_lms_curriculum_bind_name($wpdb);
        $results = $wpdb->get_results("SELECT {$fields} FROM {$table_name} WHERE item_id = {$item_id}", ARRAY_A);
        return $results;
    }

    static function get_item($course_id, $item_id)
    {
        global $wpdb;
        $table_name = stm_lms_curriculum_bind_name($wpdb);
        $results = $wpdb->get_results("SELECT * FROM {$table_name} WHERE item_id = {$item_id} AND course_id = {$course_id}", ARRAY_A);
        return $results;
    }

    static function insert_item($course_id, $item_id)
    {
        global $wpdb;

        $table_name = stm_lms_curriculum_bind_name($wpdb);

        $bind_item = array(
            'item_id' => $item_id,
            'course_id' => $course_id,
            'item_type' => get_post_type($item_id),
            'date' => time()
        );

        $inserted = $wpdb->insert(
            $table_name,
            $bind_item
        );

        do_action("stm_lms_inserted_item_{$inserted}", $course_id, $item_id);
    }

    static function delete_item($course_id, $item_id)
    {
        global $wpdb;
        $table = stm_lms_curriculum_bind_name($wpdb);

        $deleted = $wpdb->delete(
            $table,
            array(
                'course_id' => $course_id,
                'item_id' => $item_id
            )
        );

        do_action("stm_lms_deleted_item_{$deleted}", $course_id, $item_id);
    }

}