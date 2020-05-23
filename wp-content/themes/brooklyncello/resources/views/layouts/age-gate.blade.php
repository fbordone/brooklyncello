{{--
  Age Gate
--}}

<section class="age-gate" style="background-image: url({{ home_url() . $age_gate_data['img'] }}">
  @unless ( !is_array($age_gate_data) || empty($age_gate_data) )
    @include('components.overlay-block', ['data' => $age_gate_data])
  @endunless
</section>
