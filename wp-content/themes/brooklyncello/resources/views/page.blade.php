@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="default-content">
      <div class="default-content__copy">{!! get_the_content() !!}</div>
    </section>
  @endwhile
@endsection
