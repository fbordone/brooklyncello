<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller {
    /**
     * @see `../module_loader.php`
     */
    use ModuleLoader;

    /*
     * Initialize method to obtain ACF data
     */
    public function __before() {
        // get ACF data
        $this->data();
    }

    /*
     * Obtain ACF data for recipes page
     */
    public function data() {
        $acf_data = [
            'hero' => $this->get_hero(),
            'content_one' => $this->get_content_one(),
            'banner' => $this->get_banner(),
            'grid_two' => $this->get_grid_two(),
            'grid_one' => $this->get_grid_one(),
            'content_two' => $this->get_content_two(),
            'content_three' => $this->get_content_three(),
        ];

        return $acf_data;
    }

    /*
     * Hero helper function
     */
    private function get_hero() {
        return $this->get_module([
            'module' => 'hero',
            'prefix' => 'home__hero',
            'classes' => [
                'hero hero--home'
            ],
            'extras' => [
                'variant' => '',
                'supplemental-data' => ''
            ],
        ]);
    }

    /*
     * Content helper function
     */
    private function get_content_one() {
        return $this->get_module([
            'module' => 'cta',
            'prefix' => 'home__cta_one',
            'classes' => [
                'cta cta--home'
            ],
            'extras' => [
                'variant' => '',
            ],
        ]);
    }

    /*
     * Banner helper function
     */
    private function get_banner() {
        return $this->get_module([
            'module' => 'hero',
            'prefix' => 'home__banner',
            'classes' => [
                'hero hero--banner-home'
            ],
            'extras' => [
                'variant' => '',
                'supplemental-data' => ''
            ],
        ]);
    }

    /*
     * Grid helper function
     */
    private function get_grid_two() {
        $module_data = $this->get_module([
            'module' => 'grid',
            'prefix' => 'home__grid_two',
            'classes' => [
                'grid grid--home grid--small-title'
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

    /*
     * Grid helper function
     */
    private function get_grid_one() {
        $module_data = $this->get_module([
            'module' => 'grid',
            'prefix' => 'home__grid_one',
            'classes' => [
                'grid grid--home'
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

    /*
     * Content helper function
     */
    private function get_content_two() {
        return $this->get_module([
            'module' => 'cta',
            'prefix' => 'home__cta_two',
            'classes' => [
                'cta cta--home cta--borders'
            ],
        ]);
    }

    /*
     * Content helper function
     */
    private function get_content_three() {
        return $this->get_module([
            'module' => 'cta',
            'prefix' => 'home__cta_three',
            'classes' => [
                'cta cta--home'
            ],
            'extras' => [
                'variant' => '',
            ],
        ]);
    }
}
