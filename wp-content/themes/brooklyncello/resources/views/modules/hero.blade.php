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

    <div class="hero__content-wrap">
      <h1 class="hero__title">{!! $data['fields']['hero__title'] !!}</h1>
    </div>
  </section>
@endunless
