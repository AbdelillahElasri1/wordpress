<?php

/**
 *
 * @var $item_id
 */

if (!empty($item_id)) {
    STM_LMS_Templates::show_lms_template('global/files',
        array(
            'item_id' => $item_id,
            'pack_name' => 'lesson_files_pack',
            'file_in_pack' => 'lesson_files',
            'file_in_pack_name' => 'lesson_files_label',
        )
    );
}