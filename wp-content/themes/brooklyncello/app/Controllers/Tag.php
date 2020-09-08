<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class Tag extends Controller {
    // Tag queried object
    protected $tag;

    /*
     * Initialize method to obtain ACF data
     */
    public function __before() {
        // get the archive product page ID
        $this->tag = get_queried_object()->name;

        // get ACF data
        $this->data();
    }

    /*
     * Obtain ACF data for tags
     */
    public function data() {
        $acf_data = [
            'grid' => $this->get_grid(),
        ];

        return $acf_data;
    }

    /*
     * Grid helper function
     */
    private function get_grid() {
        $_grid = [
            'classes' => 'grid grid--tags',
            'fields' => [
                'grid__title' => $this->get_grid_title(),
                'grid__posts' => $this->get_grid_data(),
            ],
        ];

        return $_grid;
    }

    /*
     * Grid title helper function
     */
    private function get_grid_title() {
        $title = 'Results for "' . $this->tag . '" recipe tag:';

        return $title;
    }

    /*
     * Grid data helper function
     */
    private function get_grid_data() {
        $args = [
            'post_type' => 'recipe',
            'tax_query' => [
                [
                    'taxonomy' => 'post_tag',
                    'field' => 'name',
                    'terms' => $this->tag,
                ],
            ],
        ];

        $tag_query = new WP_Query($args);
        $tag_posts = $tag_query->posts;
        $data = [];

        if ($tag_posts) {
            foreach($tag_posts as $post) {
                $data[] = [
                    'link' => get_permalink($post->ID),
                    'image_id' => get_post_thumbnail_id($post->ID),
                    'title' => get_the_title($post->ID),
                    'excerpt' => get_the_excerpt($post->ID),
                ];
            }
        }

        return $data;
    }
}
