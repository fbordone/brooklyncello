@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- Hero section --}}
    @isset($data['hero'])
      @include('modules.hero', ['data' => $data['hero']])
    @endisset

    {{-- Content section --}}
    <section class="single-product__content">
      <div class="single-product__content-wrap">
        <figure class="single-product__img-wrap">
          {!! $data['thumbnail'] !!}
        </figure>

        <div class="single-product__desc-wrap">
          @if (!empty($description = $data['desc']))
            {!! $description !!}
          @endif
        </div>
      </div>
    </section>

    {{-- Grid section --}}
    @isset($data['grid'])
      @include('modules.grid', ['data' => $data['grid']])
    @endisset
  @endwhile
@endsection
