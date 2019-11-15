{{--
  Age Gate
--}}

<section class="age-gate" style="background-image: url({{ home_url() . $age_gate_img }}">
  <div class="age-gate__content-wrap">
    <div class="age-gate__content">
      <h1 class="age-gate__title">{!! __('Splendory awaits you', 'brooklyncello') !!}</h1>
      <p class="age-gate__subtitle">{!! __('But only if you\'re 21+...', 'brooklyncello') !!}</p>

      <div>
        <a class="age-gate__button age-gate__button--yes" href="javascript:;">{{ __('Yes', 'brooklyncello') }}</a>
        <a class="age-gate__button age-gate__button--no" href="https://responsibility.org/">{{ __('No', 'brooklyncello') }}</a>
      </div>
    </div>
  </div>
</section>
