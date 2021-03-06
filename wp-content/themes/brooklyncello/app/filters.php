<?php

namespace App;

/**
 * Hook into wp_head() function
 */
add_filter('wp_head', function (){
    // remove `no-js` class ?>
    <script>
      if ( document.documentElement.classList.contains('no-js') ){
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
      }
    </script>
<?php });

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'brooklyncello') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Add ACF Theme Options Page
 */
add_action('init', function () {
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page([
            'page_title'    => __('Theme Settings', 'brooklyncello'),
            'menu_title'    => __('Theme Settings', 'brooklyncello'),
            'menu_slug'     => 'theme-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false,
            'autoload'      => true,
        ]);
    }
});

/**
 * Define ACF JSON save point
 */
add_filter('acf/settings/save_json', function ( $path ) {
    // update path
    $path = config('theme.dir') .'/resources/assets/acf-json';
    // return
    return $path;
});

/**
 * Define ACF JSON load point
 */
add_filter('acf/settings/load_json', function ( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = config('theme.dir') .'/resources/assets/acf-json';
    // return
    return $paths;
});

/**
 * Remove max-width limit for images within the srcset attribute
 */
add_filter('max_srcset_image_width', function ( $max_width ){
    return false;
});

/**
 * Modify main page queries
 */
add_action('pre_get_posts', function( $query ) {
    // only affect main query on front-facing pages
    if ( !$query->is_main_query() || is_admin() ) {
        return;
    }
    // modify cocktails archive query
    if ( is_post_type_archive('recipe') ) {
        $query->set('order', 'ASC');
        $query->set('orderby', 'menu_order');
        $query->set('posts_per_page', '-1');
        $query->set('post_status', 'publish');
    }
    // modify products archive query
    if ( is_post_type_archive('product') ) {
        $query->set('order', 'ASC');
        $query->set('orderby', 'menu_order');
        $query->set('posts_per_page', '-1');
        $query->set('post_status', 'publish');
    }
});

/**
 * Hide editor on specific pages in admin
 */
add_filter('use_block_editor_for_post_type', function ($can_edit, $post_type) {
    if (!is_admin() || empty($_GET['post'])) {
        return false;
    }

    $post_id = intval($_GET['post']);

    $excluded_templates = [
        'views/archive-recipe.blade.php',
        'views/archive-product.blade.php',
        'views/front-page.blade.php',
        'views/page-buy.blade.php',
    ];

    if (empty($post_id)) {
        return false;
    }

    if (in_array(get_page_template_slug($post_id), $excluded_templates)) {
        remove_post_type_support('page', 'editor');

        $can_edit = false;
    }

    return $can_edit;
}, 10, 2);
