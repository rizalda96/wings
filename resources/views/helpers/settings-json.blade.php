<script type="application/json" data-settings-selector="settings-json">
  @php
    $settings = [
      'locale' => app()->getLocale(),
      'timezone' => config('app.timezone'),
      'appname' => config('app.name'),
      'is_local' => config('app.env') == 'production' ? false : true,
      'home' => route('home'),
    ];
    if(strpos(url()->current(), 'login') === false && strpos(url()->current(), 'reset-password') === false) {
      $settings['user'] = auth()->user();
    }
  @endphp
  {!! json_encode($settings) !!}
</script>
