{{--
  Template Name: Products
--}}

@extends('layouts.app')

@section('content')
  @if (have_posts())
    {{-- Page header --}}
    @isset($data['title'])
      <h2 class="archive__product-header">{{ $data['title'] }}</h2>
    @endisset

    {{-- Hero section --}}
    @isset($data['hero'])
      @include('modules.hero', ['data' => $data['hero']])
    @endisset

    {{-- Product grid section (displays all products) --}}
    @isset($data['grid'])
      @include('modules.grid', ['data' => $data['grid']])
    @endisset
  @endif
@endsection
