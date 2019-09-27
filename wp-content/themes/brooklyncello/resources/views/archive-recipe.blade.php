@extends('layouts.app')

@section('content')
  @if( have_posts() )
    <section class="archive-recipe">
      <h1 class="archive-recipe__header">{{ __('Brooklyncello Cocktail Recipes', 'brooklyncello') }}</h1>

      {{-- Featured Recipe Section --}}
      <figure class="archive-recipe__feat-img-wrap">
        <picture>
          <source srcset="{{ wp_get_attachment_image_srcset($featured_image['fields']['archive__desktop_featured_img']) }}" sizes="100vw" media="(min-width: 50em)">
          <source srcset="{{ wp_get_attachment_image_srcset($featured_image['fields']['archive__mobile_featured_img']) }}" sizes="100vw">
          <img src="{{ wp_get_attachment_image_src($featured_image['fields']['archive__mobile_featured_img'])[0] }}">
        </picture>
      </figure>

      <div class="archive-recipe__feat-sticker-wrap">
        <span class="archive-recipe__feat-sticker">Featured Recipe</span>
      </div>

      <div class="archive-recipe__feat-content-wrap">
        <p class="archive-recipe__feat-caption">{{ __('Our Featured Recipe:', 'brooklyncello') }}</p>
        <h2 class="archive-recipe__feat-header">{!! $featured_image['fields']['archive__featured_recipe_title'] !!}</h2>
        <a class="archive-recipe__feat-cta" href="{{ $featured_image['fields']['archive__featured_recipe_url'] }}">{{ __('See Recipe', 'brooklyncello') }}</a>
      </div>
      {{-- End of Featured Recipe Section --}}
    </section>
  @endif
@endsection
