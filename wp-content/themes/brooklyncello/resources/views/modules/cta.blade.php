{{--
  CTA module
--}}

@unless (!is_array($data) || empty($data))
  @if ( !empty($data['fields']['cta__tagline']) )
    <section class="{{ $data['classes'] }}">
      <p class="cta__tagline {{ !empty($data['fields']['cta__button']) ? 'cta__tagline--margin' : '' }}">{!! $data['fields']['cta__tagline'] !!}</p>

      @if ( !empty($data['fields']['cta__button']) )
        <a class="cta__btn" href="{{ $data['fields']['cta__button']['url'] }}" target="{{ $data['fields']['cta__button']['target'] }}">
          {{ $data['fields']['cta__button']['title'] }}
        </a>
      @endif
    </section>
  @endif
@endunless
