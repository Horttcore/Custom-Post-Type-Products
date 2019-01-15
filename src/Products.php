<?php
namespace Horttcore\CustomPostTypeProducts;

use Horttcore\CustomPostType\PostType;

/**
 *
 *  Custom Post Type Produts
 *
 */
class Products extends PostType
{

    
    protected $slug = 'product';


    /**
     *
     * Register post type
     *
     * @access public
     * @return array Post type configuration
     * @since 1.0
     * @author Ralf Hortt <me@horttcore.de>
     */
    public function getConfig(): array
    {

        return [
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => [
                'slug' => _x('products', 'Post Type Slug', 'custom-post-type-products'),
                'with_front' => false,
            ],
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'menu_icon' => 'dashicons-cart',
            'supports' => [
                'title',
                'editor',
                'thumbnail',
                'page-attributes',
                'excerpt',
            ],
            'show_in_rest' => true,
        ];

    } // END config


    /**
     * Labels
     *
     * @return array
     **/
    public function getLabels(): array
    {
        return [
            'name' => _x('Products', 'post type general name', 'custom-post-type-products'),
            'singular_name' => _x('Product', 'post type singular name', 'custom-post-type-products'),
            'add_new' => _x('Add New', 'Product', 'custom-post-type-products'),
            'add_new_item' => __('Add New Product', 'custom-post-type-products'),
            'edit_item' => __('Edit Product', 'custom-post-type-products'),
            'new_item' => __('New Product', 'custom-post-type-products'),
            'view_item' => __('View Product', 'custom-post-type-products'),
            'view_items' => __('View Products', 'custom-post-type-products'),
            'search_items' => __('Search Products', 'custom-post-type-products'),
            'not_found' => __('No Products found', 'custom-post-type-products'),
            'not_found_in_trash' => __('No Products found in Trash', 'custom-post-type-products'),
            'parent_item_colon' => __('Parent Product', 'custom-post-type-products'),
            'all_items' => __('All Products', 'custom-post-type-products'),
            'archives' => __('Product Archives', 'custom-post-type-products'),
            'attributes' => __('Product Attributes', 'custom-post-type-products'),
            'insert_into_item' => __('Insert into product', 'custom-post-type-products'),
            'uploaded_to_this_item' => __('Uploaded to this page', 'custom-post-type-products'),
            'featured_image' => __('Product image', 'custom-post-type-products'),
            'set_featured_image' => __('Set product image', 'custom-post-type-products'),
            'remove_featured_image' => __('Remove product image', 'custom-post-type-products'),
            'use_featured_image' => __('Use as product image', 'custom-post-type-products'),
            'menu_name' => __('Products', 'custom-post-type-products'),
            // 'filter_items_list' => __( 'Products', 'custom-post-type-products' ),
            // 'items_list_navigation' => __( 'Products', 'custom-post-type-products' ),
            // 'items_list' => __( 'Products', 'custom-post-type-products' ),
        ];
    }


    /**
     * Update messages
     *
     * @param WP_Post $post Post object
     * @param string $postType Post type slug
     * @param WP_Post_Type $postType Post type slug
     * @return array Update messages
     **/
    function getUpdateMessages(\WP_Post $post, string $postType, \WP_Post_Type $postTypeObjects) : array
    {

        $messages = [
            0 => '', // Unused. Messages start at index 1.
            1 => __('Product updated.', 'custom-post-type-products'),
            2 => __('Custom field updated.'),
            3 => __('Custom field deleted.'),
            4 => __('Product updated.', 'custom-post-type-products'),
            5 => isset($_GET['revision']) ? sprintf(__('Product restored to revision from %s', 'custom-post-type-products'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
            6 => __('Product published.', 'custom-post-type-products'),
            7 => __('Product saved.', 'custom-post-type-products'),
            8 => __('Product submitted.', 'custom-post-type-products'),
            9 => sprintf(__('Product scheduled for: <strong>%1$s</strong>.', 'custom-post-type-products'), date_i18n(__('M j, Y @ G:i', 'custom-post-type-products'), strtotime($post->post_date))),
            10 => __('Product draft updated.', 'custom-post-type-products')
        ];

        if (!$post_type_object->publicly_queryable)
            return $messages;

        $permalink = get_permalink($post->ID);
        $view_link = sprintf(' <a href="%s">%s</a>', esc_url($permalink), __('View product', 'custom-post-type-products'));
        $messages[1] .= $view_link;
        $messages[6] .= $view_link;
        $messages[9] .= $view_link;

        $preview_permalink = add_query_arg('preview', 'true', $permalink);
        $preview_link = sprintf(' <a target="_blank" href="%s">%s</a>', esc_url($preview_permalink), __('Preview product', 'custom-post-type-products'));
        $messages[8] .= $preview_link;
        $messages[10] .= $preview_link;

        return $messages;
    }


} // END class Products
