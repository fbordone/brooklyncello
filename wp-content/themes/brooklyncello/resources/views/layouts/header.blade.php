{{--
  Main Header Navigation
--}}

<header class="banner">
  <div class="banner__wrap">
    <a class="banner__link" href="{{ home_url('/') }}">
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
      @if (has_nav_menu('nav_header_left'))
        {!! wp_nav_menu([
          'theme_location' => 'nav_header_left',
          'menu_class' => 'nav-header--mobile',
          'container' => '',
        ]) !!}
      @endif

      @if (has_nav_menu('nav_header_right'))
        {!! wp_nav_menu([
          'theme_location' => 'nav_header_right',
          'menu_class' => 'nav-header--mobile',
          'container' => '',
        ]) !!}
      @endif
    </nav>
  </div>
</header>
