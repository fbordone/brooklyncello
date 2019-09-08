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
  @endwhile
@endsection
