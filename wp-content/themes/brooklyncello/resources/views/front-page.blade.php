{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- 'Hero' section --}}
    @isset($data['hero'])
      @include('modules.hero', ['data' => $data['hero']])
    @endisset

    {{-- 'Content' section --}}
    @isset($data['content_one'])
      @include('modules.cta', ['data' => $data['content_one']])
    @endisset

    {{-- 'Banner' section --}}
    @isset($data['banner'])
      @include('modules.hero', ['data' => $data['banner']])
    @endisset

    {{-- 'Grid' section --}}
    @isset($data['grid_two'])
      @include('modules.grid', ['data' => $data['grid_two']])
    @endisset

    {{-- 'Grid' section --}}
    @isset($data['grid_one'])
      @include('modules.grid', ['data' => $data['grid_one']])
    @endisset

    {{-- 'Content' section --}}
    @isset($data['content_two'])
      @include('modules.cta', ['data' => $data['content_two']])
    @endisset

    {{-- 'Content' section --}}
    @isset($data['content_three'])
      @include('modules.cta', ['data' => $data['content_three']])
    @endisset
  @endwhile
@endsection
