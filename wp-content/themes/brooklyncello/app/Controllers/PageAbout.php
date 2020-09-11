<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class PageAbout extends Controller {
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
            'prefix' => 'about__hero',
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
     * Content helper function
     */
    private function get_content_one() {
        $content_module = $this->get_module([
            'module' => 'content',
            'prefix' => 'about__content_one',
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
     * Content helper function
     */
    private function get_content_two() {
        $content_module = $this->get_module([
            'module' => 'content',
            'prefix' => 'about__content_two',
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
     * Content helper function
     */
    private function get_content_three() {
        $content_module = $this->get_module([
            'module' => 'content',
            'prefix' => 'about__content_three',
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
