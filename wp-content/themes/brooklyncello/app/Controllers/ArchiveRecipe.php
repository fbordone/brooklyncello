<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveRecipe extends Controller {
    // ID of the archive page
    protected $archive_page_id;

    // ID of the current featured recipe
    protected $featured_recipe_id;

    /*
     * Initialize method to obtain ACF data
     */
    public function __before() {
        // get the archive recipe page ID
        $this->archive_page_id = get_field('recipes__archive_page', 'option');

        // get the featured recipe ID
        $this->featured_recipe_id = get_field('recipes__featured', $this->archive_page_id);

        // get ACF data
        $this->data();
    }

    /*
     * Obtain ACF data for recipes page
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
        $page_title = get_field('recipes__page_title', $this->archive_page_id);

        if (!$page_title) {
            return;
        }

        return $page_title;
    }

    /*
     * Hero helper function
     */
    private function get_hero() {
        $hero_data = [
            'featured_title' => get_the_title($this->featured_recipe_id),
            'featured_slug' => get_permalink($this->featured_recipe_id),
        ];

        $_hero = [
            'classes' => 'hero hero--archive-recipe',
            'fields' => [
                'hero__mobile_img' => get_field('recipe__mobile_img', $this->featured_recipe_id),
                'hero__desktop_img' => get_field('recipe__desktop_img', $this->featured_recipe_id),
            ],
            'extras' => [
                'variant' => 'recipes',
                'supplemental-data' => $hero_data,
            ],
        ];

        return $_hero;
    }

    /*
     * Grid helper function
     */
    private function get_grid() {
        $_grid = [
            'classes' => 'grid grid--archive-recipe',
            'fields' => [
                'grid__title' => get_field('recipes__grid_title', $this->archive_page_id),
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

                // exclude the featured recipe
                if ($this->featured_recipe_id !== get_the_ID()) {
                    $data[] = [
                        'link' => get_permalink(),
                        'image_id' => get_post_thumbnail_id(),
                        'title' => get_the_title(),
                        'excerpt' => get_the_excerpt(),
                    ];
                }
            }
        }

        return $data;
    }
}
