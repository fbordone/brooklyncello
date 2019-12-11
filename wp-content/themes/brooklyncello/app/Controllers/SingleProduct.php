<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class SingleProduct extends Controller {
    /**
     * @see `../module_loader.php`
     */
    use ModuleLoader;

   /*
    * 'Content Three' section
    *
    * @uses `App\ModuleLoader->get_module()`
    * @uses `../../resources/views/modules/content.blade.php`
    */
    public function product_content() {
        $content_module = $this->get_module([
            'module' => 'content',
            'prefix' => 'product__content',
            'classes' => [
                'content-block content-block--product'
            ],
        ]);

        if ( $content_module['fields']['content__flip'] ) {
            $content_module['classes'] .= ' content-block--reversed';
        }

        return $content_module;
    }

    public function get_tag_data() {
        $tags = get_field('product__related-recipes', get_the_ID());
        $tag_data = [];

        if ($tags) {
            foreach ($tags as $tag) {
                $data = [
                    'tag_name' => get_the_title($tag),
                    'tag_link' => get_permalink($tag),
                ];

                $tag_data[] = $data;
            }
        }

        return $tag_data;
    }
}
