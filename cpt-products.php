<?php
/*
Plugin Name: Custom Post Type Products
Plugin URI: http://horttcore.de.de
Description: Custom Post Type Products
Version: 0.1
Author: Ralf Hortt
Author URI: http://horttcorte.de
License: GPL2
*/



/**
 *
 *  Custom Post Type Produts
 *
 */
class Custom_Post_Type_Products
{



	/**
	 * Plugin constructor
	 *
	 * @return void
	 * @author Ralf Hortt
	 **/
	function __construct()
	{
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );

		load_plugin_textdomain( 'cpt-products', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
	}



	/**
	 * Update messages
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function post_updated_messages( $messages ) {
		global $post, $post_ID;

		$messages['product'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __('Product updated. <a href="%s">View Product</a>', 'cpt-products'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.', 'cpt-products'),
			3 => __('Custom field deleted.', 'cpt-products'),
			4 => __('Product updated.', 'cpt-products'),
			/* translators: %s: date and time of the revision */
			5 => isset($_GET['revision']) ? sprintf( __('Product restored to revision from %s', 'cpt-products'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Product published. <a href="%s">View Product</a>', 'cpt-products'), esc_url( get_permalink($post_ID) ) ),
			7 => __('Product saved.', 'cpt-products'),
			8 => sprintf( __('Product submitted. <a target="_blank" href="%s">Preview Product</a>', 'cpt-products'), esc_url( add_query_arg( 'preview', 'TRUE', get_permalink($post_ID) ) ) ),
			9 => sprintf( __('Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Product</a>', 'cpt-products'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('Product draft updated. <a target="_blank" href="%s">Preview Product</a>', 'cpt-products'), esc_url( add_query_arg( 'preview', 'TRUE', get_permalink($post_ID) ) ) ),
		);

		return $messages;
	}



	/**
	 *
	 * POST TYPES
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 */
	public function register_post_type()
	{
		$labels = array(
			'name' => _x( 'Products', 'post type general name', 'cpt-products' ),
			'singular_name' => _x( 'Product', 'post type singular name', 'cpt-products' ),
			'add_new' => _x( 'Add New', 'Product', 'cpt-products' ),
			'add_new_item' => __( 'Add New Product', 'cpt-products' ),
			'edit_item' => __( 'Edit Product', 'cpt-products' ),
			'new_item' => __( 'New Product', 'cpt-products' ),
			'view_item' => __( 'View Product', 'cpt-products' ),
			'search_items' => __( 'Search Product', 'cpt-products' ),
			'not_found' =>  __( 'No Products found', 'cpt-products' ),
			'not_found_in_trash' => __( 'No Products found in Trash', 'cpt-products' ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Products', 'cpt-products' )
		);

		$args = array(
			'labels' => $labels,
			'public' => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui' => TRUE,
			'show_in_menu' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array( 'slug' => _x( 'product', 'Post Type Slug', 'cpt-products' ) ),
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => TRUE,
			'menu_position' => NULL,
			'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'excerpt')
		);

		register_post_type( 'product', $args);
	}



	/**
	 *
	 * CUSTOM TAXONOMY
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 */
	public function register_taxonomy()
	{
		$labels = array(
			'name' => _x( 'Categories', 'taxonomy general name', 'cpt-products' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name', 'cpt-products' ),
			'search_items' =>  __( 'Search Categories', 'cpt-products' ),
			'all_items' => __( 'All Categories', 'cpt-products' ),
			'parent_item' => __( 'Parent Category', 'cpt-products' ),
			'parent_item_colon' => __( 'Parent Category:', 'cpt-products' ),
			'edit_item' => __( 'Edit Category', 'cpt-products' ),
			'update_item' => __( 'Update Category', 'cpt-products' ),
			'add_new_item' => __( 'Add New Category', 'cpt-products' ),
			'new_item_name' => __( 'New Category Name', 'cpt-products' ),
			'menu_name' => __( 'Categories', 'cpt-products' ),
		);

		register_taxonomy('product-category',array('product'), array(
			'hierarchical' => TRUE,
			'labels' => $labels,
			'show_ui' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array( 'slug' => _x('product-category', 'Product Category Slug', 'cpt-products') )
		));
	}



}

new Custom_Post_Type_Products;