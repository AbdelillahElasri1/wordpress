<div class="ms_lms_instructors_carousel <?php echo ( ! empty( $rtl ) ) ? 'rtl' : ''; ?>">
	<div class="ms_lms_instructors_carousel_wrapper">
		<div dir="<?php echo ( ! empty( $rtl ) ) ? 'rtl' : 'ltr'; ?>" class="ms_lms_instructors_carousel__header <?php echo ( ! empty( $widget_header_presets ) ) ? esc_attr( $widget_header_presets ) : 'style_1'; ?> <?php echo ( ! empty( $show_navigation ) && 'arrows' === $navigation_type && 'side' === $navigation_arrows_position ) ? 'side_navigation' : ''; ?>">
			<?php
			render_title_and_description( $widget_title, $widget_description );
			render_view_all_button( $show_navigation, $navigation_type, $view_all_button_link );
			render_top_navigation( $show_navigation, $navigation_type, $navigation_arrows_position, $navigation_arrows_presets );
			?>
		</div>
		<?php if ( ! empty( $instructors ) ) { ?>
			<div dir="<?php echo ( ! empty( $rtl ) ) ? 'rtl' : 'ltr'; ?>" class="ms_lms_instructors_carousel__content_wrapper <?php echo ( ! empty( $show_navigation ) && 'arrows' === $navigation_type && 'side' === $navigation_arrows_position ) ? 'row' : ''; ?>">
				<?php
				render_bottom_navigation( $show_navigation, $navigation_type, $navigation_arrows_position, $navigation_arrows_presets );
				render_side_navigation_prev_button( $show_navigation, $navigation_type, $navigation_arrows_position, $navigation_arrows_presets );
				?>
				<div class="ms_lms_instructors_carousel__content">
					<div class="swiper-wrapper">
						<?php
						foreach ( $instructors as $instructor ) {
							$user_profile_url = STM_LMS_User::user_public_page_url( $instructor->ID );
							$user             = STM_LMS_User::get_current_user( $instructor->ID, false, true );
							$rating           = STM_LMS_Instructor::my_rating_v2( $user );
							?>
							<div class="ms_lms_instructors_carousel__item swiper-slide <?php echo ( ! empty( $instructor_card_presets ) ) ? esc_attr( $instructor_card_presets ) : 'style_1'; ?>">
								<div class="ms_lms_instructors_carousel__item_wrapper">
									<a href="<?php echo esc_url( $user_profile_url ); ?>" class="ms_lms_instructors_carousel__item_link"></a>
									<?php if ( ! empty( $show_avatars ) && ! empty( $user['avatar_url'] ) ) { ?>
										<div class="ms_lms_instructors_carousel__item_avatar">
											<?php render_instructor_socials_inside_avatar( $show_socials, $instructor_card_presets, $socials_presets, $user ); ?>
											<a href="<?php echo esc_url( $user_profile_url ); ?>" class="ms_lms_instructors_carousel__item_avatar_link">
												<img src="<?php echo esc_url( $user['avatar_url'] ); ?>" class="ms_lms_instructors_carousel__item_avatar_img">
											</a>
										</div>
									<?php } ?>
									<a href="<?php echo esc_url( $user_profile_url ); ?>" class="ms_lms_instructors_carousel__item_info">
										<h3 class="ms_lms_instructors_carousel__item_title"><?php echo esc_attr( $user['login'] ); ?></h3>
										<?php
										render_instructor_position( $show_instructor_position, $user );
										render_instructor_courses( $show_instructor_course_quantity, $instructor );
										render_instructor_reviews( $show_reviews, $rating, $show_reviews_count );
										?>
									</a>
									<?php render_instructor_socials( $show_socials, $instructor_card_presets, $socials_presets, $user ); ?>
								</div>
							</div>
					<?php } ?>
					</div>
				</div>
				<?php
				render_side_navigation_next_button( $show_navigation, $navigation_type, $navigation_arrows_position, $navigation_arrows_presets );
				?>
			</div>
		<?php } else { ?>
			<p class="ms_lms_instructors_carousel__no_results"><?php echo esc_html_e( 'No instructors found', 'masterstudy-lms-learning-management-system' ); ?></p>
		<?php } ?>
	</div>
</div>

<?php
function render_title_and_description( $widget_title, $widget_description ) {
	if ( ! empty( $widget_title ) ) {
		?>
		<h2 class="ms_lms_instructors_carousel__header_title">
			<?php echo esc_html( $widget_title ); ?>
		</h2>
		<?php
	}
	if ( ! empty( $widget_description ) ) {
		?>
	<p class="ms_lms_instructors_carousel__header_description">
		<?php echo esc_html( $widget_description ); ?>
	</p>
		<?php
	}
}

function render_view_all_button( $show_navigation, $navigation_type, $view_all_button_link ) {
	if ( ! empty( $show_navigation ) && 'view_all' === $navigation_type ) {
		?>
		<a dir="ltr" class="ms_lms_instructors_carousel__header_view_all" href="<?php echo esc_url( ( ! empty( $view_all_button_link['url'] ) ) ? $view_all_button_link['url'] : STM_LMS_Instructor::get_instructors_url() ); ?>">
			<?php esc_html_e( 'View all', 'masterstudy-lms-learning-management-system' ); ?>
			<i class="lnr lnr-arrow-right"></i>
		</a>
		<?php
	}
}

function render_top_navigation( $show_navigation, $navigation_type, $navigation_arrows_position, $navigation_arrows_presets ) {
	if ( ! empty( $show_navigation ) && 'arrows' === $navigation_type && 'top' === $navigation_arrows_position ) {
		?>
		<div class="ms_lms_instructors_carousel__navigation">
			<button class="ms_lms_instructors_carousel__navigation_prev <?php echo ( ! empty( $navigation_arrows_presets ) ) ? esc_attr( $navigation_arrows_presets ) : 'style_1'; ?>">
				<i class="lnr lnr-chevron-left"></i>
			</button>
			<button class="ms_lms_instructors_carousel__navigation_next <?php echo ( ! empty( $navigation_arrows_presets ) ) ? esc_attr( $navigation_arrows_presets ) : 'style_1'; ?>">
				<i class="lnr lnr-chevron-right"></i>
			</button>
		</div>
		<?php
	}
}

function render_bottom_navigation( $show_navigation, $navigation_type, $navigation_arrows_position, $navigation_arrows_presets ) {
	if ( ! empty( $show_navigation ) && 'arrows' === $navigation_type && 'bottom' === $navigation_arrows_position ) {
		?>
		<div class="ms_lms_instructors_carousel__navigation bottom">
			<button class="ms_lms_instructors_carousel__navigation_prev <?php echo ( ! empty( $navigation_arrows_presets ) ) ? esc_attr( $navigation_arrows_presets ) : 'style_1'; ?>">
				<i class="lnr lnr-chevron-left"></i>
			</button>
			<button class="ms_lms_instructors_carousel__navigation_next <?php echo ( ! empty( $navigation_arrows_presets ) ) ? esc_attr( $navigation_arrows_presets ) : 'style_1'; ?>">
				<i class="lnr lnr-chevron-right"></i>
			</button>
		</div>
		<?php
	}
}

function render_side_navigation_prev_button( $show_navigation, $navigation_type, $navigation_arrows_position, $navigation_arrows_presets ) {
	if ( ! empty( $show_navigation ) && 'arrows' === $navigation_type && 'side' === $navigation_arrows_position ) {
		?>
		<button class="ms_lms_instructors_carousel__navigation_prev side <?php echo ( ! empty( $navigation_arrows_presets ) ) ? esc_attr( $navigation_arrows_presets ) : 'style_1'; ?>">
			<i class="lnr lnr-chevron-left"></i>
		</button>
		<?php
	}
}

function render_side_navigation_next_button( $show_navigation, $navigation_type, $navigation_arrows_position, $navigation_arrows_presets ) {
	if ( ! empty( $show_navigation ) && 'arrows' === $navigation_type && 'side' === $navigation_arrows_position ) {
		?>
		<button class="ms_lms_instructors_carousel__navigation_next side <?php echo ( ! empty( $navigation_arrows_presets ) ) ? esc_attr( $navigation_arrows_presets ) : 'style_1'; ?>">
			<i class="lnr lnr-chevron-right"></i>
		</button>
		<?php
	}
}

function render_instructor_socials_inside_avatar( $show_socials, $instructor_card_presets, $socials_presets, $user ) {
	if ( ! empty( $show_socials ) && ! empty( $instructor_card_presets ) && 'style_5' === $instructor_card_presets ) {
		?>
		<div class="ms_lms_instructors_carousel__item_socials <?php echo ( ! empty( $socials_presets ) ) ? esc_attr( $socials_presets ) : 'style_1'; ?>">
			<?php if ( ! empty( $user['meta']['facebook'] ) ) { ?>
				<a href="<?php echo esc_url( $user['meta']['facebook'] ); ?>" class="ms_lms_instructors_carousel__item_socials_link">
					<i class="fab fa-facebook-f"></i>
				</a>
			<?php } ?>
			<?php if ( ! empty( $user['meta']['instagram'] ) ) { ?>
				<a href="<?php echo esc_url( $user['meta']['instagram'] ); ?>" class="ms_lms_instructors_carousel__item_socials_link">
					<i class="fab fa-instagram"></i>
				</a>
			<?php } ?>
			<?php if ( ! empty( $user['meta']['twitter'] ) ) { ?>
				<a href="<?php echo esc_url( $user['meta']['twitter'] ); ?>" class="ms_lms_instructors_carousel__item_socials_link">
					<i class="fab fa-twitter"></i>
				</a>
			<?php } ?>
			<?php if ( ! empty( $user['meta']['google-plus'] ) ) { ?>
				<a href="<?php echo esc_url( $user['meta']['google-plus'] ); ?>" class="ms_lms_instructors_carousel__item_socials_link">
					<i class="fab fa-google-plus-g"></i>
				</a>
			<?php } ?>
		</div>
		<?php
	}
}

function render_instructor_position( $show_instructor_position, $user ) {
	if ( ! empty( $show_instructor_position ) && ! empty( $user['meta']['position'] ) ) {
		?>
		<h4 class="ms_lms_instructors_carousel__item_position">
			<?php echo esc_html( $user['meta']['position'] ); ?>
		</h4>
		<?php
	}
}

function render_instructor_courses( $show_instructor_course_quantity, $instructor ) {
	if ( ! empty( $show_instructor_course_quantity ) && ! empty( $instructor->course_quantity ) ) {
		?>
		<div class="ms_lms_instructors_carousel__item_courses">
			<?php
				echo intval( $instructor->course_quantity );
				echo ' ';
				echo esc_html( ( intval( $instructor->course_quantity ) > 1 ) ? __( 'Courses', 'masterstudy-lms-learning-management-system' ) : __( 'Course', 'masterstudy-lms-learning-management-system' ) );
			?>
		</div>
		<?php
	}
}

function render_instructor_reviews( $show_reviews, $rating, $show_reviews_count ) {
	if ( ! empty( $show_reviews ) && ! empty( $rating['total'] ) ) {
		?>
		<div class="ms_lms_instructors_carousel__item_rating">
			<div class="ms_lms_instructors_carousel__item_rating_stars">
				<div class="ms_lms_instructors_carousel__item_rating_stars_filled" style="width: <?php echo floatval( $rating['percent'] ); ?>%;"></div>
			</div>
			<?php if ( ! empty( $show_reviews_count ) && ! empty( $rating['average'] ) ) { ?>
				<div class="ms_lms_instructors_carousel__item_rating_quantity">
					<?php echo number_format( $rating['average'], 1, '.', '' ) . ' (' . esc_html( $rating['marks_num'] ) . ')'; ?>
				</div>
			<?php } ?>
		</div>
		<?php
	}
}

function render_instructor_socials( $show_socials, $instructor_card_presets, $socials_presets, $user ) {
	if ( ! empty( $show_socials ) && ! empty( $instructor_card_presets ) && 'style_5' !== $instructor_card_presets ) {
		?>
		<div class="ms_lms_instructors_carousel__item_socials <?php echo ( ! empty( $socials_presets ) ) ? esc_attr( $socials_presets ) : 'style_1'; ?>">
			<?php if ( ! empty( $user['meta']['facebook'] ) ) { ?>
				<a href="<?php echo esc_url( $user['meta']['facebook'] ); ?>" class="ms_lms_instructors_carousel__item_socials_link">
					<i class="fab fa-facebook-f"></i>
				</a>
			<?php } ?>
			<?php if ( ! empty( $user['meta']['instagram'] ) ) { ?>
				<a href="<?php echo esc_url( $user['meta']['instagram'] ); ?>" class="ms_lms_instructors_carousel__item_socials_link">
					<i class="fab fa-instagram"></i>
				</a>
			<?php } ?>
			<?php if ( ! empty( $user['meta']['twitter'] ) ) { ?>
				<a href="<?php echo esc_url( $user['meta']['twitter'] ); ?>" class="ms_lms_instructors_carousel__item_socials_link">
					<i class="fab fa-twitter"></i>
				</a>
			<?php } ?>
			<?php if ( ! empty( $user['meta']['google-plus'] ) ) { ?>
				<a href="<?php echo esc_url( $user['meta']['google-plus'] ); ?>" class="ms_lms_instructors_carousel__item_socials_link">
					<i class="fab fa-google-plus-g"></i>
				</a>
			<?php } ?>
		</div>
		<?php
	}
}
