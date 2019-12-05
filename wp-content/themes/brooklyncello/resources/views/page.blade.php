@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'brooklyncello') }}
    </div>
  @endwhile
@endsection
