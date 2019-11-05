@extends('layouts.app')

@php
  $count = 0;
@endphp

@section('content')
  @if( have_posts() )
    {{-- Page Header --}}
    <h1 class="archive__header">{{ __('Brooklyncello Cocktail Recipes', 'brooklyncello') }}</h1>

    {{-- 'Hero' Section (Featured Recipe) --}}
    @isset($hero)
      @include('modules.hero', ['data' => $hero])
    @endisset

    <section class="recipes">
      <h3 class="recipes__grid-header">Cocktail Recipes</h3>

      <div class="recipes__grid">
        @while ( have_posts() )
          @php the_post() @endphp
          @php $count++; @endphp

          @if( $count > 1 )
            <div class="recipe">
              <a class="recipe__wrap" href="{{ get_permalink() }}">
                <figure class="recipe__img-wrap">
                  <img class="recipe__img"
                    srcset="{{ wp_get_attachment_image_srcset( get_field('archive_recipe_thumbnail'), 'medium') }}"
                    sizes="(min-width: 80em) 30em, (min-width: 60em) 50vw, 100vw"
                    alt="{{ get_post_meta( get_field('archive_recipe_thumbnail'), '_wp_attachment_image_alt', true) }}">
                </figure>

                <h3 class="recipe__header">{{ get_the_title() }}</h3>
              </a>
            </div>
          @endif
        @endwhile
      </div>
    </section>
  @endif
@endsection