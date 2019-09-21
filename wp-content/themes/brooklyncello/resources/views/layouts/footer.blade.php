<footer class="footer">
  <div class="footer__wrap">
    <nav class="footer__nav">
      @if (has_nav_menu('nav_footer'))
        {!! wp_nav_menu([
          'theme_location' => 'nav_footer',
          'menu_class' => 'nav-footer',
          'container' => '',
        ]) !!}
      @endif
    </nav>

    @include('components.social-icons', ['data' => $social_icons])

    <div class="footer__copyright">{!! $copyright !!}</div>

    <ul class="footer__legal-list">
      <li class="footer__legal-item">
        <a class="footer__legal-item-link" href="{{ home_url('/terms-and-conditions/') }}">{{ __('Terms', 'brooklyncello') }}</a>
      </li>
      <li class="footer__legal-item">
        <a class="footer__legal-item-link" href="{{ home_url('/privacy-policy/') }}">{{ __('Privacy Policy', 'brooklyncello') }}</a>
      </li>
      <li class="footer__legal-item">
        <a class="footer__legal-item-link footer__legal-item-link--last" href="https://responsibility.org/" target="_blank">{{ __('Responsibility', 'brooklyncello') }}</a>
      </li>
    </ul>
  </div>
</footer>
