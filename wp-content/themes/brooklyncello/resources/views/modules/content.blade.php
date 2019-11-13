{{--
  Content module
--}}

@unless (!is_array($data) || empty($data))
  <div class="{{ $data['classes'] }}">
    @if ( !empty($data['fields']['content__img']) )
      <figure class="content-block__img-wrap">
        <img srcset="{{ wp_get_attachment_image_srcset($data['fields']['content__img']) }}">
      </figure>
    @endif

    <div class="content-block__copy-wrap">
      @if ( !empty($data['fields']['content__pretitle']) )
        <p class="content-block__pretitle">{{ $data['fields']['content__pretitle'] }}</p>
      @endif

      @if ( !empty($data['fields']['content__title']) )
        <h4 class="content-block__title">{{ $data['fields']['content__title'] }}</h4>
      @endif

      @if ( !empty($data['fields']['content__desc']) )
        <p class="content-block__desc">{!! $data['fields']['content__desc'] !!}</p>
      @endif
    </div>
  </div>
@endunless
