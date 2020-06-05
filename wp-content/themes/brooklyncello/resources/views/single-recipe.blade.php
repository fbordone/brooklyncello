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
    <section class="recipe-details">
      <div class="recipe-details__wrap">
        @if (!empty($ingredients = $data['ingredients']))
          <div class="recipe-details__ingredients">
            <h3 class="recipe-details__header">{{ __('Ingredients', 'brooklyncello') }}</h3>

            <ul>
              @foreach ($ingredients as $ingredient)
                <li class="recipe-details__ingredient">{{ $ingredient }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (!empty($methods = $data['methods']))
          <div class="recipe-details__methods">
            <h3 class="recipe-details__header recipe-details__header--methods">{{ __('Method', 'brooklyncello') }}</h3>

            <ol class="recipe-details__methods-list">
              @foreach ($methods as $method)
                <li class="recipe-details__method">{{ $method }}</li>
              @endforeach
            </ol>
          </div>
        @endif
      </div>
    </section>
  @endwhile
@endsection
