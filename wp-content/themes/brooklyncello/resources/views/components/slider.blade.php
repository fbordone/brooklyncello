{{--
  `Slick` slider component
--}}

@unless (!is_array($data) || empty($data))
  <section class="{{ $data['classes'] }}">
    <div class="slider__wrap">
      @foreach ($data['fields']['product'] as $slide)
        <div class="slider__img-wrap">
          <a class="slider__img-link" href="{{ $slide['link'] }}">
            <img class="slider__img"
            src="{{ $slide['image_src'] }}"
            alt="{{ $slide['title'] }}">
          </a>

          <h5 class="slider__title">
            <a href="{{ $slide['link'] }}">{{ $slide['title'] }}</a>
          </h5>
        </div>
      @endforeach
    </div>
  </section>
@endunless
