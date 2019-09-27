<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveRecipe extends Controller {
    /*
     * 'Featured Image' section
     *
     * @see `../../resources/views/archive-recipe.blade.php`
     */
    public function featured_image() {
        global $wp_query;

        if ( have_posts() ) {
            $first_post_id = $wp_query->posts[0]->ID;

            $data = [
                'fields' => [
                    'archive__mobile_featured_img' => get_field('archive__mobile_feat_img', $first_post_id),
                    'archive__desktop_featured_img' => get_field('archive__desktop_feat_img', $first_post_id),
                    'archive__featured_recipe_title' => get_the_title($first_post_id),
                    'archive__featured_recipe_url' => get_permalink($first_post_id),
                ],
            ];

            return $data;
        }

        return;
    }
}
