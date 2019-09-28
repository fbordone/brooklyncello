@extends('layouts.app')

@section('content')
  @if( have_posts() )
    {{-- Page Header --}}
    <h1 class="archive__header">{{ __('Brooklyncello Cocktail Recipes', 'brooklyncello') }}</h1>

    {{-- 'Hero' Section (Featured Recipe) --}}
    @isset($hero)
      @include('modules.hero', ['data' => $hero])
    @endisset
  @endif
@endsection
