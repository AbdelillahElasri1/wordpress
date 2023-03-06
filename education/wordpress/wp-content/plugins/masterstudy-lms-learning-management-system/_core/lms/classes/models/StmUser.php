<?php
namespace stmLms\Classes\Models;

use WP_User_Query;
use stmLms\Classes\Vendor\StmBaseModelUser;

class StmUser extends StmBaseModelUser {

	public static function init_user() {

	}

	/**
	 * @param $search string
	 *
	 * @return user list array
	 */
	public static function search($search) {
		if(!$search AND empty(trim($search)))
			return [];
		$data = [];
		$users = new WP_User_Query( array(
			'search' => '*'.esc_attr( $search ).'*',
			'number' => 50,
			'search_columns' => array(
				'user_login',
				'user_nicename',
				'user_email',
				'user_url',
			),
		) );
		foreach ($users->get_results() as $user) {
			$data[] = array(
				'id' => $user->data->ID,
				'name' => $user->data->display_name,
				'email' => $user->data->user_email
			);
		}
		return $data;
	}

	/**
	 * @return mixed
	 */
	public function getRole() {
		global $wp_roles;
		$all_roles = $wp_roles->roles;
		return (isset($this->roles[0])) ?  array_merge(["id" => $this->roles[0] ], $all_roles[$this->roles[0]]) : false;
	}

	public function get_courses(){
		return StmLmsCourse::query()
		                       ->asTable("course")
						       ->where_in("course.`post_type`", array("stm-courses", "stm-course-bundles"))
						       ->where("course.`post_author`",$this->ID)
		                       ->find();
	}

	public static function save_paypal_email($email = ''){
		$result = array(
			'success' => false,
			'status' => "error",
			'message' => ":(",
		);

		$email = isset($_POST['paypal_email']) ? $_POST['paypal_email']  : $email;
		$validator = new \Validation();
		$data_for_validate = $validator->sanitize(['email' => $email ]);
		$validator->validation_rules(array(
			'email' => 'required|valid_email',
		));
		$validated_data = $validator->run($data_for_validate);
		if($validated_data === false) {
			$errors = $validator->get_errors_array();
			$result['message'] = $errors['email'];
			return $result;
		}
		if(get_current_user_id() AND isset($validated_data['email'])){
			update_user_meta(get_current_user_id(), "stm_lms_paypal_email", $validated_data['email']);
			$result["success"] = true;
			$result["status"] = "success";
			$result["message"] = __('Successfully saved', 'masterstudy-lms-learning-management-system');
		}
		return $result;
	}

}
