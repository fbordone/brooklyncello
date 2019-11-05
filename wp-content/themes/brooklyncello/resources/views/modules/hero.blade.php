{{--
  Hero module
--}}

@unless (!is_array($data) || empty($data))
  <section class="{{ $data['classes'] }}">
    <figure class="hero__img-wrap">
      <picture>
        <source srcset="{{ wp_get_attachment_image_srcset($data['fields']['hero__desktop_img']) }}" sizes="100vw" media="(min-width: 60em)">
        <source srcset="{{ wp_get_attachment_image_srcset($data['fields']['hero__mobile_img']) }}" sizes="100vw">
        <img src="{{ wp_get_attachment_image_src($data['fields']['hero__mobile_img'])[0] }}">
      </picture>
    </figure>

    @if ( !empty($data['fields']['hero__title']) )
      <div class="hero__content-wrap">
        <h1 class="hero__title {{ !empty($data['fields']['hero__title_size']) ? "hero__title--{$data['fields']['hero__title_size']}" : '' }}">
          {!! $data['fields']['hero__title'] !!}
        </h1>

        <h1 class="hero__subtitle {{ !empty($data['fields']['hero__subtitle_size']) ? "hero__subtitle--{$data['fields']['hero__subtitle_size']}" : '' }}">
          {!! $data['fields']['hero__subtitle'] !!}
        </h1>
      </div>
    @endif

    @if ( $data['extras']['variant'] === 'archive-recipe' )
      <div class="hero__sticker-wrap">
        <span class="hero__sticker">Featured Recipe</span>
      </div>

      <div class="hero__supplemental-wrap">
        <p class="hero__supplemental-caption">{{ __('Our Featured Recipe:', 'brooklyncello') }}</p>
        <h2 class="hero__supplemental-header">{!! $data['extras']['supplemental-data']['featured_title'] !!}</h2>
        <a class="hero__supplemental-cta" href="{{ $data['extras']['supplemental-data']['featured_slug'] }}">{{ __('See Recipe', 'brooklyncello') }}</a>
      </div>
    @endif
  </section>
@endunless
