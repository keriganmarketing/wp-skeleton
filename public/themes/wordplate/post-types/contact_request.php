<?php

/**
 * Registers the `contact_request` post type.
 */
function contact_request_init() {
	register_post_type( 'contact_request', array(
		'labels'                => array(
			'name'                  => __( 'Contact requests', 'wordplate' ),
			'singular_name'         => __( 'Contact request', 'wordplate' ),
			'all_items'             => __( 'All Contact requests', 'wordplate' ),
			'archives'              => __( 'Contact request Archives', 'wordplate' ),
			'attributes'            => __( 'Contact request Attributes', 'wordplate' ),
			'insert_into_item'      => __( 'Insert into contact request', 'wordplate' ),
			'uploaded_to_this_item' => __( 'Uploaded to this contact request', 'wordplate' ),
			'featured_image'        => _x( 'Featured Image', 'contact_request', 'wordplate' ),
			'set_featured_image'    => _x( 'Set featured image', 'contact_request', 'wordplate' ),
			'remove_featured_image' => _x( 'Remove featured image', 'contact_request', 'wordplate' ),
			'use_featured_image'    => _x( 'Use as featured image', 'contact_request', 'wordplate' ),
			'filter_items_list'     => __( 'Filter contact requests list', 'wordplate' ),
			'items_list_navigation' => __( 'Contact requests list navigation', 'wordplate' ),
			'items_list'            => __( 'Contact requests list', 'wordplate' ),
			'new_item'              => __( 'New Contact request', 'wordplate' ),
			'add_new'               => __( 'Add New', 'wordplate' ),
			'add_new_item'          => __( 'Add New Contact request', 'wordplate' ),
			'edit_item'             => __( 'Edit Contact request', 'wordplate' ),
			'view_item'             => __( 'View Contact request', 'wordplate' ),
			'view_items'            => __( 'View Contact requests', 'wordplate' ),
			'search_items'          => __( 'Search contact requests', 'wordplate' ),
			'not_found'             => __( 'No contact requests found', 'wordplate' ),
			'not_found_in_trash'    => __( 'No contact requests found in trash', 'wordplate' ),
			'parent_item_colon'     => __( 'Parent Contact request:', 'wordplate' ),
			'menu_name'             => __( 'Contact requests', 'wordplate' ),
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
		'rest_base'             => 'contact_request',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'supports' 				=> ['title']
	) );

}
add_action( 'init', 'contact_request_init' );

/**
 * Sets the post updated messages for the `contact_request` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `contact_request` post type.
 */
function contact_request_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['contact_request'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Contact request updated. <a target="_blank" href="%s">View contact request</a>', 'wordplate' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wordplate' ),
		3  => __( 'Custom field deleted.', 'wordplate' ),
		4  => __( 'Contact request updated.', 'wordplate' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Contact request restored to revision from %s', 'wordplate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Contact request published. <a href="%s">View contact request</a>', 'wordplate' ), esc_url( $permalink ) ),
		7  => __( 'Contact request saved.', 'wordplate' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Contact request submitted. <a target="_blank" href="%s">Preview contact request</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Contact request scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview contact request</a>', 'wordplate' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Contact request draft updated. <a target="_blank" href="%s">Preview contact request</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
function kma_add_contact_metaboxes()
{
	add_meta_box(
		'email',
		'Email',
		'contact_email_metabox',
		'contact_request',
		'normal',
		'default'
	);

	add_meta_box(
		'comments',
		'Comments',
		'contact_comments_metabox',
		'contact_request',
		'normal',
		'default'
	);
}

function contact_email_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $email = get_post_meta($post->ID, 'email', true);
	// Output the field
	echo '<a href="mailto:' . $email . '">' . $email .'</a>';
}

function contact_comments_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $comments = get_post_meta($post->ID, 'comments', true);
	// Output the field
	echo '<p>'. $comments . '</p>';
}

add_filter( 'post_updated_messages', 'contact_request_updated_messages' );
add_action('add_meta_boxes', 'kma_add_contact_metaboxes');
