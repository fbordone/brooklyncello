{{--
  CTA module
--}}

@unless (!is_array($data) || empty($data))
  @if ( !empty($data['fields']['cta__editor']) )
    <section class="{{ $data['classes'] }}">
      {!! $data['fields']['cta__editor'] !!}

      @if ( !empty($data['fields']['cta__button']) )
        <a class="cta__btn" href="{{ $data['fields']['cta__button']['url'] }}" target="{{ $data['fields']['cta__button']['target'] }}">
          {{ $data['fields']['cta__button']['title'] }}
        </a>
      @endif

      @if ( $data['extras']['variant'] === 'horizontal-line' )
        <hr class="cta__hr">
      @endif
    </section>
  @endif
@endunless
