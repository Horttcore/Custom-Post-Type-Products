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
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
		add_filter( 'widgets_init', array( $this, 'widgets_init' ) );

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

		register_post_type( 'product', array(
			'labels' => array(
				'name' => _x( 'Products', 'post type general name', 'custom-post-type-products' ),
				'singular_name' => _x( 'Product', 'post type singular name', 'custom-post-type-products' ),
				'add_new' => _x( 'Add New', 'Product', 'custom-post-type-products' ),
				'add_new_item' => __( 'Add New Product', 'custom-post-type-products' ),
				'edit_item' => __( 'Edit Product', 'custom-post-type-products' ),
				'new_item' => __( 'New Product', 'custom-post-type-products' ),
				'view_item' => __( 'View Product', 'custom-post-type-products' ),
				'search_items' => __( 'Search Product', 'custom-post-type-products' ),
				'not_found' =>  __( 'No Products found', 'custom-post-type-products' ),
				'not_found_in_trash' => __( 'No Products found in Trash', 'custom-post-type-products' ),
				'parent_item_colon' => '',
				'menu_name' => __( 'Products', 'custom-post-type-products' )
			),
			'public' => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui' => TRUE,
			'show_in_menu' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array(
				'slug' => _x( 'products', 'Post Type Slug', 'custom-post-type-products' ),
				'with_front' => FALSE,
			),
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => FALSE,
			'menu_position' => NULL,
			'menu_icon' => 'dashicons-cart',
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' )
		));

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

		register_taxonomy( 'product-category', array( 'product' ), array(
			'hierarchical' => TRUE,
			'labels' => array(
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
			),
			'show_ui' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array( 'slug' => _x( 'product-category', 'Product Category Slug', 'custom-post-type-products' ) ),
			'show_admin_column' => TRUE,
		));

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
