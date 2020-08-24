<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller {
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
            'prefix' => 'home_hero',
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
     * 'CTA' section
     *
     * @uses `App\ModuleLoader->get_module()`
     * @see `../../resources/views/modules/cta.blade.php`
     */
    public function cta() {
        return $this->get_module([
            'module' => 'cta',
            'prefix' => 'home_cta',
            'classes' => [
                'cta cta--home'
            ],
            'extras' => [
                'variant' => '',
            ],
        ]);
    }

    /*
     * 'Banner' section
     *
     * @uses `App\ModuleLoader->get_module()`
     * @see `../../resources/views/modules/hero.blade.php`
     */
    public function banner() {
        return $this->get_module([
            'module' => 'hero',
            'prefix' => 'home_banner',
            'classes' => [
                'hero banner--home'
            ],
            'extras' => [
                'variant' => '',
                'supplemental-data' => ''
            ],
        ]);
    }

    /*
     * 'Featured' section
     *
     * @uses `App\ModuleLoader->get_module()`
     * @see `../../resources/views/modules/featured.blade.php`
     */
    public function featured() {
        return $this->get_module([
            'module' => 'featured',
            'prefix' => 'home_featured',
            'classes' => [
                'featured featured--home'
            ],
        ]);
    }

    /*
     * 'CTA' section 3
     *
     * @uses `App\ModuleLoader->get_module()`
     * @see `../../resources/views/modules/cta.blade.php`
     */
    public function cta_three() {
        return $this->get_module([
            'module' => 'cta',
            'prefix' => 'home_cta_three',
            'classes' => [
                'cta cta--home-three'
            ],
            'extras' => [
                'variant' => 'horizontal-line',
            ],
        ]);
    }

        /*
     * 'CTA' section 4
     *
     * @uses `App\ModuleLoader->get_module()`
     * @see `../../resources/views/modules/cta.blade.php`
     */
    public function cta_four() {
        return $this->get_module([
            'module' => 'cta',
            'prefix' => 'home_cta_four',
            'classes' => [
                'cta cta--home-four'
            ],
            'extras' => [
                'variant' => '',
            ],
        ]);
    }
}
