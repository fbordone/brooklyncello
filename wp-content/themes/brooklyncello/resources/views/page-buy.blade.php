{{--
  Template Name: Buy
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="buy__wrap">
      @unless (empty($title = $data['title']))
        <h1 class="buy__title">{{ $title }}</h1>
      @endunless

      @unless (empty($desc = $data['desc']))
        <div class="buy__desc">
          {!! $desc !!}
        </div>
      @endunless

      @unless (empty($locator = $data['locator']))
        <div class="buy__locator">
          {!! do_shortcode($locator) !!}
        </div>
      @endunless
    </section>
  @endwhile
@endsection
