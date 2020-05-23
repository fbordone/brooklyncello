<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveProduct extends Controller {
    /*
     * 'Content' section
     * Had to pull in the archive page ID because content wasn't displaying on this page without ID (idk why)
     *
     * @see `../../resources/views/modules/slider.blade.php`
     */
    public function content() {
        $product_archive_id = get_field('product_archive_page', 'option');

        return get_field('product_archive_content', $product_archive_id);
    }

    /*
     * 'Product' slider section
     *
     * @see `../../resources/views/modules/slider.blade.php`
     */
    public function slides() {
        while ( have_posts() ) {
            the_post();

            $post_data[] = [
                'title' => get_the_title(),
                'image_src' => get_the_post_thumbnail_url(get_the_ID(), 'w320'),
                'link' => get_the_permalink()
            ];
        }

        $data = [
            'classes' => 'slider slider--archive',
            'fields' => [
                'product' => isset($post_data) ? $post_data : [],
            ],
        ];

        return $data;
    }
}
