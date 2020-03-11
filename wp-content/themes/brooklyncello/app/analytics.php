<?php

namespace App;

if ( is_env('production') ) {
    add_action('wp_head', function() {
        if ( have_rows('analytics_head_snippets', 'option') ):
            while ( have_rows('analytics_head_snippets', 'option') ) : the_row();
                the_sub_field('head_snippet', 'option');
            endwhile;
        endif;
    });

    add_action('wp_body_open', function() {
        if ( have_rows('analytics_body_snippets', 'option') ):
            while ( have_rows('analytics_body_snippets', 'option') ) : the_row();
                the_sub_field('body_snippet', 'option');
            endwhile;
        endif;
    });
}
