<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class SingleProduct extends Controller {
    /**
     * @see `../module_loader.php`
     */
    use ModuleLoader;

    // ID of the current product post
    protected $product_id;

    /*
     * Initialize method to obtain ACF data
     */
    public function __before() {
        // obtain the ID of the current product post
        $this->product_id = get_the_ID();

        // get ACF data
        $this->data();
    }

    /*
     * Obtain ACF data for single product
     */
    public function data() {
        $acf_data = [
            'title' => get_the_title(),
            'hero' => $this->get_hero(),
            'thumbnail' => $this->get_thumbnail(),
            'desc' => $this->get_description(),
            'grid' => $this->get_grid(),
        ];

        return $acf_data;
    }

    /*
     * Hero helper function
     */
    private function get_hero() {
        $hero_data = [
            'featured_title' => get_the_title(),
        ];

        $_hero = [
            'classes' => 'hero hero--single-product',
            'fields' => [
                'hero__mobile_img' => get_field('product__mobile_img', $this->product_id),
                'hero__desktop_img' => get_field('product__desktop_img', $this->product_id),
            ],
            'extras' => [
                'variant' => 'recipes',
                'supplemental-data' => $hero_data,
            ],
        ];

        return $_hero;
    }

    /*
     * Thumbnail helper function
     */
    private function get_thumbnail() {
        return get_the_post_thumbnail($this->product_id);
    }

    /*
     * Description helper function
     */
    private function get_description() {
        $description = get_field('product__desc', $this->product_id);

        if (!$description) {
            return;
        }

        return $description;
    }

    /*
     * Grid helper function
     */
    private function get_grid() {
        $module_data = $this->get_module([
            'module' => 'grid',
            'prefix' => 'product__grid',
            'classes' => [
                'grid grid--product'
            ],
        ]);

        $grid_posts = $module_data['fields']['grid__posts'];
        $grid_data = [];

        if ($grid_posts) {
            foreach($grid_posts as $post_id) {
                $grid_data[] = [
                    'link' => get_permalink($post_id),
                    'image_id' => get_post_thumbnail_id($post_id),
                    'title' => get_the_title($post_id),
                    'excerpt' => get_the_excerpt($post_id),
                ];
            }

            array_splice($module_data['fields']['grid__posts'], 0);
            $module_data['fields']['grid__posts'] = $grid_data;
        }

        return $module_data;
    }
}
