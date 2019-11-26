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

    <section class="single-recipe__content-wrap">

    </section>
  @endwhile
@endsection
