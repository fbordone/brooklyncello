<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveRecipe extends Controller {
    /**
     * @see `../module_loader.php`
     */
    use ModuleLoader;

    private function get_featured_post_data() {
        $data = [
            'featured_title' => get_the_title(),
            'featured_slug' => get_permalink()
        ];

        return $data;
    }

    /*
     * 'Hero' section (Featured Recipe)
     *
     * @uses `App\ModuleLoader->get_module()`
     * @see `../../resources/views/modules/hero.blade.php`
     */
    public function hero() {
        return $this->get_module([
            'module' => 'hero',
            'prefix' => 'archive_recipe_hero',
            'classes' => [
                'hero hero--archive-recipe'
            ],
            'extras' => [
                'variant' => 'archive-recipe',
                'supplemental-data' => $this->get_featured_post_data()
            ],
        ]);
    }
}
