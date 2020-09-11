<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveProduct extends Controller {
    // ID of the archive page
    protected $archive_page_id;

    /*
     * Initialize method to obtain ACF data
     */
    public function __before() {
        // get the archive product page ID
        $this->archive_page_id = get_field('products__archive_page', 'option');

        // get ACF data
        $this->data();
    }

    /*
     * Obtain ACF data for products page
     */
    public function data() {
        $acf_data = [
            'title' => $this->get_title(),
            'hero' => $this->get_hero(),
            'grid' => $this->get_grid(),
        ];

        return $acf_data;
    }

    /*
     * Main title helper function
     */
    private function get_title() {
        $page_title = get_field('products__page_title', $this->archive_page_id);

        if (!$page_title) {
            return;
        }

        return $page_title;
    }

    /*
     * Hero helper function
     */
    private function get_hero() {
        $_hero = [
            'classes' => 'hero hero--archive-product',
            'fields' => [
                'hero__mobile_img' => get_field('products__hero_mobile_img', $this->archive_page_id),
                'hero__desktop_img' => get_field('products__hero_desktop_img', $this->archive_page_id),
            ],
            'extras' => [
                'variant' => '',
                'supplemental-data' => '',
            ],
        ];

        return $_hero;
    }

    /*
     * Grid helper function
     */
    private function get_grid() {
        $_grid = [
            'classes' => 'grid grid--archive-product',
            'fields' => [
                'grid__title' => get_field('products__grid_title', $this->archive_page_id),
                'grid__posts' => $this->get_grid_data(),
            ],
        ];

        return $_grid;
    }

    /*
     * Grid data helper function
     */
    private function get_grid_data() {
        $data = [];

        if (have_posts()) {
            while (have_posts()) {
                the_post();

                $data[] = [
                    'link' => get_permalink(),
                    'image_id' => get_post_thumbnail_id(),
                    'title' => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                ];
            }
        }

        return $data;
    }
}
