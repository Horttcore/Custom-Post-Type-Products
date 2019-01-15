<?php
/**
 * Plugin Name: Custom Post Type Products
 * Plugin URI: https://horttcore.de
 * Description: A custom post type for managing products
 * Version: 1.0.0
 * Author: Ralf Hortt
 * Author URI: https://horttcore.de
 * Text Domain: custom-post-type-products
 * Domain Path: /languages/
 * License: MIT
 */
namespace Horttcore\CustomPostTypeProducts;

use Horttcore\Plugin\PluginFactory;

// ------------------------------------------------------------------------------
// Prevent direct file access
// ------------------------------------------------------------------------------
if (!defined('WPINC')):
    die;
endif;


// ------------------------------------------------------------------------------
// Autoloader
// ------------------------------------------------------------------------------
$autoloader = dirname(__FILE__) . '/vendor/autoload.php';

if (is_readable($autoloader)) :
    require_once $autoloader;
endif;


// ------------------------------------------------------------------------------
// Bootstrap
// ------------------------------------------------------------------------------
PluginFactory::create()
    ->addService(Products::class)
    ->addService(ProductCategories::class)
    ->boot();
