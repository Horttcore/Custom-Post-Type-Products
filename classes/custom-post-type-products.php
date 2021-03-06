<?php
/**
 *
 *  Custom Post Type Produts
 *
 */
final class Custom_Post_Type_Products
{



	/**
	 * Plugin constructor
	 *
	 * @access public
	 * @return void
	 * @since 0.3
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function __construct()
	{

		add_action( 'custom-post-type-products-widget-output', 'Custom_Post_Type_Products_Widget::widget_output', 10, 3 );
		add_action( 'custom-post-type-products-widget-loop-output', 'Custom_Post_Type_Products_Widget::widget_loop_output', 10, 3 );
		add_action( 'init', [$this, 'register_post_type'] );
		add_action( 'init', [$this, 'register_taxonomy'] );
		add_action( 'plugins_loaded', [$this, 'load_plugin_textdomain'] );
		add_filter( 'widgets_init', [$this, 'widgets_init'] );

	} // END __construct



	/**
	 * Load plugin translation
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt <me@horttcore.de>
	 * @since 0.3
	 **/
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain( 'custom-post-type-products', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages/'  );

	} // END load_plugin_textdomain



	/**
	 *
	 * Register post type
	 *
	 * @access public
	 * @return void
	 * @since 0.3
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function register_post_type()
	{

		register_post_type( 'product', [
			'labels' => [
				'name' => _x( 'Products', 'post type general name', 'custom-post-type-products' ),
				'singular_name' => _x( 'Product', 'post type singular name', 'custom-post-type-products' ),
				'add_new' => _x( 'Add New', 'Product', 'custom-post-type-products' ),
				'add_new_item' => __( 'Add New Product', 'custom-post-type-products' ),
				'edit_item' => __( 'Edit Product', 'custom-post-type-products' ),
				'new_item' => __( 'New Product', 'custom-post-type-products' ),
				'view_item' => __( 'View Product', 'custom-post-type-products' ),
				'view_items' => __( 'View Products', 'custom-post-type-products' ),
				'search_items' => __( 'Search Products', 'custom-post-type-products' ),
				'not_found' => __( 'No Products found', 'custom-post-type-products' ),
				'not_found_in_trash' => __( 'No Products found in Trash', 'custom-post-type-products' ),
				'parent_item_colon' => __( 'Parent Product', 'custom-post-type-products' ),
				'all_items' => __( 'All Products', 'custom-post-type-products' ),
				'archives' => __( 'Product Archives', 'custom-post-type-products' ), 
				'attributes' => __( 'Product Attributes', 'custom-post-type-products' ),
				'insert_into_item' => __( 'Insert into product', 'custom-post-type-products' ),
				'uploaded_to_this_item' => __( 'Uploaded to this page', 'custom-post-type-products' ),
				'featured_image' => __( 'Product image', 'custom-post-type-products' ),
				'set_featured_image' => __( 'Set product image', 'custom-post-type-products' ),
				'remove_featured_image' => __( 'Remove product image', 'custom-post-type-products' ),
				'use_featured_image' => __( 'Use as product image', 'custom-post-type-products' ),
				'menu_name' => __( 'Products', 'custom-post-type-products' ),
				// 'filter_items_list' => __( 'Products', 'custom-post-type-products' ),
				// 'items_list_navigation' => __( 'Products', 'custom-post-type-products' ),
				// 'items_list' => __( 'Products', 'custom-post-type-products' ),
			],
			'public' => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui' => TRUE,
			'show_in_menu' => TRUE,
			'query_var' => TRUE,
			'rewrite' => [
				'slug' => _x( 'products', 'Post Type Slug', 'custom-post-type-products' ),
				'with_front' => FALSE,
			],
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => FALSE,
			'menu_position' => NULL,
			'menu_icon' => 'dashicons-cart',
			'supports' => [
				'title',
				'editor',
				'thumbnail',
				'page-attributes',
				'excerpt',
			],
			'show_in_rest' => TRUE,
		]);

	} // END register_post_type



	/**
	 *
	 * Register taxonomy
	 *
	 * @access public
	 * @return void
	 * @since 0.3
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function register_taxonomy()
	{

		register_taxonomy( 'product-category', ['product'], [
			'hierarchical' => TRUE,
			'labels' => [
				'name' => _x( 'Product Categories', 'taxonomy general name', 'custom-post-type-products' ),
				'singular_name' => _x( 'Product Category', 'taxonomy singular name', 'custom-post-type-products' ),
				'search_items' =>  __( 'Search Product Categories', 'custom-post-type-products' ),
				'all_items' => __( 'All Product Categories', 'custom-post-type-products' ),
				'parent_item' => __( 'Parent Product Category', 'custom-post-type-products' ),
				'parent_item_colon' => __( 'Parent Product Category:', 'custom-post-type-products' ),
				'edit_item' => __( 'Edit Product Category', 'custom-post-type-products' ),
				'update_item' => __( 'Update Product Category', 'custom-post-type-products' ),
				'add_new_item' => __( 'Add New Product Category', 'custom-post-type-products' ),
				'new_item_name' => __( 'New Product Category Name', 'custom-post-type-products' ),
				'menu_name' => __( 'Product Categories', 'custom-post-type-products' ),
			],
			'show_ui' => TRUE,
			'query_var' => TRUE,
			'rewrite' => [
				'slug' => _x( 'product-category', 'Product Category Slug', 'custom-post-type-products' ),
			],
			'show_admin_column' => TRUE,
			'show_in_rest' => TRUE,
		]);

	} // END register_taxonomy



	/**
	 * Register widgets
	 *
	 * @access public
	 * @return void
	 * @since 0.5.0
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function widgets_init()
	{

		register_widget( 'Custom_Post_Type_Products_Widget' );

	} // END widgets_init



} // END final class Custom_Post_Type_Products

new Custom_Post_Type_Products;
