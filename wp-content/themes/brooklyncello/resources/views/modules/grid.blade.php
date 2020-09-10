{{--
  Grid module
--}}

@unless (!is_array($data) || empty($data))
  <section class="{{ $data['classes'] }}">
    @unless (empty($title = $data['fields']['grid__title']))
      <h2 class="grid__header">{!! $title !!}</h2>
    @endunless

    @unless (empty($grid_posts = $data['fields']['grid__posts']))
      <div class="grid__wrap">
        @foreach ($grid_posts as $post)
          <div class="grid__card">
            <div class="grid__card-content">
              <a href="{{ $post['link'] }}">
                <figure>
                  <img class="grid__card-img"
                    src="{{ wp_get_attachment_image_src($post['image_id'])[0] }}"
                    srcset="{{ wp_get_attachment_image_srcset($post['image_id']) }}"
                    alt="{{ $post['title'] }}" />
                </figure>
              </a>

              <a href="{{ $post['link'] }}">
                <h3 class="grid__card-title">{!! $post['title'] !!}</h3>
              </a>

              @unless (empty($excerpt = $post['excerpt']))
                <p class="grid__card-excerpt">{!! $excerpt !!}</p>
              @endunless
            </div>
          </div>
        @endforeach
      </div>
    @endunless
  </section>
@endunless
