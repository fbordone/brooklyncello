{{--
  CTA module
--}}

@unless (!is_array($data) || empty($data))
  <section class="{{ $data['classes'] }}">
    @unless (empty($content = $data['fields']['cta__editor']))
      {!! $content !!}
    @endunless

    @unless (empty($button = $data['fields']['cta__button']))
      <a class="cta__btn" href="{{ $button['url'] }}" target="{{ $button['target'] }}">
        {{ $button['title'] }}
      </a>
    @endunless
  </section>
@endunless
