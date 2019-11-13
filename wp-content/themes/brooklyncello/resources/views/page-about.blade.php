{{--
  Template Name: About
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- 'Hero' section --}}
    @isset($hero)
      @include('modules.hero', ['data' => $hero])
    @endisset

    <section class="about">
      <div class="about__preface">{!! get_the_content() !!}</div>
    </section>

    <div class="about__content">
      {{-- 'Content One' section --}}
      @isset($about_content_one)
        @include('modules.content', ['data' => $about_content_one])
      @endisset

      {{-- 'Content Two' section --}}
      @isset($about_content_two)
        @include('modules.content', ['data' => $about_content_two])
      @endisset

      {{-- 'Content Three' section --}}
      @isset($about_content_three)
        @include('modules.content', ['data' => $about_content_three])
      @endisset
    </div>
  @endwhile
@endsection
