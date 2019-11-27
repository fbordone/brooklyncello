@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @isset($hero)
      @include('modules.hero', ['data' => $hero])
    @endisset

    <section class="single-recipe__desc-wrap">
      <div class="single-recipe__desc">
        {!! get_the_content() !!}

        @if ( !empty($get_tag_data) )
          <div class="single-recipe__pill-wrap">
              @foreach ($get_tag_data as $tag_data)
                <a href="{{ $tag_data['tag_link'] }}" class="single-recipe__pill">{!! $tag_data['tag_name'] !!}</a>
              @endforeach
          </div>
        @endif
      </div>
    </section>

    <section class="recipe-details">
      <div class="recipe-details__wrap">
        @if ($ingredients)
          <div class="recipe-details__ingredients">
            <h3 class="recipe-details__header">{{ __('Ingredients', 'brooklyncello') }}</h3>

            <ul>
              @foreach ($ingredients as $ingredient)
                <li class="recipe-details__ingredient">{{ $ingredient }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if ($methods)
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
