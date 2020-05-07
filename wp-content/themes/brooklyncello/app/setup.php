<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    /* CSS */
    wp_enqueue_style('brooklyncello/main.css', asset_path('styles/main.css'), false, null);
    /* JS */
    wp_enqueue_script('brooklyncello/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
    // passes data into a globally available JS object (i.e. `BROOKLYNCELLO.theme_uri`)
    wp_localize_script('brooklyncello/main.js', 'BROOKLYNCELLO', [
        'home_url' => home_url(),
        'ajax_url' => admin_url('admin-ajax.php'),
        'theme_uri' => config('theme.uri'),
        'theme_assets' => config('assets.uri'),
        'theme_fonts' => asset_path('styles/fonts.css')
    ]);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'nav_header' => __('Header Navigation Menu', 'brooklyncello'),
        'nav_footer' => __('Footer Navigation Menu', 'brooklyncello'),
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Add image sizes (and reference wordpress sizes)
     * @link https://developer.wordpress.org/reference/functions/add_image_size/
     */
    add_image_size('w320', 320, 9999);
    // 'thumbnail' wordpress size (320x320 cropped)
    // 'medium' wordpress size (480w)
    add_image_size('w640', 640, 9999);
    // 'medium-large' wordpress size (768w)
    // 'large' wordpress size (960w)
    add_image_size('w1280', 1280, 9999);
    add_image_size('w1536', 1536, 9999);
    add_image_size('w1680', 1680, 9999);
    add_image_size('w1920', 1920, 9999);

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register custom post types & taxonomies
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
add_action('init', function() {
    /************ CPTs ************/
    /* Recipes */
    $args = [
        'labels' => [
            'name' => __('Recipes', 'brooklyncello'),
            'singular_name' => __('Recipe', 'brooklyncello'),
            'add_new_item' => __('Add New Recipe', 'brooklyncello'),
            'edit_item' => __('Edit Recipe', 'brooklyncello'),
            'new_item' => __('New Recipe', 'brooklyncello'),
            'view_item' => __('View Recipe', 'brooklyncello'),
            'view_items' => __('View Recipes', 'brooklyncello'),
            'search_items' => __('Search Recipes', 'brooklyncello'),
            'not_found' => __('No Recipes Found', 'brooklyncello'),
            'not_found_in_trash' => __('No Recipes Found In Trash', 'brooklyncello'),
            'all_items' => __('All Recipes', 'brooklyncello'),
            'archives' => __('Recipe Archives', 'brooklyncello'),
            'attributes' => __('Recipe Attributes', 'brooklyncello'),
            'filter_items_list' => __('Filter Recipes List', 'brooklyncello'),
            'items_list' => __('Recipes List', 'brooklyncello'),
        ],
        'public' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-smiley',
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
        'has_archive' => true,
        'rewrite' => ['slug' => 'recipes'],
        'query_var' => 'recipe',
    ];

    register_post_type('recipe', $args);

    /* Products */
    $args = [
        'labels' => [
            'name' => __('Products', 'brooklyncello'),
            'singular_name' => __('Product', 'brooklyncello'),
            'add_new_item' => __('Add New Product', 'brooklyncello'),
            'edit_item' => __('Edit Product', 'brooklyncello'),
            'new_item' => __('New Product', 'brooklyncello'),
            'view_item' => __('View Product', 'brooklyncello'),
            'view_items' => __('View Products', 'brooklyncello'),
            'search_items' => __('Search Products', 'brooklyncello'),
            'not_found' => __('No Products Found', 'brooklyncello'),
            'not_found_in_trash' => __('No Products Found In Trash', 'brooklyncello'),
            'all_items' => __('All Products', 'brooklyncello'),
            'archives' => __('Product Archives', 'brooklyncello'),
            'attributes' => __('Product Attributes', 'brooklyncello'),
            'filter_items_list' => __('Filter Products List', 'brooklyncello'),
            'items_list' => __('Products List', 'brooklyncello'),
        ],
        'public' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-carrot',
        'show_in_rest' => true,
        'supports' => ['title', 'thumbnail'],
        'has_archive' => true,
        'rewrite' => ['slug' => 'products'],
        'query_var' => 'product',
    ];

    register_post_type('product', $args);

    /************ Taxonomies ************/
    /* Add default 'tag' taxonomy to Recipe CPT */
    register_taxonomy_for_object_type('post_tag', 'recipe');
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });

     /**
     * Create @shortcode() Blade directive
     *
     * Must include quotes ('' or "") when calling this directive
     */
    sage('blade')->compiler()->directive('shortcode', function ($shortcode) {
        return "<?= do_shortcode({$shortcode}); ?>";
    });
});
