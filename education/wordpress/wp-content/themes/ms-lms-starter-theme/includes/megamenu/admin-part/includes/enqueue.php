<?php
// phpcs:ignoreFile
add_action('admin_enqueue_scripts', 'stm_megamenu_admin_scripts_method');
function stm_megamenu_admin_scripts_method($hook)
{
    $base_url = get_template_directory_uri() . '/includes/';
    if ($hook == 'nav-menus.php') {
        $admin_css = $base_url . 'megamenu/admin_part/assets/css/';
        $admin_js = $base_url . 'megamenu/admin_part/assets/js/';
        wp_enqueue_style('stm_megamenu', $admin_css . 'admin.css');
        wp_enqueue_script('stm_megamenu', $admin_js . 'admin.js', array('jquery'));

        wp_enqueue_script(
            'fonticonpicker.js',
            $admin_js . 'jquery.fonticonpicker.min.js',
            array('jquery')
        );
        wp_enqueue_style(
            'fonticonpicker',
            $admin_css . 'jquery.fonticonpicker.min.css'
        );
        wp_enqueue_style(
            'fonticonpicker-inverted',
            $admin_css . 'jquery.fonticonpicker.inverted.min.css'
        );

        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/includes/megamenu/admin_part/assets/css/font-awesome.css');

        $icons = stm_get_icon_sets();
        wp_add_inline_script('stm_megamenu', $icons);
    }
}

function stm_get_icon_sets()
{
    $fonts = get_option('stm_fonts');
    $icon_set = array();
    if (!empty($fonts)) {
        foreach ($fonts as $font => $info) {
            $upload_dir = wp_upload_dir();
            $url = trailingslashit($upload_dir['baseurl']);

            /*Read json and get fontprefix*/
            global $wp_filesystem;

            if (empty($wp_filesystem)) {
                require_once ABSPATH . '/wp-admin/includes/file.php';
                WP_Filesystem();
            }

            $json_file = $url . $info['include'] . '/' . 'selection.json';
            $json_file = json_decode($wp_filesystem->get_contents($json_file), true);

            $set_name = $json_file['metadata']['name'];
            $font_prefix = $json_file['preferences']['fontPref']['prefix'];

            if (!empty($json_file)) {
                foreach ($json_file['icons'] as $icon) {
                    $icon_set[$set_name][] = $font_prefix . $icon['properties']['name'];
                }
            }
        }
    }
    if (function_exists('stm_prefix_fontawesome_list')) {
        $fa = stm_prefix_fontawesome_list();
        foreach ($fa as $icon => $name) {
            $icon_set['FontAwesome'][] = $icon;
        }
    }

    ob_start(); ?>
    <script type="text/javascript">
        var stmIconsSet = <?php echo json_encode($icon_set); ?>;
    </script>
    <?php
    $r = ob_get_clean();
    $remove = array('<script type="text/javascript">', '</script>');
    $r = str_replace($remove, '', $r);
    return $r;
}