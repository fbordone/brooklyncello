<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class PageBuy extends Controller {
    /*
     * Initialize method to obtain ACF data
     */
    public function __before() {
        // get ACF data
        $this->data();
    }

    /*
     * Obtain ACF data for buy page
     */
    public function data() {
        $acf_data = [
            'title' => $this->get_title(),
            'desc' => $this->get_desc(),
            'locator' => $this->get_locator(),
        ];

        return $acf_data;
    }

    /*
     * Title helper function
     */
    private function get_title() {
        $title = get_field('buy__title');

        if (!$title) {
            return;
        }

        return $title;
    }

    /*
     * Description helper function
     */
    private function get_desc() {
        $desc = get_field('buy__desc');

        if (!$desc) {
            return;
        }

        return $desc;
    }

    /*
     * Locator helper function
     */
    private function get_locator() {
        $locator = get_field('buy__locator');

        if (!$locator) {
            return;
        }

        return $locator;
    }
}
