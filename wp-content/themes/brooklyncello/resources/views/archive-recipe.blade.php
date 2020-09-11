{{--
  Template Name: Recipes
--}}

@extends('layouts.app')

@section('content')
  @if (have_posts())
    {{-- Page header --}}
    @isset($data['title'])
      <h2 class="archive__recipe-header">{{ $data['title'] }}</h2>
    @endisset

    {{-- Hero section (Featured Recipe) --}}
    @isset($data['hero'])
      @include('modules.hero', ['data' => $data['hero']])
    @endisset

    {{-- Recipe grid section (display all recipes except featured recipe) --}}
    @isset($data['grid'])
      @include('modules.grid', ['data' => $data['grid']])
    @endisset
  @endif
@endsection
