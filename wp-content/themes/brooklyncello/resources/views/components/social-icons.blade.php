{{--
  Component for social media icons
--}}

@unless (!is_array($data) || empty($data))
  <ul class="social-icons">
    @foreach ($data as $social)
      <li class="social-icons__item">
        <a href="{{$social->url}}" class="social-icons__link" target="_blank">
          <svg class="icon icon-{{$social->icon}}">
            <use xlink:href="#icon-{{$social->icon}}" href="#icon-{{$social->icon}}">
          </svg>
        </a>
      </li>
    @endforeach
  </ul>
@endunless
