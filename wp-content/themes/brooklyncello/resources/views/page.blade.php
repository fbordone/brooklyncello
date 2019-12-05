@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="content">
      <div class="content__copy">{!! get_the_content() !!}</div>
    </section>
  @endwhile
@endsection
