@extends('layouts.app')


@section('content')

  <section class="recipes">
    <h3 class="recipes__grid-header">Results for "{{ $get_tag_name }}" recipe tag ({{ count($get_associated_post_ids) }}):</h3>

    <div class="recipes__grid">
      @if ($get_associated_post_ids)
        @for ($i = 0; $i < count($get_associated_post_ids); $i++)
          <div class="recipe">
            <a class="recipe__wrap" href="{{ get_permalink($get_associated_post_ids[$i]) }}">
              <figure class="recipe__img-wrap">
                <img class="recipe__img"
                  srcset="{{ wp_get_attachment_image_srcset( get_field('archive_recipe_thumbnail', $get_associated_post_ids[$i]), 'medium') }}"
                  sizes="(min-width: 80em) 30em, (min-width: 60em) 50vw, 100vw"
                  alt="{{ get_post_meta( get_field('archive_recipe_thumbnail', $get_associated_post_ids[$i]), '_wp_attachment_image_alt', true) }}">
              </figure>

              <h3 class="recipe__header">{{ get_the_title($get_associated_post_ids[$i]) }}</h3>
            </a>
          </div>
        @endfor
      @endif
    </div>
  </section>

@endsection
