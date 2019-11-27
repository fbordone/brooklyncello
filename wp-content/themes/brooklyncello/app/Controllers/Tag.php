<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class Tag extends Controller {
    private $tag;

    public function get_tag_name() {
        $this->tag = get_queried_object();

        return $this->tag->name;
    }

    public function get_associated_post_ids() {
        $associated_post_ids = [];

        $args = array(
            'post_type' => 'recipe',
            'tax_query' => [
                [
                    'taxonomy' => 'post_tag',
                    'field'    => 'name',
                    'terms'    => $this->tag->name,
                ],
            ],
        );

        $tag_query = new WP_Query( $args );
        $associated_posts = $tag_query->posts;

        if ($associated_posts) {
            foreach($associated_posts as $post) {
                $associated_post_ids[] = $post->ID;
            }
        }

        return $associated_post_ids;
    }
}
