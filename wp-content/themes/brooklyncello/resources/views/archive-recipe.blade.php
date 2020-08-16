{{--
  Template Name: Recipes
--}}

@extends('layouts.app')

@section('content')
  @if (have_posts())
    {{-- Page header --}}
    @isset($data['title'])
      <h2 class="archive__header">{{ $data['title'] }}</h2>
    @endisset

    {{-- Hero section (Featured Recipe) --}}
    @isset($data['hero'])
      @include('modules.hero', ['data' => $data['hero']])
    @endisset

    {{-- Recipe grid (Shows all recipes except the featured recipe) --}}
    @isset($data['recipes'])
      <section class="recipes">
        @isset($data['grid_title'])
          <h3 class="recipes__grid-header">{{ $data['grid_title'] }}</h3>
        @endisset

        <div class="recipes__grid">
          @foreach ($data['recipes'] as $recipe)
            <div class="recipe">
              <a class="recipe__wrap" href="{{ $recipe['link'] }}">
                <figure class="recipe__img-wrap">
                  <img class="recipe__img"
                    srcset="{{ wp_get_attachment_image_srcset($recipe['image'], 'medium') }}"
                    sizes="(min-width: 80em) 30em, (min-width: 60em) 50vw, 100vw"
                    alt="{{ get_post_meta($recipe['image'], '_wp_attachment_image_alt', true) }}">
                </figure>

                <h3 class="recipe__header">{!! $recipe['title'] !!}</h3>
              </a>
            </div>
          @endforeach
        </div>
      </section>
    @endisset
  @endif
@endsection
