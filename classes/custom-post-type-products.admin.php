<?php
/**
 *
 *  Custom Post Type Produts
 *
 */
final class Custom_Post_Type_Products_Admin
{



	/**
	 * Plugin constructor
	 *
	 * @access public
	 * @return void
	 * @since v0.3
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function __construct()
	{

		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );

	} // END __construct



	/**
	 * Update messages
	 *
	 * @access public
	 * @param array $messages Messages
	 * @return array Messages
	 * @since v0.3
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function post_updated_messages( $messages )
	{

		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages['product'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Product updated.', 'custom-post-type-products' ),
			2  => __( 'Custom field updated.' ),
			3  => __( 'Custom field deleted.' ),
			4  => __( 'Product updated.', 'custom-post-type-products' ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Product restored to revision from %s', 'custom-post-type-products' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Product published.', 'custom-post-type-products' ),
			7  => __( 'Product saved.', 'custom-post-type-products' ),
			8  => __( 'Product submitted.', 'custom-post-type-products' ),
			9  => sprintf( __( 'Product scheduled for: <strong>%1$s</strong>.', 'custom-post-type-products' ), date_i18n( __( 'M j, Y @ G:i', 'custom-post-type-products' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Product draft updated.', 'custom-post-type-products' )
		);

		if ( $post_type_object->publicly_queryable ) :

			$permalink = get_permalink( $post->ID );

			$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View product', 'custom-post-type-products' ) );
			$messages[ $post_type ][1] .= $view_link;
			$messages[ $post_type ][6] .= $view_link;
			$messages[ $post_type ][9] .= $view_link;

			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview product', 'custom-post-type-products' ) );
			$messages[ $post_type ][8]  .= $preview_link;
			$messages[ $post_type ][10] .= $preview_link;

		endif;

		return $messages;

	} // END post_updated_messages



} // END final class Custom_Post_Type_Products_Admin

new Custom_Post_Type_Products_Admin;
