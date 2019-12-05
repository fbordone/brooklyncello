{{--
  Featured module
--}}

@unless (!is_array($data) || empty($data))
  @if ( !empty($data['fields']['featured__recipes']) )
    <section class="{{ $data['classes'] }}">
      @if ( !empty($data['fields']['featured__title']) )
        <h3 class="featured__title">{{ $data['fields']['featured__title'] }}</h3>
      @endif

      <div class="recipes__grid">
        @php
          $related_recipe_ids = $data['fields']['featured__recipes'];
        @endphp

        @for ($i = 0; $i < count($related_recipe_ids); $i++)
          <div class="recipe featured__recipe">
            <a class="recipe__wrap" href="{{ get_permalink($related_recipe_ids[$i]) }}">
              <figure class="recipe__img-wrap">
                <img class="recipe__img"
                  srcset="{{ wp_get_attachment_image_srcset( get_field('archive_recipe_thumbnail', $related_recipe_ids[$i]), 'medium') }}"
                  sizes="(min-width: 80em) 30em, (min-width: 60em) 50vw, 100vw"
                  alt="{{ get_post_meta( get_field('archive_recipe_thumbnail', $related_recipe_ids[$i]), '_wp_attachment_image_alt', true) }}">
              </figure>

              <h3 class="recipe__header">{{ get_the_title($related_recipe_ids[$i]) }}</h3>
            </a>
          </div>
        @endfor
      </div>
    </section>
  @endif
@endunless
