@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- Hero section --}}
    @isset($data['hero'])
      @include('modules.hero', ['data' => $data['hero']])
    @endisset

    {{-- Bottle Image section --}}
    <section class="single-product__img">
      <figure class="single-product__img-wrap">
        {!! $data['thumbnail'] !!}
      </figure>
    </section>

    {{-- Description section --}}
    <section class="single-product__desc">
      <div class="single-product__desc-wrap">
        @if (!empty($description = $data['desc']))
          {!! $description !!}
        @endif
      </div>
    </section>
  @endwhile
@endsection
