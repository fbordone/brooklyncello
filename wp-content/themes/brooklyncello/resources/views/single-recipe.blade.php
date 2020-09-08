@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- Hero section --}}
    @isset($data['hero'])
      @include('modules.hero', ['data' => $data['hero']])
    @endisset

    {{-- Description and tags sections --}}
    <section class="single-recipe__desc-wrap">
      <div class="single-recipe__desc">
        @if (!empty($description = $data['desc']))
          {!! $description !!}
        @endif

        @if (!empty($tags = $data['tags']))
          <div class="single-recipe__pill-wrap">
              @foreach ($tags as $tag_data)
                <a href="{{ $tag_data['tag_link'] }}" class="single-recipe__pill">{!! $tag_data['tag_name'] !!}</a>
              @endforeach
          </div>
        @endif
      </div>
    </section>

    {{-- Recipe details section --}}
    <section class="single-recipe__details">
      <div class="single-recipe__details-wrap">
        @if (!empty($ingredients = $data['ingredients']))
          <div class="single-recipe__details-ingredients">
            <h3 class="single-recipe__details-header">{{ __('Ingredients', 'brooklyncello') }}</h3>

            <ul>
              @foreach ($ingredients as $ingredient)
                <li class="single-recipe__details-ingredient">{{ $ingredient }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (!empty($methods = $data['methods']))
          <div class="single-recipe__details-methods">
            <h3 class="single-recipe__details-header single-recipe__details-header--methods">{{ __('Method', 'brooklyncello') }}</h3>

            <ol class="single-recipe__details-methods-list">
              @foreach ($methods as $method)
                <li class="single-recipe__details-method">{{ $method }}</li>
              @endforeach
            </ol>
          </div>
        @endif
      </div>
    </section>
  @endwhile
@endsection
