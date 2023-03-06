<?php

/**
 *
 * @var $id
 */

if (!empty($id)) {
    STM_LMS_Templates::show_lms_template('global/files',
        array(
            'item_id' => $id,
            'pack_name' => 'course_files_pack',
            'file_in_pack' => 'course_files',
            'file_in_pack_name' => 'course_files_label',
        )
    );
}