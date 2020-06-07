{{--
  Hero module
--}}

@unless (!is_array($data) || empty($data))
  <section class="{{ $data['classes'] }}">
    <figure class="hero__img-wrap">
      <picture class="hero__img">
        <source srcset="{{ wp_get_attachment_image_srcset($data['fields']['hero__desktop_img']) }}" sizes="100vw" media="(min-width: 60em)">
        <source srcset="{{ wp_get_attachment_image_srcset($data['fields']['hero__mobile_img']) }}" sizes="100vw">
        <img src="{{ wp_get_attachment_image_src($data['fields']['hero__desktop_img'])[0] }}" alt="<?= get_post_meta($data['fields']['hero__desktop_img'], '_wp_attachment_image_alt', true) ?>">
      </picture>
    </figure>

    @if ( !empty($data['fields']['hero__copy']) )
      @include('components.overlay-block', ['data' => [
        'copy' => $data['fields']['hero__copy'],
        'cta' => $data['fields']['hero__cta']
      ]])
    @endif

    @if ( $data['extras']['variant'] === 'recipes' )
      <div class="hero__sticker-wrap">
        <span class="hero__sticker">Featured Recipe</span>
      </div>

      <div class="hero__supplemental-wrap">
        <p class="hero__supplemental-caption">{{ __('Our Featured Recipe:', 'brooklyncello') }}</p>
        <h2 class="hero__supplemental-header">{!! $data['extras']['supplemental-data']['featured_title'] !!}</h2>

        @if ( !empty($data['extras']['supplemental-data']['featured_slug']) )
          <a class="hero__supplemental-cta" href="{{ $data['extras']['supplemental-data']['featured_slug'] }}">{{ __('See Recipe', 'brooklyncello') }}</a>
        @endif
      </div>
    @endif
  </section>
@endunless
