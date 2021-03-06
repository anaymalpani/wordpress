<?php
/**
 * Common functions used for admin
 *
 * @package   LearnPress
 * @author    ThimPress
 * @version   1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Get html view path for admin to display
 *
 * @param $name
 * @param $plugin_file
 *
 * @return mixed
 */
function learn_press_get_admin_view( $name, $plugin_file = null ) {
	if ( !preg_match( '/\.(.*)$/', $name ) ) {
		$name .= '.php';
	}
	if ( $plugin_file ) {
		$view = dirname( $plugin_file ) . '/inc/admin/views/' . $name;
	} else {
		$view = LP()->plugin_path( 'inc/admin/views/' . $name );
	}
	return apply_filters( 'learn_press_admin_view', $view, $name );
}

/**
 * Find a full path of a view and display the content in admin
 *
 * @param            $name
 * @param array      $args
 * @param bool|false $include_once
 *
 * @return bool
 */
function learn_press_admin_view( $name, $args = array(), $include_once = false ) {
	$view = learn_press_get_admin_view( $name, !empty( $args['plugin_file'] ) ? $args['plugin_file'] : null );
	if ( file_exists( $view ) ) {
		// extract parameters as local variables if passed
		is_array( $args ) && extract( $args );
		do_action( 'learn_press_before_display_admin_view', $name, $args );
		if ( $include_once ) {
			include_once $view;
		} else {
			include $view;
		}
		do_action( 'learn_press_after_display_admin_view', $name, $args );
		return true;
	}
	return false;
}

/**
 * List all pages as a dropdown with "Add New Page" option
 *
 * @param            $name
 * @param bool|false $selected
 * @param array      $args
 *
 * @return mixed|string
 */
function learn_press_pages_dropdown( $name, $selected = false, $args = array() ) {
	$id           = null;
	$class        = null;
	$css          = null;
	$before       = array(
		'add_new_page' => __( '[ Add a new page ]', 'learnpress' )
	);
	$after        = null;
	$echo         = true;
	$allow_create = true;
	is_array( $args ) && extract( $args );

	if ( empty( $id ) ) {
		$id = $name;
	}
	$args    = array(
		'name'             => $name,
		'id'               => $id,
		'sort_column'      => 'menu_order',
		'sort_order'       => 'ASC',
		'show_option_none' => __( 'Select Page', 'learnpress' ),
		'class'            => $class,
		'echo'             => false,
		'selected'         => $selected,
		'allow_create'     => true
	);
	$output  = wp_dropdown_pages( $args );
	$replace = "";

	$class .= 'learn-press-dropdown-pages';

	if ( $class ) {
		$replace .= ' class="' . $class . '"';
	}
	if ( $css ) {
		$replace .= ' style="' . $css . '"';
	}

	$replace .= ' data-selected="' . $selected . '"';
	$replace .= " data-placeholder='" . __( 'Select a page&hellip;', 'learnpress' ) . "' id=";
	$output = str_replace( ' id=', $replace, $output );
	if ( $before ) {
		$before_output = array();
		foreach ( $before as $v => $l ) {
			$before_output[] = sprintf( '<option value="%s">%s</option>', $v, $l );
		}
		$before_output = join( "\n", $before_output );
		$output        = preg_replace( '!(<option class=".*" value="[0-9]+".*>.*</option>)!', $before_output . "\n$1", $output, 1 );
	}
	if ( $allow_create ) {
		ob_start(); ?>
		<button class="button button-quick-add-page" data-id="<?php echo $id; ?>" type="button"><?php _e( 'Create', 'learnpress' ); ?></button>
		<p class="learn-press-quick-add-page-inline <?php echo $id; ?> hide-if-js">
			<input type="text" placeholder="<?php esc_attr_e( 'New page title', 'learnpress' ); ?>" />
			<button class="button" type="button"><?php esc_html_e( 'Ok [Enter]', 'learnpress' ); ?></button>
			<a href=""><?php _e( 'Cancel [ESC]', 'learnpress' ); ?></a>
		</p>
		<p class="learn-press-quick-add-page-actions <?php echo $id; ?><?php echo $selected ? '' : ' hide-if-js'; ?>">
			<a class="edit-page" href="<?php echo get_edit_post_link( $selected ); ?>" target="_blank"><?php _e( 'Edit Page', 'learnpress' ); ?></a>
			<a class="view-page" href="<?php echo get_permalink( $selected ); ?>" target="_blank"><?php _e( 'View Page', 'learnpress' ); ?></a>
		</p>
		<?php $output .= ob_get_clean();
	}
	if ( $echo ) {
		echo $output;
	}

	return $output;
}

/**
 * List all registered question types into dropdown
 *
 * @param array
 *
 * @return string
 */
function learn_press_dropdown_question_types( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'name'     => 'learn-press-dropdown-question-types',
			'id'       => '',
			'class'    => '',
			'selected' => '',
			'echo'     => true
		)
	);
	if ( !$args['id'] ) {
		$args['id'] = $args['name'];
	}
	$args['class'] = 'lp-dropdown-question-types' . ( $args['class'] ? ' ' . $args['class'] : '' );
	$types         = learn_press_question_types();
	$output        = sprintf( '<select name="%s" id="%s" class="%s"%s>', $args['name'], $args['id'], $args['class'], $args['selected'] ? 'data-selected="' . $args['selected'] . '"' : '' );
	foreach ( $types as $slug => $name ) {
		$output .= sprintf( '<option value="%s"%s>%s</option>', $slug, selected( $slug == $args['selected'], true, false ), $name );
	}
	$output .= '</select>';
	if ( $args['echo'] ) {
		echo $output;
	}
	return $output;
}

/**
 * Displays email formats support into a dropdown
 *
 * @param array $args
 *
 * @return string
 */
function learn_press_email_formats_dropdown( $args = array() ) {
	$args    = wp_parse_args(
		$args,
		array(
			'name'     => 'learn-press-dropdown-email-formats',
			'id'       => '',
			'class'    => '',
			'selected' => '',
			'echo'     => true
		)
	);
	$formats = array(
		//'text_message' => __( 'Text message', 'learnpress' ),
		'plain_text'   => __( 'Plain text', 'learnpress' ),
		'html'         => __( 'HTML', 'learnpress' ),
		//'multipart'    => __( 'Multipart', 'learnpress' )
	);
	$output  = sprintf( '<select name="%s" id="%s" class="%s" %s>', $args['name'], $args['id'], $args['class'], '' );
	foreach ( $formats as $name => $text ) {
		$output .= sprintf( '<option value="%s" %s>%s</option>', $name, selected( $args['selected'] == $name, true, false ), $text ) . "\n";
	}
	$output .= '</select>';

	if ( $args['echo'] ) echo $output;
	return $output;
}

/**************************************************/
/**************************************************/
/**************************************************/

/**
 * Translate javascript text
 */
function learn_press_admin_localize_script() {
	if ( defined( 'DOING_AJAX' ) || !is_admin() ) return;
	$translate = array(
		'quizzes_is_not_available'  => __( 'Quiz is not available', 'learnpress' ),
		'lessons_is_not_available'  => __( 'Lesson is not available', 'learnpress' ),
                'duplicate_course'          => array(
                    'title'     => __( 'Duplicate course', 'learnpress' ),
                    'message'   => __( 'Duplicate course curriculum?', 'learnpress' )
                ),
                'duplicate_question'        => array(
                    'title'     => __( 'Duplicate Question', 'learnpress' ),
                    'message'   => __( 'Do you want to duplicate this question?', 'learnpress' )
                ),
                'remove_question' => __( 'Do you want to remove this question from quiz?', 'learnpress' ),
                'nonces'        => array(
                    'duplicate_question'    => wp_create_nonce( 'duplicate-question' )
                )
	);
	LP_Assets::add_localize( $translate );
}

add_action( 'init', 'learn_press_admin_localize_script' );

/**
 * Default admin settings pages
 *
 * @return mixed
 */
function learn_press_settings_tabs_array() {
	$tabs = array(
		'general'  => __( 'General', 'learnpress' ),
		'courses'  => __( 'Courses', 'learnpress' ),
		'pages'    => __( 'Pages', 'learnpress' ),
		'payments' => __( 'Payments', 'learnpress' ),
		'checkout' => __( 'Checkout', 'learnpress' ),
		//'profile'  => __( 'Profile', 'learnpress' ),
		'emails'   => __( 'Emails', 'learnpress' )
	);
	return apply_filters( 'learn_press_settings_tabs_array', $tabs );
}

/**
 * Count number of orders between to dates
 *
 * @param string
 * @param int
 *
 * @return int
 */
function learn_press_get_order_by_time( $by, $time ) {
	global $wpdb;
	$user_id = get_current_user_id();

	$y = date( 'Y', $time );
	$m = date( 'm', $time );
	$d = date( 'd', $time );
	switch ( $by ) {
		case 'days':
			$orders = $wpdb->get_var(
				$wpdb->prepare(
					"SELECT COUNT(*)
					FROM $wpdb->posts AS p
					INNER JOIN $wpdb->postmeta AS m ON p.ID = m.post_id
					WHERE p.post_author = %d
					AND p.post_type = %s
					AND p.post_status = %s
					AND m.meta_key = %s
					AND m.meta_value = %s
					AND YEAR(p.post_date) = %s AND MONTH(p.post_date) = %s AND DAY(p.post_date) = %s",
					$user_id, LP_ORDER_CPT, 'publish', '_learn_press_transaction_status', 'completed', $y, $m, $d
				)
			);
			break;
		case 'months':
			$orders = $wpdb->get_var(
				$wpdb->prepare(
					"SELECT COUNT(*)
					FROM $wpdb->posts AS p
					INNER JOIN $wpdb->postmeta AS m ON p.ID = m.post_id
					WHERE p.post_author = %d
					AND p.post_type = %s
					AND p.post_status = %s
					AND m.meta_key = %s
					AND m.meta_value = %s
					AND YEAR(p.post_date) = %s AND MONTH(p.post_date) = %s",
					$user_id, LP_ORDER_CPT, 'publish', '_learn_press_transaction_status', 'completed', $y, $m
				)
			);
			break;
	}
	return $orders;
}

/**
 * Count number of orders by status
 *
 * @param string Status of the orders
 *
 * @return int
 */
function learn_press_get_courses_by_status( $status ) {
	global $wpdb;
	$user_id = get_current_user_id();
	$courses = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(*)
			FROM $wpdb->posts
			WHERE post_author = %d
			AND post_type = %s
			AND post_status = %s",
			$user_id, LP_COURSE_CPT, $status
		)
	);
	return $courses;
}

/**
 * Count number of orders by price
 *
 * @param string
 *
 * @return int
 */
function learn_press_get_courses_by_price( $fee ) {
	global $wpdb;
	$user_id = get_current_user_id();
	$courses = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(*)
			FROM $wpdb->posts AS p
			INNER JOIN $wpdb->postmeta AS m ON p.ID = m.post_id
			WHERE p.post_author = %d
			AND p.post_type = %s
			AND p.post_status IN (%s, %s)
			AND m.meta_key = %s
			AND m.meta_value = %s",
			$user_id, LP_COURSE_CPT, 'publish', 'pending', '_lpr_course_payment', $fee
		)
	);
	return $courses;
}

/**
 * Get data about students to render in chart
 *
 * @param null $from
 * @param null $by
 * @param      $time_ago
 *
 * @return array
 */
function learn_press_get_chart_students( $from = null, $by = null, $time_ago ) {
	$labels   = array();
	$datasets = array();
	if ( is_null( $from ) ) {
		$from = current_time( 'mysql' );
	}
	// $by: days, months or years
	if ( is_null( $by ) ) {
		$by = 'days';
	}
	switch ( $by ) {
		case 'days':
			$date_format = 'M d';
			break;
		case 'months':
			$date_format = 'M Y';
			break;
		case 'years':
			$date_format = 'Y';
			break;
	}

	for ( $i = - $time_ago + 1; $i <= 0; $i ++ ) {
		$labels[]              = date( $date_format, strtotime( "$i $by", strtotime( $from ) ) );
		$datasets[0]['data'][] = learn_press_get_order_by_time( $by, strtotime( "$i $by", strtotime( $from ) ) );
	}
	$colors                              = learn_press_get_admin_colors();
	$datasets[0]['fillColor']            = 'rgba(255,255,255,0.1)';
	$datasets[0]['strokeColor']          = $colors[0];
	$datasets[0]['pointColor']           = $colors[0];
	$datasets[0]['pointStrokeColor']     = $colors[2];
	$datasets[0]['pointHighlightFill']   = $colors[2];
	$datasets[0]['pointHighlightStroke'] = $colors[0];
	return array(
		'labels'   => $labels,
		'datasets' => $datasets
	);
}

/**
 * Get data about students to render in chart
 *
 * @param null $from
 * @param null $by
 * @param      $time_ago
 *
 * @return array
 */
function learn_press_get_chart_users( $from = null, $by = null, $time_ago ) {
	global $wpdb;

	$labels   = array();
	$datasets = array();
	if ( is_null( $from ) ) {
		$from = current_time( 'mysql' );
	}
	if ( is_null( $by ) ) {
		$by = 'days';
	}
	$results   = array(
		'all'         => array(),
		'instructors' => array()
	);
	$from_time = is_numeric( $from ) ? $from : strtotime( $from );

	switch ( $by ) {
		case 'days':
			$date_format = 'M d Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-m-d', strtotime( "{$_from} {$by}", $from_time ) );
			$_to         = date( 'Y-m-d', $from_time );
			$_sql_format = '%Y-%m-%d';
			$_key_format = 'Y-m-d';
			break;
		case 'months':
			$date_format = 'M Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-m-01', strtotime( "{$_from} {$by}", $from_time ) );
			$days        = date( 't', mktime( 0, 0, 0, date( 'm', $from_time ), 1, date( 'Y', $from_time ) ) );
			$_to         = date( 'Y-m-' . $days, $from_time );
			$_sql_format = '%Y-%m';
			$_key_format = 'Y-m';
			break;
		case 'years':
			$date_format = 'Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-01-01', strtotime( "{$_from} {$by}", $from_time ) );
			$days        = date( 't', mktime( 0, 0, 0, date( 'm', $from_time ), 1, date( 'Y', $from_time ) ) );
			$_to         = date( 'Y-12-' . $days, $from_time );
			$_sql_format = '%Y';
			$_key_format = 'Y';

			break;
	}
	$query = $wpdb->prepare( "
				SELECT count(u.ID) as c, DATE_FORMAT( u.user_registered, %s) as d
				FROM {$wpdb->users} u
				WHERE 1
				GROUP BY d
				HAVING d BETWEEN %s AND %s
				ORDER BY d ASC
			", $_sql_format, $_from, $_to );
	if ( $_results = $wpdb->get_results( $query ) ) {
		foreach ( $_results as $k => $v ) {
			$results['all'][$v->d] = $v;
		}
	}
	$query = $wpdb->prepare( "
				SELECT count(u.ID) as c, DATE_FORMAT( u.user_registered, %s) as d
				FROM {$wpdb->users} u
				INNER JOIN {$wpdb->usermeta} um ON um.user_id = u.ID AND um.meta_key = %s AND ( um.meta_value LIKE %s OR um.meta_value LIKE %s )
				WHERE 1
				GROUP BY d
				HAVING d BETWEEN %s AND %s
				ORDER BY d ASC
			", $_sql_format, 'wp_capabilities', '%' . $wpdb->esc_like( 's:13:"administrator"' ) . '%', '%' . $wpdb->esc_like( 's:10:"lp_teacher"' ) . '%', $_from, $_to );

	if ( $_results = $wpdb->get_results( $query ) ) {
		foreach ( $_results as $k => $v ) {
			$results['instructors'][$v->d] = $v;
		}
	}
	for ( $i = - $time_ago + 1; $i <= 0; $i ++ ) {
		$date     = strtotime( "$i $by", $from_time );
		$labels[] = date( $date_format, $date );
		$key      = date( $_key_format, $date );

		$all         = !empty( $results['all'][$key] ) ? $results['all'][$key]->c : 0;
		$instructors = !empty( $results['instructors'][$key] ) ? $results['instructors'][$key]->c : 0;

		$datasets[0]['data'][] = $all;
		$datasets[1]['data'][] = $instructors;
		$datasets[2]['data'][] = $all - $instructors;
	}

	$dataset_params = array(
		array(
			'color1' => 'rgba(47, 167, 255, %s)',
			'color2' => '#FFF',
			'label'  => __( 'All', 'learnpress' )
		),
		array(
			'color1' => 'rgba(212, 208, 203, %s)',
			'color2' => '#FFF',
			'label'  => __( 'Instructors', 'learnpress' )
		),
		array(
			'color1' => 'rgba(234, 199, 155, %s)',
			'color2' => '#FFF',
			'label'  => __( 'Students', 'learnpress' )
		)
	);

	foreach ( $dataset_params as $k => $v ) {
		$datasets[$k]['fillColor']            = sprintf( $v['color1'], '0.2' );
		$datasets[$k]['strokeColor']          = sprintf( $v['color1'], '1' );
		$datasets[$k]['pointColor']           = sprintf( $v['color1'], '1' );
		$datasets[$k]['pointStrokeColor']     = $v['color2'];
		$datasets[$k]['pointHighlightFill']   = $v['color2'];
		$datasets[$k]['pointHighlightStroke'] = sprintf( $v['color1'], '1' );
		$datasets[$k]['label']                = $v['label'];
	}

	return array(
		'labels'   => $labels,
		'datasets' => $datasets,
		'sql'      => $query
	);
}


/**
 * Get data about students to render in chart
 *
 * @param null $from
 * @param null $by
 * @param      $time_ago
 *
 * @return array
 */
function learn_press_get_chart_courses( $from = null, $by = null, $time_ago ) {
	global $wpdb;

	$labels   = array();
	$datasets = array();
	if ( is_null( $from ) ) {
		$from = current_time( 'mysql' );
	}
	if ( is_null( $by ) ) {
		$by = 'days';
	}
	$results   = array(
		'all'     => array(),
		'public'  => array(),
		'pending' => array(),
		'free'    => array(),
		'paid'    => array()
	);
	$from_time = is_numeric( $from ) ? $from : strtotime( $from );

	switch ( $by ) {
		case 'days':
			$date_format = 'M d Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-m-d', strtotime( "{$_from} {$by}", $from_time ) );
			$_to         = date( 'Y-m-d', $from_time );
			$_sql_format = '%Y-%m-%d';
			$_key_format = 'Y-m-d';
			break;
		case 'months':
			$date_format = 'M Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-m-01', strtotime( "{$_from} {$by}", $from_time ) );
			$days        = date( 't', mktime( 0, 0, 0, date( 'm', $from_time ), 1, date( 'Y', $from_time ) ) );
			$_to         = date( 'Y-m-' . $days, $from_time );
			$_sql_format = '%Y-%m';
			$_key_format = 'Y-m';
			break;
		case 'years':
			$date_format = 'Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-01-01', strtotime( "{$_from} {$by}", $from_time ) );
			$days        = date( 't', mktime( 0, 0, 0, date( 'm', $from_time ), 1, date( 'Y', $from_time ) ) );
			$_to         = date( 'Y-12-' . $days, $from_time );
			$_sql_format = '%Y';
			$_key_format = 'Y';

			break;
	}

	$query = $wpdb->prepare( "
				SELECT count(c.ID) as c, DATE_FORMAT( c.post_date, %s) as d
				FROM {$wpdb->posts} c
				WHERE 1
				AND c.post_status IN('publish', 'pending') AND c.post_type = %s
				GROUP BY d
				HAVING d BETWEEN %s AND %s
				ORDER BY d ASC
			", $_sql_format, 'lp_course', $_from, $_to );
	if ( $_results = $wpdb->get_results( $query ) ) {
		foreach ( $_results as $k => $v ) {
			$results['all'][$v->d] = $v;
		}
	}
	$query = $wpdb->prepare( "
				SELECT count(c.ID) as c, DATE_FORMAT( c.post_date, %s) as d
				FROM {$wpdb->posts} c
				WHERE 1
				AND c.post_status = %s AND c.post_type = %s
				GROUP BY d
				HAVING d BETWEEN %s AND %s
				ORDER BY d ASC
			", $_sql_format, 'publish', 'lp_course', $_from, $_to );
	if ( $_results = $wpdb->get_results( $query ) ) {
		foreach ( $_results as $k => $v ) {
			$results['publish'][$v->d] = $v;
		}
	}

	$query = $wpdb->prepare( "
				SELECT count(c.ID) as c, DATE_FORMAT( c.post_date, %s) as d
				FROM {$wpdb->posts} c
				INNER JOIN {$wpdb->postmeta} cm ON cm.post_id = c.ID AND cm.meta_key = %s AND cm.meta_value = %s
				WHERE 1
				AND c.post_status = %s AND c.post_type = %s
				GROUP BY d
				HAVING d BETWEEN %s AND %s
				ORDER BY d ASC
			", $_sql_format, '_lp_payment', 'yes', 'publish', 'lp_course', $_from, $_to );
	if ( $_results = $wpdb->get_results( $query ) ) {
		foreach ( $_results as $k => $v ) {
			$results['paid'][$v->d] = $v;
		}
	}

	for ( $i = - $time_ago + 1; $i <= 0; $i ++ ) {
		$date     = strtotime( "$i $by", $from_time );
		$labels[] = date( $date_format, $date );
		$key      = date( $_key_format, $date );

		$all     = !empty( $results['all'][$key] ) ? $results['all'][$key]->c : 0;
		$publish = !empty( $results['publish'][$key] ) ? $results['publish'][$key]->c : 0;
		$paid    = !empty( $results['paid'][$key] ) ? $results['paid'][$key]->c : 0;

		$datasets[0]['data'][] = $all;
		$datasets[1]['data'][] = $publish;
		$datasets[2]['data'][] = $all - $publish;
		$datasets[3]['data'][] = $paid;
		$datasets[4]['data'][] = $all - $paid;
	}

	$dataset_params = array(
		array(
			'color1' => 'rgba(47, 167, 255, %s)',
			'color2' => '#FFF',
			'label'  => __( 'All', 'learnpress' )
		),
		array(
			'color1' => 'rgba(212, 208, 203, %s)',
			'color2' => '#FFF',
			'label'  => __( 'Publish', 'learnpress' )
		),
		array(
			'color1' => 'rgba(234, 199, 155, %s)',
			'color2' => '#FFF',
			'label'  => __( 'Pending', 'learnpress' )
		),
		array(
			'color1' => 'rgba(234, 199, 155, %s)',
			'color2' => '#FFF',
			'label'  => __( 'Paid', 'learnpress' )
		),
		array(
			'color1' => 'rgba(234, 199, 155, %s)',
			'color2' => '#FFF',
			'label'  => __( 'Free', 'learnpress' )
		)
	);

	foreach ( $dataset_params as $k => $v ) {
		$datasets[$k]['fillColor']            = sprintf( $v['color1'], '0.2' );
		$datasets[$k]['strokeColor']          = sprintf( $v['color1'], '1' );
		$datasets[$k]['pointColor']           = sprintf( $v['color1'], '1' );
		$datasets[$k]['pointStrokeColor']     = $v['color2'];
		$datasets[$k]['pointHighlightFill']   = $v['color2'];
		$datasets[$k]['pointHighlightStroke'] = sprintf( $v['color1'], '1' );
		$datasets[$k]['label']                = $v['label'];
	}

	return array(
		'labels'   => $labels,
		'datasets' => $datasets,
		'sql'      => $query
	);
}


/**
 * Get data about students to render in chart
 *
 * @param null $from
 * @param null $by
 * @param      $time_ago
 *
 * @return array
 */
function learn_press_get_chart_orders( $from = null, $by = null, $time_ago ) {
	global $wpdb;

	$labels   = array();
	$datasets = array();
	if ( is_null( $from ) ) {
		$from = current_time( 'mysql' );
	}
	if ( is_null( $by ) ) {
		$by = 'days';
	}
	$results   = array(
		'all'       => array(),
		'completed' => array(),
		'pending'   => array()
	);
	$from_time = is_numeric( $from ) ? $from : strtotime( $from );

	switch ( $by ) {
		case 'days':
			$date_format = 'M d Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-m-d', strtotime( "{$_from} {$by}", $from_time ) );
			$_to         = date( 'Y-m-d', $from_time );
			$_sql_format = '%Y-%m-%d';
			$_key_format = 'Y-m-d';
			break;
		case 'months':
			$date_format = 'M Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-m-01', strtotime( "{$_from} {$by}", $from_time ) );
			$days        = date( 't', mktime( 0, 0, 0, date( 'm', $from_time ), 1, date( 'Y', $from_time ) ) );
			$_to         = date( 'Y-m-' . $days, $from_time );
			$_sql_format = '%Y-%m';
			$_key_format = 'Y-m';
			break;
		case 'years':
			$date_format = 'Y';
			$_from       = - $time_ago + 1;
			$_from       = date( 'Y-01-01', strtotime( "{$_from} {$by}", $from_time ) );
			$days        = date( 't', mktime( 0, 0, 0, date( 'm', $from_time ), 1, date( 'Y', $from_time ) ) );
			$_to         = date( 'Y-12-' . $days, $from_time );
			$_sql_format = '%Y';
			$_key_format = 'Y';

			break;
	}

	$query = $wpdb->prepare( "
				SELECT count(o.ID) as c, DATE_FORMAT( o.post_date, %s) as d
				FROM {$wpdb->posts} o
				WHERE 1
				AND o.post_status IN('lp-completed') AND o.post_type = %s
				GROUP BY d
				HAVING d BETWEEN %s AND %s
				ORDER BY d ASC
			", $_sql_format, 'lp_order', $_from, $_to );
	if ( $_results = $wpdb->get_results( $query ) ) {
		foreach ( $_results as $k => $v ) {
			$results['all'][$v->d] = $v;
		}
	}
	$query = $wpdb->prepare( "
				SELECT count(o.ID) as c, DATE_FORMAT( o.post_date, %s) as d
				FROM {$wpdb->posts} o
				WHERE 1
				AND o.post_status IN('lp-pending', 'lp-processing') AND o.post_type = %s
				GROUP BY d
				HAVING d BETWEEN %s AND %s
				ORDER BY d ASC
			", $_sql_format, 'lp_order', $_from, $_to );
	if ( $_results = $wpdb->get_results( $query ) ) {
		foreach ( $_results as $k => $v ) {
			$results['completed'][$v->d] = $v;
		}
	}


	for ( $i = - $time_ago + 1; $i <= 0; $i ++ ) {
		$date     = strtotime( "$i $by", $from_time );
		$labels[] = date( $date_format, $date );
		$key      = date( $_key_format, $date );

		$all       = !empty( $results['all'][$key] ) ? $results['all'][$key]->c : 0;
		$completed = !empty( $results['completed'][$key] ) ? $results['completed'][$key]->c : 0;

		$datasets[0]['data'][] = $all;
		$datasets[1]['data'][] = $completed;
		$datasets[2]['data'][] = $all - $completed;
	}

	$dataset_params = array(
		array(
			'color1' => 'rgba(47, 167, 255, %s)',
			'color2' => '#FFF',
			'label'  => __( 'All', 'learnpress' )
		),
		array(
			'color1' => 'rgba(212, 208, 203, %s)',
			'color2' => '#FFF',
			'label'  => __( 'Completed', 'learnpress' )
		),
		array(
			'color1' => 'rgba(234, 199, 155, %s)',
			'color2' => '#FFF',
			'label'  => __( 'Pending', 'learnpress' )
		)
	);

	foreach ( $dataset_params as $k => $v ) {
		$datasets[$k]['fillColor']            = sprintf( $v['color1'], '0.2' );
		$datasets[$k]['strokeColor']          = sprintf( $v['color1'], '1' );
		$datasets[$k]['pointColor']           = sprintf( $v['color1'], '1' );
		$datasets[$k]['pointStrokeColor']     = $v['color2'];
		$datasets[$k]['pointHighlightFill']   = $v['color2'];
		$datasets[$k]['pointHighlightStroke'] = sprintf( $v['color1'], '1' );
		$datasets[$k]['label']                = $v['label'];
	}

	return array(
		'labels'   => $labels,
		'datasets' => $datasets,
		'sql'      => $query
	);
}

/**
 * Get data about courses to render in the chart
 * @return array
 */
function learn_press_get_chart_courses2() {
	$labels              = array( __( 'Pending Courses / Publish Courses', 'learnpress' ), __( 'Free Courses / Priced Courses', 'learnpress' ) );
	$datasets            = array();
	$datasets[0]['data'] = array( learn_press_get_courses_by_status( 'pending' ), learn_press_get_courses_by_price( 'free' ) );
	$datasets[1]['data'] = array( learn_press_get_courses_by_status( 'publish' ), learn_press_get_courses_by_price( 'not_free' ) );

	$colors                     = learn_press_get_admin_colors();
	$datasets[0]['fillColor']   = $colors[1];
	$datasets[0]['strokeColor'] = $colors[1];
	$datasets[1]['fillColor']   = $colors[3];
	$datasets[1]['strokeColor'] = $colors[3];
	return array(
		'labels'   => $labels,
		'datasets' => $datasets
	);
}

/**
 * Get colors setting up by admin user
 * @return array
 */
function learn_press_get_admin_colors() {
	$admin_color = get_user_meta( get_current_user_id(), 'admin_color', true );
	global $_wp_admin_css_colors;
	$colors = array();
	if ( !empty( $_wp_admin_css_colors[$admin_color]->colors ) ) {
		$colors = $_wp_admin_css_colors[$admin_color]->colors;
	}
	if ( empty ( $colors[0] ) ) {
		$colors[0] = '#000000';
	}
	if ( empty ( $colors[2] ) ) {
		$colors[2] = '#00FF00';
	}
	return $colors;
}

/**
 * Convert an array to json format and print out to browser
 *
 * @param array $chart
 */
function learn_press_process_chart( $chart = array() ) {
	$data = json_encode(
		array(
			'labels'   => $chart['labels'],
			'datasets' => $chart['datasets']
		)
	);
	echo $data;
}

/**
 * Print out the configuration for admin chart
 */
function learn_press_config_chart() {
	$colors = learn_press_get_admin_colors();
	$config = array(
		'scaleShowGridLines'      => true,
		'scaleGridLineColor'      => "#777",
		'scaleGridLineWidth'      => 0.3,
		'scaleFontColor'          => "#444",
		'scaleLineColor'          => $colors[0],
		'bezierCurve'             => true,
		'bezierCurveTension'      => 0.2,
		'pointDotRadius'          => 5,
		'pointDotStrokeWidth'     => 5,
		'pointHitDetectionRadius' => 20,
		'datasetStroke'           => true,
		'responsive'              => true,
		'tooltipFillColor'        => $colors[2],
		'tooltipFontColor'        => "#eee",
		'tooltipCornerRadius'     => 0,
		'tooltipYPadding'         => 10,
		'tooltipXPadding'         => 10,
		'barDatasetSpacing'       => 10,
		'barValueSpacing'         => 200

	);
	echo json_encode( $config );
}

function set_post_order_in_admin( $wp_query ) {
	global $pagenow;
	if ( isset( $_GET['post_type'] ) ) {
		$post_type = $_GET['post_type'];
	} else $post_type = '';
	if ( is_admin() && 'edit.php' == $pagenow && $post_type == LP_COURSE_CPT && !isset( $_GET['orderby'] ) ) {
		$wp_query->set( 'orderby', 'date' );
		$wp_query->set( 'order', 'DSC' );
	}
}

add_filter( 'pre_get_posts', 'set_post_order_in_admin' );
/**
 * Add actions to the list of the course. e.g: Duplicate link
 *
 * @param $actions
 *
 * @return mixed
 */
function learn_press_add_row_action_link( $actions ) {
	global $post;
	if ( LP_COURSE_CPT == $post->post_type ) {
		$duplicate_link = admin_url( 'edit.php?post_type=lp_course&action=lp-duplicate-course&post=' . $post->ID . '&nonce=' . wp_create_nonce( 'lp-duplicate-' . $post->ID ) );
		$duplicate_link = array(
			array(
				'link'  => $duplicate_link,
				'title' => __( 'Duplicate this course', 'learnpress' ),
				'class' => 'lp-duplicate-course'
			)
		);
		$links          = apply_filters( 'learn_press_row_action_links', $duplicate_link );
		if ( count( $links ) > 1 ) {
			$drop_down = array( '<ul class="lpr-row-action-dropdown">' );
			foreach ( $links as $link ) {
				$drop_down[] = '<li>' . sprintf( '<a href="%s" class="%s">%s</a>', $link['link'], $link['class'], $link['title'] ) . '</li>';
			};
			$drop_down[] = '</ul>';
			$link        = sprintf( '<div class="lpr-row-actions"><a href="%s">%s</a>%s</div>', 'javascript: void(0);', __( 'Course', 'learnpress' ), join( "\n", $drop_down ) );
		} else {
			$link = array_shift( $links );
			$link = sprintf( '<a href="%s" class="%s">%s</a>', $link['link'], $link['class'], $link['title'] );
		}
		$actions['lpr-course-row-action'] = $link;
	} else if ( LP_QUIZ_CPT === $post->post_type ) {
                $url = admin_url( 'edit.php?post_type='.LP_QUIZ_CPT.'&lp-action=lp-duplicate-quiz&post=' . $post->ID . '&nonce=' . wp_create_nonce( 'lp-duplicate-' . $post->ID ) );
                $link = sprintf( '<a href="%s" class="lp-duplicate-lesson">%s</a>', $url, __( 'Duplicate this quiz', 'learnpress' ) );
                $actions['lpr-course-row-action'] = $link;
        } else if ( LP_QUESTION_CPT === $post->post_type ) {
                $url = admin_url( 'edit.php?post_type='.LP_QUESTION_CPT.'&lp-action=lp-duplicate-question&post=' . $post->ID . '&nonce=' . wp_create_nonce( 'lp-duplicate-' . $post->ID ) );
                $link = sprintf( '<a href="%s" class="lp-duplicate-lesson">%s</a>', $url, __( 'Duplicate this question', 'learnpress' ) );
                $actions['lpr-course-row-action'] = $link;
        } else if ( LP_LESSON_CPT === $post->post_type ) {
                $url = admin_url( 'edit.php?post_type='.LP_LESSON_CPT.'&lp-action=lp-duplicate-lesson&post=' . $post->ID . '&nonce=' . wp_create_nonce( 'lp-duplicate-' . $post->ID ) );
                $link = sprintf( '<a href="%s" class="lp-duplicate-lesson">%s</a>', $url, __( 'Duplicate this lesson', 'learnpress' ) );
                $actions['lpr-course-row-action'] = $link;
        }
	return $actions;
}

add_filter( 'page_row_actions', 'learn_press_add_row_action_link' );

function learn_press_copy_post_meta( $from_id, $to_id ) {
	global $wpdb;
	$course_meta = $wpdb->get_results(
		$wpdb->prepare( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = %d", $from_id )
	);
	if ( count( $course_meta ) != 0 ) {
		$sql_query     = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
		$sql_query_sel = array();

		foreach ( $course_meta as $meta ) {
			$meta_key   = $meta->meta_key;
			$meta_value = addslashes( $meta->meta_value );

			$sql_query_sel[] = "SELECT {$to_id}, '$meta_key', '$meta_value'";
		}

		$sql_query .= implode( " UNION ALL ", $sql_query_sel );
		$wpdb->query( $sql_query );
	}
}

/**
 * Duplicate a course when user hit "Duplicate" button
 *
 * @author  TuNN
 */
function learn_press_process_duplicate_action() {

	$wp_list_table = _get_list_table( 'WP_Posts_List_Table' );
	$action        = $wp_list_table->current_action();

	if ( isset( $_REQUEST['action'] ) && $action == 'lp-duplicate-course' ) {
                // current is not usefully because this feature using ajax action
		$post_id = isset( $_REQUEST['post'] ) ? $_REQUEST['post'] : 0;
		$nonce   = !empty( $_REQUEST['nonce'] ) ? $_REQUEST['nonce'] : '';
		if ( !wp_verify_nonce( $nonce, 'lp-duplicate-' . $post_id ) ) {
			wp_die( __( 'Error', 'learnpress' ) );
		}
		if ( $post_id && is_array( $post_id ) ) {
			$post_id = array_shift( $post_id );
		}
		// check for post is exists
		if ( !( $post_id && $post = get_post( $post_id ) ) ) {
			wp_die( __( 'Oops! The course does not exists.', 'learnpress' ) );
		}
		// ensure that user can create course
		if ( !current_user_can( 'edit_posts' ) ) {
			wp_die( __( 'Sorry! You have not permission to duplicate this course.', 'learnpress' ) );
		}

		// assign course to current user
		$current_user      = wp_get_current_user();
		$new_course_author = $current_user->ID;

		// setup course data
		$new_course_title = $post->post_title . ' - Copy';
		$args             = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_course_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $new_course_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		// insert new course and get it ID
		$new_post_id = wp_insert_post( $args );

		if ( !$new_post_id ) {
			LP_Admin_Notice::add_redirect( __( '<p>Sorry! Duplicate course failed!</p>', 'learnpress' ) );
			wp_redirect( admin_url( 'edit.php?post_type=lp_course' ) );
			exit();
		}
		// assign related tags/categories to new course
		$taxonomies = get_object_taxonomies( $post->post_type );
		foreach ( $taxonomies as $taxonomy ) {
			$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
			wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
		}

		// duplicate course data
		global $wpdb;
		//learn_press_copy_post_meta( $post_id, $new_post_id );

		$query = $wpdb->prepare( "
			SELECT *
			FROM {$wpdb->prefix}learnpress_sections s
			INNER JOIN {$wpdb->posts} c ON c.ID = s.section_course_id
			WHERE c.ID = %d
		", $post->ID );
		if ( $sections = $wpdb->get_results( $query ) ) {
			foreach ( $sections as $section ) {
				$new_section_id = $wpdb->insert(
					$wpdb->prefix . 'learnpress_sections',
					array(
						'section_name'        => $section->section_name,
						'section_course_id'   => $new_post_id,
						'section_order'       => $section->section_order,
						'section_description' => $section->section_description
					),
					array( '%s', '%d', '%d', '%s' )
				);
				if ( $new_section_id ) {
					$query = $wpdb->prepare( "
						SELECT i.*
						FROM {$wpdb->posts} i
						INNER JOIN {$wpdb->prefix}learnpress_sections s ON i.item_id = i.ID
						WHERE s.section_id = %d
					", $section->section_id );
					if ( $items = $wpdb->get_results( $query ) ) {
						foreach ( $items as $item ) {
							$item_args = (array) $item;
							unset(
								$item_args['ID'],
								$item_args['post_author'],
								$item_args['post_date'],
								$item_args['post_date_gmt'],
								$item_args['post_modified'],
								$item_args['post_modified_gmt'],
								$item_args['comment_count']
							);
							$new_item_id = $wpdb->insert(
								$wpdb->posts,
								$item_args
							);
						}
					}
				}
			}
		}
		LP_Admin_Notice::add_redirect( __( '<p>Course duplicated.</p>', 'learnpress' ) );
		wp_redirect( admin_url( "post.php?post={$new_post_id}&action=edit" ) );
		die();
	}

        // duplicate action
        $action = ! empty( $_REQUEST['lp-action'] ) ? $_REQUEST['lp-action'] : '';
        $post_id = ! empty ( $_REQUEST['post'] ) ? $_REQUEST['post'] : 0;
        $nonce = ! empty( $_REQUEST['nonce'] ) ? $_REQUEST['nonce'] : '';
        if ( ! $post_id || ! wp_verify_nonce( $nonce, 'lp-duplicate-' . $post_id ) ) return;
        // only duplicate question. not assign any data
        $new_post_id = 0;
        if ( $action === 'lp-duplicate-question' ) {
            $new_post_id = learn_press_duplicate_question( $post_id );
            $post_type = LP_QUESTION_CPT;
            $error = __( 'Sorry! Duplicate question failed!', 'learnpress' );
            $success = __( 'Question duplicated.', 'learnpress' );
        } else if( $action === 'lp-duplicate-lesson' ) {
            $new_post_id = learn_press_duplicate_lesson( $post_id );
            $post_type = LP_LESSON_CPT;
            $error = __( 'Sorry! Duplicate lesson failed!', 'learnpress' ) ;
            $success = __( 'Lesson duplicated.', 'learnpress' );
        } else if ( $action === 'lp-duplicate-quiz' ) {
            $new_post_id = learn_press_duplicate_quiz( $post_id );
            $post_type = LP_QUIZ_CPT;
            $error = __( 'Sorry! Duplicate quiz failed!', 'learnpress' );
            $success = __( 'Quiz duplicated.', 'learnpress' );
        }

        if ( ! $new_post_id ) return;
        $redirect = 0;
        if ( is_wp_error( $new_post_id ) ) {
            LP_Admin_Notice::add_redirect( $error, 'error' );
            $redirect = admin_url( 'edit.php?post_type=' . $post_type );
        } else {
            LP_Admin_Notice::add_redirect( $success, 'updated' );
            $redirect = admin_url( 'post.php?post=' . $new_post_id . '&action=edit' );
        }

        if ( $redirect ) {
            wp_safe_redirect( $redirect ); exit();
        }
}

add_action( 'load-edit.php', 'learn_press_process_duplicate_action' );

function learn_press_admin_notice_bundle_activation() {
	if ( !empty( $_REQUEST['tab'] ) && ( 'bundle_activate' != $_REQUEST['tab'] ) && learn_press_get_notice_dismiss( 'bundle-addon-install', '' ) != 'off' ) {
		?>
		<div class="updated">
			<p>
				<?php printf( __( 'Want full free features? Click <a href="%s">here</a> to install LearnPress Add-ons Bundle for free!', 'learnpress' ), admin_url( 'admin.php?page=learn_press_add_ons&tab=bundle_activate' ) ); ?>
				<?php printf( '<a href="" class="learn-press-admin-notice-dismiss" data-context="bundle-addon-install" data-transient="-1"></a>' ); ?>
			</p>
		</div>
		<?php
	}
}

add_action( 'admin_notices', 'learn_press_admin_notice_bundle_activation' );

/**
 * Install a plugin
 *
 * @param string $plugin_name
 *
 * @return array
 */
function learn_press_install_add_on( $plugin_name ) {
	require_once( LP_PLUGIN_PATH . '/inc/admin/class-lp-upgrader.php' );
	$upgrader = new LP_Upgrader();
	global $wp_filesystem;
	$response = array();

	$package = 'http://thimpress.com/lprepo/' . $plugin_name . '.zip';

	$package = $upgrader->download_package( $package );
	if ( is_wp_error( $package ) ) {
		$response['error'] = $package;
	} else {
		$working_dir = $upgrader->unpack_package( $package, true, $plugin_name );
		if ( is_wp_error( $working_dir ) ) {
			$response['error'] = $working_dir;
		} else {

			$wp_upgrader = new WP_Upgrader();
			$options     = array(
				'source'            => $working_dir,
				'destination'       => WP_PLUGIN_DIR,
				'clear_destination' => false, // Do not overwrite files.
				'clear_working'     => true,
				'hook_extra'        => array(
					'type'   => 'plugin',
					'action' => 'install'
				)
			);
			//$response = array();
			$result = $wp_upgrader->install_package( $options );

			if ( is_wp_error( $result ) ) {
				$response['error'] = $result;
			} else {
				$response         = $result;
				$response['text'] = __( 'Installed', 'learnpress' );
			}
		}
	}
	return $response;
}

function learn_press_accept_become_a_teacher() {
	$action  = !empty( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
	$user_id = !empty( $_REQUEST['user_id'] ) ? $_REQUEST['user_id'] : '';
	if ( !$action || !$user_id || ( $action != 'accept-to-be-teacher' ) ) return;

	if ( !learn_press_user_maybe_is_a_teacher( $user_id ) ) {
		$be_teacher = new WP_User( $user_id );
		$be_teacher->set_role( LP_TEACHER_ROLE );
		delete_transient( 'learn_press_become_teacher_sent_' . $user_id );
		do_action( 'learn_press_user_become_a_teacher', $user_id );
		$redirect = add_query_arg( 'become-a-teacher-accepted', 'yes' );
		$redirect = remove_query_arg( 'action', $redirect );
		wp_redirect( $redirect );
	}
}

add_action( 'plugins_loaded', 'learn_press_accept_become_a_teacher' );

function learn_press_user_become_a_teacher_notice() {
	if ( $user_id = learn_press_get_request( 'user_id' ) && learn_press_get_request( 'become-a-teacher-accepted' ) == 'yes' ) {
		$user = new WP_User( $user_id );
		?>
		<div class="updated">
			<p><?php printf( __( 'The user %s has become a teacher', 'learnpress' ), $user->user_login ); ?></p>
		</div>
		<?php
	}
}

add_action( 'admin_notices', 'learn_press_user_become_a_teacher_notice' );

/**
 * Check to see if a plugin is already installed or not
 *
 * @param $plugin
 *
 * @return bool
 */
function learn_press_is_plugin_install( $plugin ) {
	$installed_plugins = get_plugins();
	return isset( $installed_plugins[$plugin] );
}

/**
 * Get plugin file that contains the information from slug
 *
 * @param $slug
 *
 * @return mixed
 */
function learn_press_plugin_basename_from_slug( $slug ) {
	$keys = array_keys( get_plugins() );
	foreach ( $keys as $key ) {
		if ( preg_match( '|^' . $slug . '/|', $key ) ) {
			return $key;
		}
	}
	return $slug;
}

function learn_press_one_click_install_sample_data_notice() {
	$courses = get_posts(
		array(
			'post_type'   => LP_COURSE_CPT,
			'post_status' => 'any'
		)
	);
	if ( ( 0 == sizeof( $courses ) ) && ( 'off' != get_transient( 'learn_press_install_sample_data' ) ) ) {
		printf(
			'<div class="updated" id="learn-press-install-sample-data-notice">
				<div class="install-sample-data-notice">
                <p>%s</p>
                <p>%s <strong>%s</strong> %s
                <p><a href="" class="button yes" data-action="yes">%s</a> <a href="" class="button disabled no" data-action="no">%s</a></p>
                </div>
                <div class="install-sample-data-loading">
                	<p>Importing...</p>
				</div>
            </div>',
			__( 'You haven\'t got any courses yet! Would you like to import sample data?', 'learnpress' ),
			__( 'If yes, it requires to install addon name', 'learnpress' ),
			__( 'LearnPress Import/Export', 'learnpress' ),
			__( 'but don\'t worry because it is completely automated.', 'learnpress' ),
			__( 'Import now', 'learnpress' ),
			__( 'No, thanks!', 'learnpress' )
		);
	}
}

//add_action( 'admin_notices', 'learn_press_one_click_install_sample_data_notice' );

function learn_press_request_query( $vars = array() ) {
	global $typenow, $wp_query, $wp_post_statuses;
	if ( LP_ORDER_CPT === $typenow ) {
		// Status
		if ( !isset( $vars['post_status'] ) ) {
			$post_statuses = learn_press_get_order_statuses();

			foreach ( $post_statuses as $status => $value ) {
				if ( isset( $wp_post_statuses[$status] ) && false === $wp_post_statuses[$status]->show_in_admin_all_list ) {
					unset( $post_statuses[$status] );
				}
			}

			$vars['post_status'] = array_keys( $post_statuses );

		}
	}
	return $vars;
}

add_filter( 'request', 'learn_press_request_query' );

function _learn_press_reset_course_data() {
	if ( empty( $_REQUEST['reset-course-data'] ) ) {
		return false;
	}
	learn_press_reset_course_data( intval( $_REQUEST['reset-course-data'] ) );
	wp_redirect( remove_query_arg( 'reset-course-data' ) );
}

add_action( 'init', '_learn_press_reset_course_data' );

/***********************/
function learn_press_admin_section_loop_item_class( $item, $section ) {
	$classes   = array(
		'lp-section-item'
	);
	$classes[] = 'lp-item-' . $item->post_type;
	if ( !absint( $item->ID ) ) {
		$classes[] = 'lp-item-empty lp-item-new focus';
	}
	$classes = apply_filters( 'learn_press_section_loop_item_class', $classes, $item, $section );
	if ( $classes ) echo 'class="' . join( ' ', $classes ) . '"';
	return $classes;
}

function learn_press_disable_checked_ontop( $args ) {

	if ( 'course_category' == $args['taxonomy'] ) {
		$args['checked_ontop'] = false;
	}

	return $args;
}

add_filter( 'wp_terms_checklist_args', 'learn_press_disable_checked_ontop' );

function learn_press_output_admin_template() {
	learn_press_admin_view( 'admin-template.php' );
}

add_action( 'admin_print_scripts', 'learn_press_output_admin_template' );

function learn_press_output_screen_id() {
	$screen = get_current_screen();
	if ( $screen ) {
		echo "<div style=\"position:fixed;top: 0; left:0; z-index: 99999999; background-color:#FFF;padding:4px;\">" . $screen->id . "</div>";
	}
}

//add_action( 'admin_head', 'learn_press_output_screen_id' );

function learn_press_get_screens() {
	$screen_id = sanitize_title( __( 'LearnPress', 'learnpress' ) );
	$screens   = array(
		'toplevel_page_' . $screen_id,
		$screen_id . '_page_learn_press_statistics',
		$screen_id . '_page_learn_press_add_ons'
	);
	foreach ( array( 'lp_course', 'lp_lesson', 'lp_quiz', 'lp_question', 'lp_order' ) as $post_type ) {
		$screens[] = 'edit-' . $post_type;
		$screens[] = $post_type;
	}

	return apply_filters( 'learn_press_screen_ids', $screens );
}

function learn_press_get_admin_pages() {
	return apply_filters(
		'learn_press_admin_pages',
		array(
			'learn_press_settings'
		)
	);
}

function learn_press_is_post_type_screen( $post_type, $union = 'OR' ) {
	if ( is_array( $post_type ) ) {
		$return = null;
		foreach ( $post_type as $_post_type ) {
			$check = learn_press_is_post_type_screen( $_post_type );
			if ( $union == 'OR' && $check ) {
				return true;
			}
			if ( $return == null ) {
				$return = $check;
			} else {
				$return = $return && $check;
			}
			if ( $union !== 'OR' ) {
				return $return;
			}
		}
		return $return;
	}
	$screen = get_current_screen();
	if ( !$screen ) {
		return;
	}
	$screen_id = $screen->id;
	return in_array( $screen_id, array( $post_type, "edit-{$post_type}" ) );
}

function learn_press_get_notice_dismiss( $context, $type = 'transient' ) {
	if ( $type == 'transient' ) {
		return get_transient( 'learn_press_dismiss_notice_' . $context );
	}
	return get_option( 'learn_press_dismiss_notice_' . $context );
}

if ( !function_exists( 'learn_press_course_insert_section' ) ) {

    function learn_press_course_insert_section( $section = array() ) {
        global $wpdb;
        $section = wp_parse_args(
            $section,
            array(
                'section_name' => '',
                'section_course_id' => 0,
                'section_order' => 0,
                'section_description' => ''
            )
        );
        $section = stripslashes_deep($section);
        extract($section);

        $insert_data = compact('section_name', 'section_course_id', 'section_order', 'section_description');
        $wpdb->insert(
            $wpdb->learnpress_sections,
            $insert_data,
            array('%s', '%d', '%d')
        );

        return $wpdb->insert_id;
    }
    
}

if ( !function_exists( 'learn_press_course_insert_section_item' ) ) {

    function learn_press_course_insert_section_item( $item_data = array() ) {
        global $wpdb;
        $wpdb->insert(
                    $wpdb->learnpress_section_items,
                    array(
                        'section_id'    => $item_data['section_id'],
                        'item_id'       => $item_data['item_id'],
                        'item_order'    => $item_data['item_order'],
                        'item_type'     => $item_data['item_type']
                    ),
                    array(
                        '%d',
                        '%d',
                        '%d',
                        '%s',
                    )
                );
        return $wpdb->insert_id;
    }

}

if ( !function_exists( 'learn_press_duplicate_post' ) ) {

    function learn_press_duplicate_post( $post_id = null, $args = array(), $meta = true ) {
        $post = get_post( $post_id );
        if ( ! $post ) return;
        $defalts   = array(
                        'comment_status' => $post->comment_status,
                        'ping_status'    => $post->ping_status,
                        'post_author'    => get_current_user_id(),
                        'post_content'   => $post->post_content,
                        'post_excerpt'   => $post->post_excerpt,
                        'post_parent'    => $post->post_parent,
                        'post_password'  => $post->post_password,
                        'post_status'    => 'draft',
                        'post_title'     => $post->post_title . ' - Copy',
                        'post_type'      => $post->post_type,
                        'to_ping'        => $post->to_ping,
                        'menu_order'     => $post->menu_order
                );
        $args = wp_parse_args( $args, $defalts );
        $new_post_id = wp_insert_post( $args );

        if ( ! is_wp_error( $new_post_id ) && $meta ) {
            learn_press_duplicate_post_meta( $post_id, $new_post_id );
            // assign related tags/categories to new course
            $taxonomies = get_object_taxonomies( $post->post_type );
            foreach ( $taxonomies as $taxonomy ) {
                    $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
                    wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
            }
        }
        return apply_filters( 'learn_press_duplicate_post', $new_post_id, $post_id );
    }
}

if ( !function_exists( 'learn_press_duplicate_post_meta' ) ) {
    /**
     * duplicate all post meta just in two SQL queries
     */
    function learn_press_duplicate_post_meta( $old_post_id, $new_post_id, $excerpt = array() ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$old_post_id" );
        if ( count( $post_meta_infos )!= 0 ) {
                $excerpt = array_merge( array( '_edit_lock', '_edit_last' ), $excerpt );
                $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                $sql_query_sel = array();
                foreach ( $post_meta_infos as $meta ) {
                    if ( in_array( $meta->meta_value, $excerpt ) ) {
                        continue;
                    }
                    $meta_key = $meta->meta_key;
                    $meta_value = addslashes($meta->meta_value);
                    $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
                }
                $sql_query.= implode(" UNION ALL ", $sql_query_sel);
                $wpdb->query( $sql_query );
        }
    }
    
}

add_filter( 'learn_press_question_types', 'learn_press_sort_questions', 99 );
if ( !function_exists( 'learn_press_sort_questions' ) ) {
    function learn_press_sort_questions( $types ) {
        $user_id = get_current_user_id();
        $question_types = get_user_meta( $user_id, '_learn_press_memorize_question_types', true );
        if ( ! empty( $question_types ) ) {
            $sort = array();
            // re-sort array descending
            arsort( $question_types );
            $new_types = array();
            $ktypes = array_keys( $types );

            for( $i = 0; $i < count( $ktypes ) - 1; $i++ ) {
                $max = $i;
                if ( !isset( $question_types[ $ktypes[$i] ] ) ) {
                    $question_types[ $ktypes[$i] ] = 0;
                }
                for( $j = $i + 1; $j < count( $ktypes ); $j++ ) {
                    if ( isset( $question_types[ $ktypes[$j] ], $question_types[ $ktypes[$max] ] ) 
                            && $question_types[ $ktypes[$j] ] > $question_types[ $ktypes[$max] ] ) {
                        $max = $j;
                    }
                }
                $tmp = $ktypes[$i];
                $ktypes[$i] = $ktypes[$max];
                $ktypes[$max] = $tmp;
            }
            $ktypes = array_flip( $ktypes );
            $types = array_merge( $ktypes, $types );
        }
        return $types;
    }
}

if ( !function_exists( 'learn_press_dulicate_course' ) ) {
    
    function learn_press_dulicate_course( $course_id = null, $force = true ) {
        if ( !function_exists( '_learn_press_get_course_curriculum' ) ) {
            require_once LP_PLUGIN_PATH . 'inc/lp-init.php';
        }
        global $wpdb;

        if ( $course_id && is_array( $course_id ) ) {
            $course_id = array_shift( $course_id );
        }
        // check for post is exists
        if ( ! $course_id || ! ( $post = get_post( $course_id ) ) ) {
            return new WP_Error( __( '<p>Op! The course does not exists</p>', 'learnpress' ) );
        } else {
            // ensure that user can create course
            if ( !current_user_can( 'edit_posts' ) ) {
                return new WP_Error( __( '<p>Sorry! You have not permission to duplicate this course</p>', 'learnpress' ) );
            } else {
                // duplicate course
                $new_course_id = learn_press_duplicate_post( $course_id );
                if ( ! $new_course_id || is_wp_error( $new_course_id ) ) {
                    return new WP_Error( __( '<p>Sorry! Duplicate course failed!</p>', 'learnpress' ) );
                } else {
                    $curriculums = _learn_press_get_course_curriculum( $course_id );
                    foreach ( $curriculums as $section_id => $section ) {
                        $new_section_id = learn_press_course_insert_section( array(
                            'section_name'          => $section->section_name,
                            'section_course_id'     => $new_course_id,
                            'section_order'         => $section->section_order,
                            'section_description'   => $section->section_description
                        ) );

                        if ( $section->items ) {
                            foreach ( $section->items as $item ) {
                                // duplicate item
                                if ( $force && $item->post_type === LP_QUIZ_CPT ) {
                                    $item_id = learn_press_duplicate_quiz( $item->ID, array( 'post_status' => 'publish' ) );
                                } else {
                                    $item_id = learn_press_duplicate_post( $item->ID, array( 'post_status' => 'publish' ) );
                                }
                                if ( $force ) {
                                    $section_item_id = learn_press_course_insert_section_item( array(
                                        'section_id'    => $new_section_id,
                                        'item_id'       => $item_id,
                                        'item_order'    => $item->item_order,
                                        'item_type'     => $item->item_type
                                    ) );
                                }
                            }
                        }
                    }
                    return $new_course_id;
                }
            }
        }
    }

}

if ( !function_exists( 'learn_press_duplicate_question' ) ) {

    function learn_press_duplicate_question( $question_id = null, $quiz_id = null ) {
        if ( ! $question_id || ! get_post( $question_id ) ) {
            return new WP_Error( sprintf( __( 'Question id %s is not exists.', 'learnpress' ), $question_id ) );
        }
        if ( $quiz_id && ! get_post( $quiz_id ) ) {
            return new WP_Error( sprintf( __( 'Quiz id %s is not exists.', 'learnpress' ), $quiz_id ) );
        }

        global $wpdb;
        $new_question_id = learn_press_duplicate_post( $question_id );
        if ( $quiz_id ) {
            // learnpress_quiz_questions
            $sql = $wpdb->prepare( "
                        SELECT * FROM $wpdb->learnpress_quiz_questions WHERE quiz_id = %d AND question_id = %d
                    ", $quiz_id, $question_id );
            $quiz_question_data = $wpdb->get_row( $sql );
            $max_order = $wpdb->get_var( $wpdb->prepare( "SELECT max(question_order) FROM {$wpdb->prefix}learnpress_quiz_questions WHERE quiz_id = %d", $quiz_id ) );

            if ( $quiz_question_data ) {
                $wpdb->insert(
                        $wpdb->learnpress_quiz_questions,
                        array(
                            'quiz_id'           => $quiz_id,
                            'question_id'       => $new_question_id,
                            'question_order'    => $max_order + 1,
                            'params'            => $quiz_question_data->params
                        ),
                        array(
                            '%d',
                            '%d',
                            '%d',
                            '%s'
                        )
                    );
            }
        }
        // learnpress_question_answers
        $sql = $wpdb->prepare( "
                    SELECT * FROM $wpdb->learnpress_question_answers WHERE question_id = %d
                ", $question_id );
        $question_answers = $wpdb->get_results( $sql );
        if ( $question_answers ) {
            foreach ( $question_answers as $q_a ) {
                $wpdb->insert(
                        $wpdb->learnpress_question_answers,
                        array(
                            'question_id'    => $new_question_id,
                            'answer_data'    => $q_a->answer_data,
                            'answer_order'   => $q_a->answer_order
                        ),
                        array(
                            '%d',
                            '%s',
                            '%s'
                        )
                    );
            }
        }
        
        return $new_question_id;
    }

}

if ( !function_exists( 'learn_press_duplicate_quiz' ) ) {

    function learn_press_duplicate_quiz( $quiz_id = null, $args = array() ) {
        global $wpdb;
        $new_quiz_id = learn_press_duplicate_post( $quiz_id, $args, true );
        $quiz = LP_Quiz::get_quiz( $quiz_id );
        $questions = $quiz->get_questions();
        if ( $questions ) {
            $questions = array_keys( $questions );
            foreach ( $questions as $question_id ) {
                $new_question_id = learn_press_duplicate_post( $question_id );
                // learnpress_quiz_questions
                $sql = $wpdb->prepare( "
                            SELECT * FROM $wpdb->learnpress_quiz_questions WHERE quiz_id = %d AND question_id = %d
                        ", $quiz_id, $question_id );
                $quiz_question_data = $wpdb->get_row( $sql );
                if ( $quiz_question_data ) {
                    $wpdb->insert(
                            $wpdb->learnpress_quiz_questions,
                            array(
                                'quiz_id'           => $new_quiz_id,
                                'question_id'       => $new_question_id,
                                'question_order'    => $quiz_question_data->question_order,
                                'params'            => $quiz_question_data->params
                            ),
                            array(
                                '%d',
                                '%d',
                                '%d',
                                '%s'
                            )
                        );
                }
                // learnpress_question_answers
                $sql = $wpdb->prepare( "
                            SELECT * FROM $wpdb->learnpress_question_answers WHERE question_id = %d
                        ", $question_id );
                $question_answers = $wpdb->get_results( $sql );
                if ( $question_answers ) {
                    foreach ( $question_answers as $q_a ) {
                        $wpdb->insert(
                                $wpdb->learnpress_question_answers,
                                array(
                                    'question_id'    => $new_question_id,
                                    'answer_data'    => $q_a->answer_data,
                                    'answer_order'   => $q_a->answer_order
                                ),
                                array(
                                    '%d',
                                    '%s',
                                    '%s'
                                )
                            );
                    }
                }
            }
        }

        return $new_quiz_id;
    }
    
}

if ( !function_exists( 'learn_press_duplicate_lesson' ) ) {

    function learn_press_duplicate_lesson( $lesson_id = null ) {
        return learn_press_duplicate_post( $lesson_id );
    }
    
}
