<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class PageAbout extends Controller {
    /**
     * @see `../module_loader.php`
     */
    use ModuleLoader;

    /*
     * 'Hero' section
     *
     * @uses `App\ModuleLoader->get_module()`
     * @see `../../resources/views/modules/hero.blade.php`
     */
    public function hero() {
        return $this->get_module([
            'module' => 'hero',
            'prefix' => 'about_hero',
            'classes' => [
                'hero hero--about'
            ],
            'extras' => [
                'variant' => '',
                'supplemental-data' => ''
            ],
        ]);
    }

    /*
     * 'Content One' section
     *
     * @uses `App\ModuleLoader->get_module()`
     * @uses `../../resources/views/modules/content.blade.php`
     */
    public function about_content_one() {
        $content_module = $this->get_module([
            'module' => 'content',
            'prefix' => 'about_content_one',
            'classes' => [
                'content-block content-block--about'
            ],
        ]);

        if ( $content_module['fields']['content__flip'] ) {
            $content_module['classes'] .= ' content-block--reversed';
        }

        return $content_module;
    }

    /*
     * 'Content Two' section
     *
     * @uses `App\ModuleLoader->get_module()`
     * @uses `../../resources/views/modules/content.blade.php`
     */
    public function about_content_two() {
        $content_module = $this->get_module([
            'module' => 'content',
            'prefix' => 'about_content_two',
            'classes' => [
                'content-block content-block--about'
            ],
        ]);

        if ( $content_module['fields']['content__flip'] ) {
            $content_module['classes'] .= ' content-block--reversed';
        }

        return $content_module;
    }

    /*
     * 'Content Three' section
     *
     * @uses `App\ModuleLoader->get_module()`
     * @uses `../../resources/views/modules/content.blade.php`
     */
    public function about_content_three() {
        $content_module = $this->get_module([
            'module' => 'content',
            'prefix' => 'about_content_three',
            'classes' => [
                'content-block content-block--about'
            ],
        ]);

        if ( $content_module['fields']['content__flip'] ) {
            $content_module['classes'] .= ' content-block--reversed';
        }

        return $content_module;
    }
}
