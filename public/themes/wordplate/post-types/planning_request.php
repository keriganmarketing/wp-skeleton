<?php

/**
 * Registers the `planning_request` post type.
 */
function planning_request_init() {
	register_post_type( 'planning_request', array(
		'labels'                => array(
			'name'                  => __( 'Planning requests', 'wordplate' ),
			'singular_name'         => __( 'Planning request', 'wordplate' ),
			'all_items'             => __( 'All Planning requests', 'wordplate' ),
			'archives'              => __( 'Planning request Archives', 'wordplate' ),
			'attributes'            => __( 'Planning request Attributes', 'wordplate' ),
			'insert_into_item'      => __( 'Insert into planning request', 'wordplate' ),
			'uploaded_to_this_item' => __( 'Uploaded to this planning request', 'wordplate' ),
			'featured_image'        => _x( 'Featured Image', 'planning_request', 'wordplate' ),
			'set_featured_image'    => _x( 'Set featured image', 'planning_request', 'wordplate' ),
			'remove_featured_image' => _x( 'Remove featured image', 'planning_request', 'wordplate' ),
			'use_featured_image'    => _x( 'Use as featured image', 'planning_request', 'wordplate' ),
			'filter_items_list'     => __( 'Filter planning requests list', 'wordplate' ),
			'items_list_navigation' => __( 'Planning requests list navigation', 'wordplate' ),
			'items_list'            => __( 'Planning requests list', 'wordplate' ),
			'new_item'              => __( 'New Planning request', 'wordplate' ),
			'add_new'               => __( 'Add New', 'wordplate' ),
			'add_new_item'          => __( 'Add New Planning request', 'wordplate' ),
			'edit_item'             => __( 'Edit Planning request', 'wordplate' ),
			'view_item'             => __( 'View Planning request', 'wordplate' ),
			'view_items'            => __( 'View Planning requests', 'wordplate' ),
			'search_items'          => __( 'Search planning requests', 'wordplate' ),
			'not_found'             => __( 'No planning requests found', 'wordplate' ),
			'not_found_in_trash'    => __( 'No planning requests found in trash', 'wordplate' ),
			'parent_item_colon'     => __( 'Parent Planning request:', 'wordplate' ),
			'menu_name'             => __( 'Planning requests', 'wordplate' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'planning_request',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'supports' 				=> ['title']
	) );

}
add_action( 'init', 'planning_request_init' );
add_action('add_meta_boxes', 'kma_add_plans_metaboxes');

/**
 * Sets the post updated messages for the `planning_request` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `planning_request` post type.
 */
function planning_request_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['planning_request'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Planning request updated. <a target="_blank" href="%s">View planning request</a>', 'wordplate' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wordplate' ),
		3  => __( 'Custom field deleted.', 'wordplate' ),
		4  => __( 'Planning request updated.', 'wordplate' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Planning request restored to revision from %s', 'wordplate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Planning request published. <a href="%s">View planning request</a>', 'wordplate' ), esc_url( $permalink ) ),
		7  => __( 'Planning request saved.', 'wordplate' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Planning request submitted. <a target="_blank" href="%s">Preview planning request</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Planning request scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview planning request</a>', 'wordplate' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Planning request draft updated. <a target="_blank" href="%s">Preview planning request</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}

function kma_add_plans_metaboxes()
{
	add_meta_box(
		'email',
		'Email',
		'kma_email_metabox',
		'planning_request',
		'normal',
		'default'
	);

	add_meta_box(
		'maxWidth',
		'Max Buildable Width',
		'kma_maxWidth_metabox',
		'planning_request',
		'normal',
		'default'
	);

	add_meta_box(
		'maxDepth',
		'Max Buildable Depth',
		'kma_maxDepth_metabox',
		'planning_request',
		'normal',
		'default'
	);

	add_meta_box(
		'bedrooms',
		'Bedrooms',
		'kma_bedrooms_metabox',
		'planning_request',
		'normal',
		'default'
	);
	add_meta_box(
		'bathrooms',
		'Bathrooms',
		'kma_bathrooms_metabox',
		'planning_request',
		'normal',
		'default'
	);
	add_meta_box(
		'elevator',
		'Elevator?',
		'kma_elevator_metabox',
		'planning_request',
		'normal',
		'default'
	);
	add_meta_box(
		'floodZone',
		'Flood Zone?',
		'kma_floodzone_metabox',
		'planning_request',
		'normal',
		'default'
	);
	add_meta_box(
		'comments',
		'Comments',
		'kma_comments_metabox',
		'planning_request',
		'normal',
		'default'
	);
}

function kma_email_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $email = get_post_meta($post->ID, 'email', true);
	// Output the field
	echo '<a href="mailto:' . $email . '">' . $email .'</a>';
}

function kma_maxWidth_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $max = get_post_meta($post->ID, 'maxWidth', true);
	// Output the field
	echo '<p>'. $max . '</p>';
}

function kma_maxDepth_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $max = get_post_meta($post->ID, 'maxDepth', true);
	// Output the field
	echo '<p>'. $max . '</p>';
}

function kma_bedrooms_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $beds = get_post_meta($post->ID, 'bedrooms', true);
	// Output the field
	echo '<p>'. $beds . '</p>';
}

function kma_bathrooms_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $baths = get_post_meta($post->ID, 'bathrooms', true);
	// Output the field
	echo '<p>'. $baths . '</p>';
}

function kma_elevator_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $elevator = get_post_meta($post->ID, 'elevator', true);
	// Output the field
	echo '<p>'. $elevator . '</p>';
}

function kma_floodzone_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $fz = get_post_meta($post->ID, 'floodZone', true);
	// Output the field
	echo '<p>'. $fz . '</p>';
}

function kma_comments_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $comments = get_post_meta($post->ID, 'comments', true);
	// Output the field
	echo '<p>'. $comments . '</p>';
}

add_filter( 'post_updated_messages', 'planning_request_updated_messages' );
