<?php
namespace Horttcore\CustomPostTypeProducts;

use Horttcore\CustomTaxonomy\Taxonomy;

/**
 *
 *  Custom Post Type Produts
 *
 */
class ProductCategories extends Taxonomy
{


    /**
     * Taxonomy slug
     * 
     * @var string $slug Taxonomy slug
     */
    protected $slug = 'product-category';


    /**
     * Attach taxonomy to this post types
     * 
     * @var array<string> postType Array of post types
     */
    protected $postTypes = ['product'];


    /**
     *
     * Register post type
     *
     * @access public
     * @return array Post type configuration
     * @since 1.0
     * @author Ralf Hortt <me@horttcore.de>
     */
    public function getConfig() : array
    {
        return [
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => [
                'slug' => _x('product-category', 'Product Category Slug', 'custom-post-type-products'),
            ],
            'show_admin_column' => true,
            'show_in_rest' => true,
        ];
    }


    /**
     *
     * Get taxonomy labels
     *
     * @access public
     * @return array Taxonomy labels
     * @since 1.0
     * @author Ralf Hortt <me@horttcore.de>
     */
    public function getLabels() : array
    {

        return [
            'name' => _x('Product Categories', 'taxonomy general name', 'custom-post-type-products'),
            'singular_name' => _x('Product Category', 'taxonomy singular name', 'custom-post-type-products'),
            'search_items' => __('Search Product Categories', 'custom-post-type-products'),
            'all_items' => __('All Product Categories', 'custom-post-type-products'),
            'parent_item' => __('Parent Product Category', 'custom-post-type-products'),
            'parent_item_colon' => __('Parent Product Category:', 'custom-post-type-products'),
            'edit_item' => __('Edit Product Category', 'custom-post-type-products'),
            'update_item' => __('Update Product Category', 'custom-post-type-products'),
            'add_new_item' => __('Add New Product Category', 'custom-post-type-products'),
            'new_item_name' => __('New Product Category Name', 'custom-post-type-products'),
            'menu_name' => __('Product Categories', 'custom-post-type-products'),
        ];

    }

} // END class Products
