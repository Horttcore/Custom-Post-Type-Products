<?php
/**
 * Plugin Name: Custom Post Type Products
 * Plugin URI: http://horttcore.de
 * Description: A custom post type for managing products
 * Version: 0.4.0
 * Author: Ralf Hortt
 * Author URI: http://horttcore.de
 * Text Domain: custom-post-type-products
 * Domain Path: /languages/
 * License: GPL2
 */

require( 'classes/custom-post-type-products.php' );
// require( 'classes/custom-post-type-products.widget.php' );
// require( 'inc/template-tags.php' );

if ( is_admin() )
	require( 'classes/custom-post-type-products.admin.php' );
