@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="single-product__content">
      <h1 class="single-product__header">{{ get_the_title() }}</h1>

      {{-- 'Content One' section --}}
      @isset($product_content)
        @include('modules.content', ['data' => $product_content])
      @endisset

      @if ( !empty($get_tag_data) )
        <div class="single-recipe__pill-wrap">
          @foreach ($get_tag_data as $tag_data)
            <a href="{{ $tag_data['tag_link'] }}" class="single-recipe__pill">{!! $tag_data['tag_name'] !!}</a>
          @endforeach
        </div>
      @endif
    </div>
  @endwhile
@endsection
