<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class SingleRecipe extends Controller {
    /**
     * @see `../module_loader.php`
     */
    use ModuleLoader;

    // ID of the current recipe post
    protected $recipe_id;

    /*
     * Initialize method to obtain ACF data
     */
    public function __before() {
        // obtain the ID of the current recipe post
        $this->recipe_id = get_the_ID();

        // get ACF data
        $this->data();
    }

    /*
     * Obtain ACF data for single recipe
     */
    public function data() {
        $acf_data = [
            'title' => get_the_title(),
            'hero' => $this->get_hero(),
            'desc' => $this->get_description(),
            'tags' => $this->get_tag_data(),
            'ingredients' => $this->get_ingredients(),
            'methods' => $this->get_methods(),
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
            'classes' => 'hero hero--single-recipe',
            'fields' => [
                'hero__mobile_img' => get_field('recipe__mobile_img', $this->recipe_id),
                'hero__desktop_img' => get_field('recipe__desktop_img', $this->recipe_id),
            ],
            'extras' => [
                'variant' => 'recipes',
                'supplemental-data' => $hero_data,
            ],
        ];

        return $_hero;
    }

    /*
     * Description helper function
     */
    private function get_description() {
        $description = get_field('recipe__desc', $this->recipe_id);

        if (!$description) {
            return;
        }

        return $description;
    }

    /*
     * Tags (pills) helper function
     */
    private function get_tag_data() {
        $tags = get_the_tags(get_the_ID());
        $tag_data = [];

        if ($tags) {
            foreach ($tags as $tag) {
                $data = [
                    'tag_name' => $tag->name,
                    'tag_link' => get_tag_link($tag),
                ];

                $tag_data[] = $data;
            }
        }

        return $tag_data;
    }

    /*
     * Ingredients helper function
     */
    private function get_ingredients() {
        $ingredients = get_field('recipe__ingredients', $this->recipe_id);

        if (!$ingredients) {
            return;
        }

        return array_column($ingredients, 'ingredient');
    }

    /*
     * Methods helper function
     */
    private function get_methods() {
        $methods = get_field('recipe__methods', $this->recipe_id);

        if (!$methods) {
            return;
        }

        return array_column($methods, 'method');
    }
}
