@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="default-content">
      <h1 class="default-content__title">{{ get_the_title() }}</h1>

      <div class="default-content__copy">
        @if (!empty($content = the_content()))
          {{ $content }}
        @endif
      </div>
    </section>
  @endwhile
@endsection
