<header class="banner">
  <a class="brand" href="{{ home_url('/') }}"><img src="/app/themes/abundanthousingma/resources/assets/images/ahma-logo.svg" alt="Abundant Housing MA logo" title="{{ get_bloginfo('name', 'display') }}"></a>

  <nav class="nav-primary">
    <div class="nav-primary-extras">
      <a href="/login" title="Member Login">Member Login</a>

      <div class="header-social">
        <a href="https://twitter.com/AbundantHomesMA"><img src="/app/themes/abundanthousingma/resources/assets/images/header-social-twitter.svg" alt="Twitter profile"></a>
        <a href="https://www.facebook.com/AbundantHousingMA"><img src="/app/themes/abundanthousingma/resources/assets/images/header-social-facebook.svg" alt="Facebook Page"></a>
        <a href="https://www.linkedin.com/company/abundant-housing-ma/"><img src="/app/themes/abundanthousingma/resources/assets/images/header-social-linkedin.svg" alt="LinkedIn company profile"></a>
      </div>
    </div>

    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
    @endif
  </nav>
</header>
