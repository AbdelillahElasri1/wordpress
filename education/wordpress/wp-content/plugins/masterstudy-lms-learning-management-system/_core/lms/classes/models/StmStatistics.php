<?php

namespace stmLms\Classes\Models;

use STM_LMS_Options;
use stmLms\Classes\Models\StmOrder;
use stmLms\Classes\Models\StmOrderItems;
use stmLms\Classes\Models\Admin\StmStatisticsListTable;

class StmStatistics
{

    static $instance;
    public $object;

    public static function set_screen($status, $option, $value)
    {
        return $value;
    }

    public static function init()
    {

        $model = new StmStatistics();
        self::get_instance();
        add_filter('set-screen-option', [__CLASS__, 'set_screen'], 10, 3);
        if (is_admin()) {
            add_action('init', [self::class, "init_statistics"]);
        }
    }

    static function init_statistics() {

        if(current_user_can('manage_options')) {
            self::create_table_order_items();
            self::woocommerce_order_items();
            self::set_order_items_total_price();
        }

    }

    public function admin_menu()
    {
        add_action('wpcfto_screen_stm_lms_settings_added', array($this, 'add_order_list'), 100, 1);
    }

    public function add_order_list()
    {
        $hook = add_submenu_page(
            'stm-lms-settings',
            __('Statistics', "masterstudy-lms-learning-management-system"),
            __('Statistics', "masterstudy-lms-learning-management-system"),
            'manage_options',
            'stm_lms_statistics',
            array($this, 'render_statistics')
        );
        add_action("load-$hook", [$this, 'stm_lms_statistics_screen_option']);
    }

    public function render_statistics()
    {
        stm_lms_render(STM_LMS_PATH . "/lms/views/statistics/statistics", [], true);
    }

    public function stm_lms_statistics_screen_option()
    {
        $option = 'per_page';
        $args = [
            'label' => 'Statistics',
            'default' => 10,
            'option' => 'stm_lms_statistics_per_page'
        ];
        add_screen_option($option, $args);
        $this->object = new StmStatisticsListTable();
    }

    public static function set_order_items_total_price()
    {
        $is_run = get_option("stm_lms_set_order_total_price");
        if (!$is_run) {
            global $wpdb;
            $prefix = $wpdb->prefix;
            $orders = StmOrder::query()
                ->select(" _order.*, mete.`meta_value` as items ")
                ->asTable("_order")
                ->join(" left join " . $prefix . "postmeta as mete on (mete.post_id = _order.ID)  ")
                ->where_in("_order.post_type", ["stm-orders"])
                ->where("mete.`meta_key`", "items")
                ->group_by("_order.ID")
                ->find();
            foreach ($orders as $order) {
                $total_price = 0;
                foreach ($order->items as $item) {
                    $total_price += $item['price'];

                    // update or create order items
                    if (!($order_items = StmOrderItems::query()->where("order_id", $order->ID)->where("object_id", $item['item_id'])->findOne()))
                        $order_items = new StmOrderItems();
                    $order_items->order_id = $order->ID;
                    $order_items->object_id = $item['item_id'];
                    $order_items->price = $item['price'];
                    $order_items->quantity = 1;
                    $order_items->transaction = 0;
                    $order_items->save();
                }
                update_post_meta($order->ID, "_order_total", $total_price);
            }
            add_option("stm_lms_set_order_total_price", "1");
        }
    }

    public static function woocommerce_order_items()
    {
        $is_run = get_option("stm_lms_set_woocommerce_order_items");
        if (!$is_run) {
            global $wpdb;
            $prefix = $wpdb->prefix;
            $orders = StmOrder::query()
                ->select(" _order.*, meta.meta_value as items")
                ->asTable("_order")
                ->join(" left join " . $prefix . "postmeta as meta on ( meta.`post_id` = _order.ID AND meta.`meta_key` = 'stm_lms_courses') ")
                ->where("_order.`post_type`", "shop_order")
                ->find();
            foreach ($orders as $order) {
                if (isset($order->items)) {
                    foreach ($order->items as $item) {
                        $price = get_post_meta($item['item_id'], "_price");

                        // update or create order items
                        if (!($order_items = StmOrderItems::query()->where("order_id", $order->ID)->where("object_id", $item['item_id'])->findOne()))
                            $order_items = new StmOrderItems();
                        $order_items->order_id = $order->ID;
                        $order_items->object_id = $item['item_id'];
                        $order_items->price = (isset($price[0])) ? $price[0] : 0;
                        $order_items->quantity = $item['quantity'];
                        $order_items->transaction = 0;
                        $order_items->save();
                    }
                }
            }
            add_option("stm_lms_set_woocommerce_order_items", "1");
        }
    }

    public static function create_table_order_items()
    {
        global $wpdb;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'stm_lms_order_items';
        $sql = "CREATE TABLE {$table_name} (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				order_id bigint(20) unsigned NOT NULL,
				object_id bigint(20) unsigned NOT NULL,
				payout_id bigint(20) unsigned,
				quantity int(11) NOT NULL,
				price float(24,2),
				`transaction` varchar(100),
				PRIMARY KEY  (id),
				KEY `{$table_name}_order_id_index` (`order_id`),
				KEY `{$table_name}_object_id_index` (`object_id`),
				KEY `{$table_name}_payout_id_index` (`payout_id`)
				) {$charset_collate};";
        maybe_create_table($table_name, $sql);
    }

    /**
     * @return StmStatistics
     */
    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public static function get_author_fee()
    {
        $author_fee = STM_LMS_Options::get_option('author_fee', false);
        return ($author_fee) ? $author_fee : 10;
    }

    /**
     * @param $offset
     * @param $limit
     * @param array $params
     *
     * @return array
     */
    public static function get_user_orders($offset, $limit, $params = [])
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $user_orders = [
            "items" => [],
            "total" => 0,
        ];
        $query = StmOrder::query()
            ->select(" _order.*, meta.* ")
            ->asTable("_order")
            ->join(" left join `" . $prefix . "stm_lms_order_items` as lms_order_items on ( lms_order_items.`order_id` = _order.ID )
			                           left join `" . $prefix . "posts` as course on  (course.ID = lms_order_items.`object_id`) ")
            ->where_in("_order.post_type", ["stm-orders", "shop_order"]);

        if (isset($params['id']) AND !empty($params['id'])) {
            $query->where('_order.ID', $params['id']);
        }

        if (isset($params['created_date_from']) AND !empty(trim($params['created_date_from'])) AND isset($params['created_date_to']) AND !empty(trim($params['created_date_to']))) {
            $query->where_raw('
			DATE(_order.post_date) >= "' . date("Y-m-d", strtotime($params['created_date_from'])) . '" AND
			DATE(_order.post_date) <= "' . date("Y-m-d", strtotime($params['created_date_to'])) . '"
		');
        }

        if (isset($params['total_price']) AND !empty($params['total_price'])) {
            $query->where_raw(' ( meta.meta_key = "_order_total" AND meta.meta_value = "' . $params['total_price'] . '" ) ');
        }

        if (isset($params['status']) AND !empty($params['status'])) {
            $query->where_raw('
				(
					( meta.meta_key = "status" AND meta.meta_value = "' . $params['status'] . '" ) OR
					( _order.post_status = "' . $params['status'] . '" )
				) 
			');
        }

        if (isset($params['user']) AND !empty($params['user'])) {
            $ids = [$params['user']];
            if (!empty($ids)) {
                $query->where_raw('
				(
					(meta.meta_key = "user_id" AND meta.meta_value in (' . implode(",", $ids) . ')) OR
					(meta.meta_key = "_customer_user" AND meta.meta_value in (' . implode(",", $ids) . '))
				)
			');
            }
        }

        if (isset($params['post_author']) AND !empty($params['post_author'])) {
            $query->where("course.`post_author`", (int)$params['post_author']);
        }

        if (!empty($params['orderby'])) {
            $query->sort_by(esc_sql($params['orderby']))
                ->order(!empty($params['order']) ? ' ' . esc_sql($params['order']) : ' ASC');
        } else {
            $query->sort_by("ID")->order(" DESC ");
        }

        $query_total = clone $query;

        $user_orders['total'] = $query_total->select(" COUNT(DISTINCT _order.ID) as count ")->findOne()->count;
        $query->join(" left join " . $prefix . "postmeta as meta on (meta.post_id = _order.ID)")
            ->group_by("_order.ID")
            ->limit($limit)
            ->offset($offset);

        $user_orders['items'] = $query->find();

        return $user_orders;
    }

    /**
     * @param $offset
     * @param $limit
     * @param array $params
     *
     * @return array
     */
    public static function get_user_order_items($offset, $limit, $params = [])
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $user_orders = [
            "items" => [],
            "total" => 0,
            "total_price" => 0,
        ];
        $query = StmOrderItems::query()
            ->select(" lms_order_items.*, course.post_title as name, _order.`post_date` as date_created ")
            ->asTable("lms_order_items")
            ->join(" left join `" . $prefix . "posts` as _order on ( lms_order_items.`order_id` = _order.ID )
			                           left join `" . $prefix . "posts` as course on  (course.ID = lms_order_items.`object_id`) ")
            ->where_in("_order.post_type", ["stm-orders", "shop_order"]);

        if (isset($params['id']) AND !empty($params['id'])) {
            $query->where('_order.ID', $params['id']);
        }

        if (isset($params['date_from']) AND !empty(trim($params['date_from'])) AND isset($params['date_to']) AND !empty(trim($params['date_to']))) {
            $query->where_raw('
			DATE(_order.post_date) >= "' . date("Y-m-d", strtotime($params['date_from'])) . '" AND
			DATE(_order.post_date) <= "' . date("Y-m-d", strtotime($params['date_to'])) . '"
		');
        }

        if (isset($params['total_price']) AND !empty($params['total_price'])) {
            $query->where_raw(' ( meta.meta_key = "_order_total" AND meta.meta_value = "' . $params['total_price'] . '" ) ');
        }

        if (isset($params['status']) AND !empty($params['status'])) {
            $query->where_raw('
				(
					( meta.meta_key = "status" AND meta.meta_value = "' . $params['status'] . '" ) OR
					( _order.post_status = "' . $params['status'] . '" )
				) 
			');
        }

        if (isset($params['user']) AND !empty($params['user'])) {
            $ids = [$params['user']];
            if (!empty($ids)) {
                $query->where_raw('
				(
					(meta.meta_key = "user_id" AND meta.meta_value in (' . implode(",", $ids) . ')) OR
					(meta.meta_key = "_customer_user" AND meta.meta_value in (' . implode(",", $ids) . '))
				)
			');
            }
        }

        if (isset($params['course_id']) AND !empty($params['course_id'])) {
            $query->where("course.ID", $params['course_id']);
        }

        if (isset($params['author_id']) AND !empty($params['author_id']) AND $params['author_id'] != 0) {
            $query->where("course.`post_author`", (int)$params['author_id']);
        }

        if (isset($params['completed']) AND !empty($params['completed'])) {
            $query->join(" left join " . $prefix . "postmeta as meta_status on ( meta_status.post_id = _order.ID AND _order.`post_type` = 'stm-orders' AND  meta_status.`meta_key` = 'status' AND meta_status.`meta_value` = 'completed') ")
                ->join(" left join " . $prefix . "posts as order_status on ( lms_order_items.`order_id` = order_status.ID AND order_status.`post_status` = 'wc-completed') ")
                ->where_raw(" (  meta_status.post_id = _order.ID OR order_status.ID = _order.ID )  ");
        }

        if (!empty($params['orderby'])) {
            $query->sort_by(esc_sql($params['orderby']))
                ->order(!empty($params['order']) ? ' ' . esc_sql($params['order']) : ' ASC');
        } else {
            $query->sort_by("ID")->order(" DESC ");
        }

        $query_total = clone $query;
        $user_orders['total'] = $query_total->select(" COUNT(DISTINCT lms_order_items.id) as count ")->findOne()->count;

        $query_total_price = clone $query;
        $query_total_price->select(" SUM( lms_order_items.`price` * lms_order_items.`quantity`) as total_price ");
        $total_price = $query_total_price->findOne()->total_price;
        $user_orders['total_price'] = ($total_price) ? $total_price : 0;
        $query->join(" left join " . $prefix . "postmeta as meta on (meta.post_id = _order.ID)")
            ->group_by("lms_order_items.id")
            ->limit($limit)
            ->offset($offset);

        $user_orders['items'] = $query->find();
        return $user_orders;
    }

    public static function get_user_orders_api()
    {
        $offset = 0;
        $limit = 10;

        if (isset($_GET['offset']) AND !empty($_GET['offset']))
            $offset = intval($_GET['offset']);

        if (isset($_GET['limit']) AND !empty($_GET['limit']))
            $limit = intval($_GET['limit']);

        $params = $_GET;

        $params['completed'] = true;

        if ($params['author_id'])
            return self::get_user_order_items($offset, $limit, $params);
    }

    /**
     * @param $date_start
     * @param $date_end
     * @param $user_id
     * @param null $course_id
     *
     * @return array
     */
    public static function get_course_statisticas($date_start, $date_end, $user_id, $course_id = null)
    {
        global $wpdb;
        $data = [];
        $courses = StmLmsCourse::query()
            ->select(" course.ID, course.`post_title`, _order.`post_date` as date, SUM(order_items.`price` * order_items.`quantity`) as amount")
            ->asTable("course")
            ->join(" left join `" . $wpdb->prefix . "stm_lms_order_items` as order_items on order_items.`object_id` = course.ID ")
            ->join(" left join `" . $wpdb->prefix . "posts` _order on _order.ID = order_items.`order_id` ")
            ->join(" left join " . $wpdb->prefix . "postmeta as meta_status on ( meta_status.post_id = _order.ID AND _order.`post_type` = 'stm-orders' AND  meta_status.`meta_key` = 'status' AND meta_status.`meta_value` = 'completed') ")
            ->where("course.post_author", $user_id)
            ->where_raw(" ( course.post_type = 'stm-courses' OR course.post_type = 'stm-course-bundles' OR course.post_type = 'stm-orders' ) ")
            ->where_raw(" (_order.`post_status` = 'wc-completed' OR meta_status.post_id = _order.ID) ")
            ->where_raw(" (DATE(_order.`post_date`) BETWEEN '" . $date_start . "' AND '" . $date_end . "') ")
            ->group_by(" course.ID, DATE_FORMAT(_order.post_date, '%m-%Y') ");

        if ($course_id != null)
            $courses->where("course.ID", $course_id)->findOne();

        foreach ($courses->find() as $course) {
            $data[] = [
                "id" => $course->ID,
                "title" => $course->post_title,
                "amount" => $course->amount,
                "date" => $course->date,
                "backgroundColor" => rand_color(0.50)
            ];
        }
        return $data;
    }

    /**
     * @param $user_id
     * @param null $course_id
     */
    public static function get_course_sales_statisticas($user_id, $course_id = null)
    {
        global $wpdb;
        $data = [];
        $courses = StmLmsCourse::query()
            ->select(" course.ID, course.`post_title`, SUM(order_items.`quantity`) as order_item_count ")
            ->asTable("course")
            ->join(" left join `" . $wpdb->prefix . "stm_lms_order_items` as order_items on order_items.`object_id` = course.ID ")
            ->join(" left join `" . $wpdb->prefix . "posts` _order on _order.ID = order_items.`order_id` ")
            ->join(" left join " . $wpdb->prefix . "postmeta as meta_status on ( meta_status.post_id = _order.ID AND _order.`post_type` = 'stm-orders' AND  meta_status.`meta_key` = 'status' AND meta_status.`meta_value` = 'completed') ")
            ->where("course.post_author", $user_id)
            ->where_raw(" ( course.post_type = 'stm-courses' OR course.post_type = 'stm-course-bundles' OR course.post_type = 'stm-orders' ) ")
            ->where_raw(" (_order.`post_status` = 'wc-completed' OR meta_status.post_id = _order.ID) ")
            ->group_by(" course.ID ");

        if ($course_id != null)
            $courses->where("course.ID", $course_id)->findOne();




        foreach ($courses->find() as $course) {
            $data[] = [
                "id" => $course->ID,
                "title" => $course->post_title,
                "backgroundColor" => rand_color(0.50),
                "order_item_count" => $course->order_item_count
            ];
        }

        return $data;
    }

}

