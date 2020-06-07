<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller {
    /**
     * Find path to spritemap if it exists
     *
     * @uses config()
     * @see  `../../../app/helpers.php`
     */
    public function sprite_path() {
        $_theme_path = \App\config('theme.dir');
        $_spritemap = glob("{$_theme_path}/dist/spritemap*.svg");

        if ( !empty($_spritemap) && file_exists($_spritemap[0]) )
            return $_spritemap[0];

        return false;
    }

    /**
     * Social media icons and associated links (defined in global theme options)
     *
     * @return array
     */
    public function social_icons() {
        $_socials = array();
        if (have_rows('social_icons', 'option')) {
            while ( have_rows('social_icons', 'option') ) {
                the_row();
                $_socials[] = (object)[
                    'url'  => get_sub_field('url'),
                    'icon' => get_sub_field('icon'),
                ];
            }
        }
        return $_socials;
    }

    /**
     * Copyright text (defined in global theme options)
     *
     * @return string
     */
    public function copyright() {
        return get_field('copyright', 'option');
    }

     /**
     * Age gate specific data (defined in global theme options)
     *
     * @return array
     */
    public function age_gate_data() {
        $data = [
            'img'  => get_field('age_gate_img', 'option'),
            'copy' => get_field('age_gate_copy', 'option'),
            'cta' => get_field('age_gate_cta', 'option'),
        ];

        return $data;
    }
}
