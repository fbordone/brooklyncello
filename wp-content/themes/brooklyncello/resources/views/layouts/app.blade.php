<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('layouts.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('layouts.header')
    <div class="wrap" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('layouts.footer')

    {{-- Age gate --}}
    @include('layouts.age-gate')

    @php wp_footer() @endphp
    {{-- include spritemap --}}
    @if( $sprite_path )
      <div class="spritemap" aria-hidden="true">
        @php(include_once($sprite_path))
      </div>
    @endif
  </body>
</html>
