{{--
  Template Name: Buy
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="blurb">
      <div class="about__preface">{!! get_the_content() !!}</div>
    </section>

    <section class="buy">
      @php
        $venues = [];
        $location = [];

        foreach (get_field('column_a_items') as $item) {
          $venues[] = $item['venue'];
        }

        foreach (get_field('column_b_items') as $item) {
          $locations[] = $item['location'];
        }

        $items = array_combine($venues, $locations);
      @endphp

      <table class="buy__table">
        <tr>
          <th class="buy__table-title">{{ get_field('column_a_title') }}</th>
          <th class="buy__table-title">{{ get_field('column_b_title') }}</th>
        </tr>

        @foreach ($items as $venue => $location)
          <tr>
            <td class="buy__table-data">{{ $venue }}</td>
            <td class="buy__table-data">{{ $location }}</td>
          </tr>
        @endforeach
      </table>
    </section>
  @endwhile
@endsection
