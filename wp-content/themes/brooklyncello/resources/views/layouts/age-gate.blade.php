{{--
  Age Gate
--}}

<section class="age-gate" style="background-image: url({{ home_url() . $age_gate_data['img'] }}">
  <div class="age-gate__content-wrap">
    <div class="age-gate__content">
      <h1 class="age-gate__title">{!! $age_gate_data['title'] !!}</h1>
      <p class="age-gate__subtitle">{!! $age_gate_data['subtitle'] !!}</p>

      <div>
        <a class="age-gate__button age-gate__button--yes" href="javascript:;">{!! $age_gate_data['yes-btn'] !!}</a>
        <a class="age-gate__button age-gate__button--no" href="https://responsibility.org/">{!! $age_gate_data['no-btn'] !!}</a>
      </div>
    </div>
  </div>
</section>
