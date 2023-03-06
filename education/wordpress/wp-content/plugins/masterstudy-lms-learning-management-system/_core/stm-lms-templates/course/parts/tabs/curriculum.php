<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;} // Exit if accessed directly ?>

<?php
stm_lms_register_style( 'curriculum' );
stm_lms_register_script( 'curriculum' );
$post_id      = ( ! empty( $post_id ) ) ? $post_id : get_the_ID();
$curriculum   = get_post_meta( $post_id, 'curriculum', true );
$not_salebale = get_post_meta( $post_id, 'not_single_sale', true );
$price        = STM_LMS_Course::get_course_price( $post_id );
if ( ! empty( $curriculum ) ) :
	$curriculum    = explode( ',', $curriculum );
	$has_access    = STM_LMS_User::has_course_access( $post_id, '', false );
	$lesson_number = 1;
	?>

	<div class="stm-curriculum">

		<?php foreach ( $curriculum as $curriculum_item ) : ?>

			<?php
			if ( ! is_numeric( $curriculum_item ) ) :
				$lesson_number = 1;
				?>
				<div class="stm-curriculum-section">
					<h3><?php echo wp_kses_post( urldecode( $curriculum_item ) ); ?></h3>
				</div>
				<?php
				continue;
			endif;
			?>

			<?php
			$content_type   = get_post_type( $curriculum_item );
			$meta           = '';
			$icon           = 'stmlms-text';
			$hint           = esc_html__( 'Text Lesson', 'masterstudy-lms-learning-management-system' );
			$lesson_excerpt = get_post_meta( $curriculum_item, 'lesson_excerpt', true );
			$preview        = '';
			if ( 'stm-quizzes' === $content_type ) {
				$q    = get_post_meta( $curriculum_item, 'questions', true );
				$icon = 'stmlms-quiz';
				$hint = esc_html__( 'Quiz', 'masterstudy-lms-learning-management-system' );
				if ( ! empty( $q ) ) :
					$meta = sprintf(
						/* translators: %s: number */
						_n(
							'%s question',
							'%s questions',
							count( explode( ',', $q ) ),
							'masterstudy-lms-learning-management-system'
						),
						count( explode( ',', $q ) )
					);
				endif;
			} else {
				$preview = get_post_meta( $curriculum_item, 'preview', true );
				$meta    = get_post_meta( $curriculum_item, 'duration', true );
				$type    = get_post_meta( $curriculum_item, 'type', true );

				if ( 'slide' == $type ) {
					$icon = 'stmlms-slides-css';
					$hint = esc_html__( 'Slides', 'masterstudy-lms-learning-management-system' );
				}

				if ( 'video' == $type ) {
					$icon = 'stmlms-slides';
					$hint = esc_html__( 'Video', 'masterstudy-lms-learning-management-system' );
				}

				if ( 'stream' == $type ) {
					$icon = 'fab fa-youtube';
					$hint = esc_html__( 'Live Stream', 'masterstudy-lms-learning-management-system' );
				}
				if ( 'zoom_conference' == $type ) {
					$icon = 'fas fa-video';
					$hint = esc_html__( 'Zoom meeting', 'masterstudy-lms-learning-management-system' );
				}
				if ( ! empty( $meta ) ) {
					$meta = '<i class="far fa-clock"></i>' . $meta;
				}
			}

			$curriculum_atts = apply_filters( 'stm_lms_curriculum_item_atts', array(), $post_id, $curriculum_item );
			?>

			<div class="stm-curriculum-item 
			<?php
			if ( ! empty( $lesson_excerpt ) ) {
				echo esc_attr( 'has-excerpt' );}
			?>
			">
				<div class="stm-curriculum-item__info">
					<div class="stm-curriculum-item__num">
						<?php echo intval( $lesson_number ); ?>
					</div>

					<div class="stm-curriculum-item__icon" data-toggle="tooltip" data-placement="bottom" title="<?php echo wp_kses_post( $hint ); ?>">
						<i class="<?php echo esc_attr( $icon ); ?>"></i>
					</div>

					<div class="stm-curriculum-item__title">
						<div class="heading_font"
							<?php if ( ! empty( $preview ) || $has_access || 0 == $price && ! $not_salebale ) : ?>
								data-curriculum-url="<?php echo esc_url( STM_LMS_Lesson::get_lesson_url( get_the_ID(), $curriculum_item ) ); ?>"
							<?php endif; ?>>
							<?php echo esc_attr( get_the_title( $curriculum_item ) ); ?>
						</div>
					</div>
					<div class="stm-curriculum-item__wrapper">
						<?php if ( ! empty( $lesson_excerpt ) ) : ?>
						<div class="stm-curriculum-item__toggle-container">
							<span class="stm-curriculum-item__toggle"></span>
						</div>
						<?php endif; ?>

						<?php if ( ( ! empty( $preview ) && ! $has_access && 0 !== $price ) || ( ! empty( $preview ) && ! $has_access && $not_salebale ) ) : ?>
						<div class="stm-curriculum-item__preview">
							<a href="<?php echo esc_url( STM_LMS_Lesson::get_lesson_url( get_the_ID(), $curriculum_item ) ); ?>">
								<?php esc_html_e( 'Preview', 'masterstudy-lms-learning-management-system' ); ?>
							</a>
						</div>
						<?php endif; ?>

						<?php if ( ! empty( $meta ) ) : ?>
						<div class="stm-curriculum-item__meta">
								<?php echo wp_kses_post( $meta ); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ( ! empty( $lesson_excerpt ) ) : ?>
					<div class="stm-curriculum-item__excerpt">
						<?php
						$allowed_tags = stm_lms_allowed_html();
						echo wp_kses( htmlspecialchars_decode( $lesson_excerpt ), $allowed_tags );
						?>
					</div>
				<?php endif; ?>

			</div>

			<?php $lesson_number++; ?>
		<?php endforeach; ?>

	</div>

<?php endif; ?>
