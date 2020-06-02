<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveRecipe extends Controller {
    /**
     * @see `../module_loader.php`
     */
    use ModuleLoader;

    // ID of the current archive page
    protected $_id;

    /*
     * Initialize method to obtain ACF data
     */
    public function __before() {
        // get the archive recipe page ID
        $this->_id = get_field('recipes__archive-page', 'option');

        $this->data();
    }

    /*
     * Obtain ACF data for recipes page
     */
    public function data() {
        $acf_data = [
            'title' => $this->get_title(),
            'hero' => $this->get_hero(),
            'grid' => $this->get_grid_data(),
        ];

        return $acf_data;
    }

    /*
     * Title helper function
     */
    private function get_title() {
        $page_title = get_field('recipes__page_title', $this->_id);

        if (!$page_title) {
            return;
        }

        return $page_title;
    }

    /*
     * Hero helper function
     */
    private function get_hero() {
        $featured_recipe_id = get_field('recipes__featured', $this->_id);

        $hero_data = [
            'featured_title' => get_the_title($featured_recipe_id),
            'featured_slug' => get_permalink($featured_recipe_id),
        ];

        $_hero = [
            'classes' => 'hero hero--archive-recipe',
            'fields' => [
                'hero__mobile_img' => get_field('recipe__mobile_img', $featured_recipe_id),
                'hero__desktop_img' => get_field('recipe__desktop_img', $featured_recipe_id),
            ],
            'extras' => [
                'variant' => 'archive-recipe',
                'supplemental-data' => $hero_data,
            ],
        ];

        return $_hero;
    }

    /*
     * Grid data helper function
     */
    private function get_grid_data() {
        while (have_posts()) {
            the_post();

            $test[] = get_permalink();
        }

        return $test;
    }
}
