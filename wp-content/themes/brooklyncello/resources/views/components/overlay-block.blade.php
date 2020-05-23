{{--
  Component that is positioned absolutely over the center of its parent container
--}}

@unless ( empty($data) )
  <div class="overlay-block">
    @unless ( empty($data['copy']) )
      {!! $data['copy'] !!}
    @endunless

    @unless ( empty($data['cta']) )
      <div class="overlay-block__cta-wrap">
        @foreach ( $data['cta'] as $cta )
          <a class="overlay-block__cta {{ $cta['button']['url'] === '#' ? 'overlay-block__cta--age-gate-yes' : '' }}" href="{{ $cta['button']['url'] }}" target="{{ $cta['button']['target'] }}">
            {{ $cta['button']['title'] }}
          </a>
        @endforeach
      </div>
    @endunless
  </div>
@endunless
