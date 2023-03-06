<?php
/**
 *
 * @var $item_id
 * @var $pack_name
 * @var $file_in_pack
 * @var $file_in_pack_name
 *
 */

$pack = get_post_meta($item_id, $pack_name, true);
$pack = json_decode($pack, true);
if (is_array($pack)): ?>
    <div class="stm_lms_downloadable_content__files" id="stm_lms_downloadable_content__files">
        <?php foreach ($pack as $file):
            if (empty($file[$file_in_pack])) continue;

            $course_files = json_decode($file[$file_in_pack], true);

            if (empty($course_files['path']) or empty($course_files['url'])) continue;

            $course_files_label = !empty($file[$file_in_pack_name]) ? $file[$file_in_pack_name] : esc_html__('Attached file', 'masterstudy-lms-learning-management-system');

            if(!file_exists($course_files['path'])) continue;
            $file_size = filesize($course_files['path']);
            $file_size = $file_size / 1024;
            $file_size_label = 'kb';
            if ($file_size > 1000) {
                $file_size = $file_size / 1024;
                $file_size_label = 'mB';
            }

            $ext = pathinfo($course_files['path'], PATHINFO_EXTENSION);


            STM_LMS_Templates::show_lms_template('global/file', array(
                'title' => $course_files_label,
                'filename' => basename($course_files['path']),
                'ext' => $ext,
                'filesize' => $file_size,
                'filesize_label' => $file_size_label,
                'url' => $course_files['url']
            ));

        endforeach; ?>
    </div>
<?php endif; ?>