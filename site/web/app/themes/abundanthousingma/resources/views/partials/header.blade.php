<header class="banner">
  <a class="brand" href="{{ home_url('/') }}"><img src="/app/themes/abundanthousingma/resources/assets/images/ahma-logo.svg" alt="Abundant Housing MA logo" title="{{ get_bloginfo('name', 'display') }}"></a>

  <nav class="nav-primary">
    <div class="nav-primary-extras">
      <a href="/join/" title="Become A Member">Become A Member</a>

      @include('partials.social-icons')
    </div>

    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
    @endif
  </nav>
</header>

@if (!is_front_page())
  @include('partials.page-header')
@endif
