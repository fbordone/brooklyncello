{{--
  Main Header Navigation
--}}

<header class="banner">
  <div class="banner__wrap">
    <a class="banner__link banner__link--mobile" href="{{ home_url('/') }}">
      <svg class="icon logo-brooklyncello">
        <use xlink:href="#logo-brooklyncello" href="#logo-brooklyncello">
      </svg>
    </a>

    <button class="banner__menu-btn">
      <svg class="icon icon-menu">
        <use xlink:href="#icon-menu" href="#icon-menu">
      </svg>
    </button>

    {{-- Mobile Nav --}}
    <nav class="banner__nav-header-mobile">
      @if (has_nav_menu('nav_header'))
        {!! wp_nav_menu([
          'theme_location' => 'nav_header',
          'menu_class' => 'nav-header--mobile',
          'container' => '',
        ]) !!}
      @endif
    </nav>

    {{-- Desktop Nav --}}
    <nav class="banner__nav-header-desktop">
      <a class="banner__link banner__link--desktop" href="{{ home_url('/') }}">
        <svg class="icon logo-brooklyncello">
          <use xlink:href="#logo-brooklyncello" href="#logo-brooklyncello">
        </svg>
      </a>

      @if (has_nav_menu('nav_header'))
        {!! wp_nav_menu([
          'theme_location' => 'nav_header',
          'menu_class' => 'nav-header--desktop',
          'container' => '',
        ]) !!}
      @endif
    </nav>
  </div>
</header>
