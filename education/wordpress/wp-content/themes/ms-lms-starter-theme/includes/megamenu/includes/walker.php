<?php
// phpcs:ignoreFile
if (!defined('CUAR_PLUGIN_VERSION')) {

    add_filter( 'nav_menu_css_class', 'stm_nav_menu_css_class', 10, 4 );

    function stm_nav_menu_css_class( $classes, $item, $args, $depth )
    {
            $id = $item->ID;

            //MEGAMENU ONLY ON FIRST LVL
            if( !$depth ) {
                $mega = get_post_meta( $id, stm_menu_meta( 'stm_mega' ), true );
                if( !empty( $mega ) and $mega != 'disabled' ) {
                    $classes[] = 'stm_megamenu stm_megamenu__' . $mega;

                    $mega_cols = get_post_meta( $id, stm_menu_meta( 'stm_mega_cols' ), true );
                    if( !empty( $mega_cols ) ) {
                        $classes[] = 'stm_megamenu_' . $mega_cols;
                    }
                }
            } elseif( $depth == 1 ) {
                $mega_col_width = get_post_meta( $id, stm_menu_meta( 'stm_mega_col_width' ), true );
                if( !empty( $mega_col_width ) ) {
                    $classes[] = 'stm_col_width_' . $mega_col_width;
                }

                $mega_col_width_inside = get_post_meta( $id, stm_menu_meta( 'stm_mega_cols_inside' ), true );
                if( !empty( $mega_col_width_inside ) ) {
                    $classes[] = 'stm_mega_cols_inside_' . $mega_col_width_inside;
                }
                $mega_col_width_banner = get_post_meta( $id, stm_menu_meta( 'stm_mega_col_width_banner' ), true );
                if( !empty( $mega_col_width_banner ) ) {
                    $classes[] = 'stm_mega_col_width_banner_' . $mega_col_width_banner;
                }
            } elseif( $depth == 2 ) {
                $mega_second_col_width = get_post_meta( $id, stm_menu_meta( 'stm_mega_second_col_width' ), true );
                if( !empty( $mega_second_col_width ) ) {
                    $classes[] = 'stm_mega_second_col_width_' . $mega_second_col_width;
                }
            }
        return $classes;
    }

    add_filter( 'nav_menu_item_title', 'stm_nav_menu_item_title', 10, 4);

    function stm_nav_menu_item_title($title, $item, $args, $depth) {
        $id = $item->ID;

        //MEGAMENU ONLY ON 2 AND 3
        if(!$depth) return $title;

        /*IMAGE BANNER THIRD LVL ONLY*/
        $image = get_post_meta($id, stm_menu_meta('stm_menu_image'), true);
        if($depth == 1 || $depth == 2) {
            if(!empty($image)) {
                $img = '';
                $image = wp_get_attachment_image_src($image, 'full');

                if(!empty($image[0])) {
                    $img = '<img alt="' . $title . '" src="' . esc_url($image[0]) . '" />';
                    $title = $img;
                }
            }
        }


        if($depth == 2) {
            /*Text field*/
            $textarea = get_post_meta($id, stm_menu_meta('stm_mega_textarea'), true);
            if(!empty($textarea)) {
                $textarea = '<div class="stm_mega_textarea">'.$textarea.'</div>';
                if(!empty($image)) {
                    $title = $title . $textarea;
                } else {
                    $title = $textarea;
                }
            }
        }

        /*Icon on both 2 and 3 lvls and not on images*/
        if(empty($image)) {
            $icon = get_post_meta($id, stm_menu_meta('stm_menu_icon'), true);
            if (!empty($icon)) {
                $icon = '<i class="stm_megaicon ' . $icon . '"></i>';
                $title = $icon . $title;
            }
        }
        return $title;
    }

    add_filter( 'nav_menu_link_attributes', 'stm_nav_menu_link_attributes', 10, 4);

    function stm_nav_menu_link_attributes($atts, $item, $args, $depth) {
        /*ONLY LVL 0*/
        if (!$depth) {
            $id = $item->ID;

            $bg = get_post_meta($id, stm_menu_meta('stm_menu_bg'), true);

            if(!empty($bg)) {
                $bg = wp_get_attachment_image_src($bg, 'full');
                if(!empty($bg[0])) {
                    $atts['data-megabg'] = esc_url($bg[0]);
                }
            }
        }
        return $atts;
    }

    function stm_menu_meta($name) {
        return '_menu_item_' . $name;
    }
}


