{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- 'Hero' section --}}
    @isset($hero)
      @include('modules.hero', ['data' => $hero])
    @endisset

    {{-- 'CTA' section --}}
    @isset($cta)
      @include('modules.cta', ['data' => $cta])
    @endisset

    {{-- 'Banner' section --}}
    @isset($banner)
      @include('modules.hero', ['data' => $banner])
    @endisset

    {{-- 'CTA' section 2 --}}
    @isset($cta_two)
      @include('modules.cta', ['data' => $cta_two])
    @endisset

    {{-- 'Featured' section --}}
    @isset($featured)
      @include('modules.featured', ['data' => $featured])
    @endisset

    {{-- 'CTA' section 3 --}}
    @isset($cta_three)
      @include('modules.cta', ['data' => $cta_three])
    @endisset

    {{-- 'CTA' section 4 --}}
    @isset($cta_four)
      @include('modules.cta', ['data' => $cta_four])
    @endisset
  @endwhile
@endsection
