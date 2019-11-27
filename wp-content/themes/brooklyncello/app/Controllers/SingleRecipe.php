<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class SingleRecipe extends Controller {
    /**
     * @see `../module_loader.php`
     */
    use ModuleLoader;

    /*
     * 'Hero' section (Single Recipe)
     *
     * @uses `App\ModuleLoader->get_module()`
     * @see `../../resources/views/modules/hero.blade.php`
     */
    public function hero() {
        return $this->get_module([
            'module' => 'hero',
            'prefix' => 'single_recipe_hero',
            'classes' => [
                'hero hero--single-recipe'
            ],
            'extras' => [
                'variant' => '',
                'supplemental-data' => ''
            ],
        ]);
    }

    public function get_tag_data() {
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

    public function ingredients() {
        if ( get_field('single_recipe_ingredients_list', get_the_ID() ) ) {
            $recipe_ingredients = array_column(get_field('single_recipe_ingredients_list', get_the_ID()), 'ingredient');

            return $recipe_ingredients;
        }

        return;
    }

    public function methods() {
        if ( get_field('single_recipe_methods_list', get_the_ID() ) ) {
            $recipe_methods = array_column(get_field('single_recipe_methods_list', get_the_ID()), 'method');

            return $recipe_methods;
        }

        return;
    }
}
