{{--
    GUYCOLLE Theme – Login Page Logo/Branding
    Usage in PanelProvider:
        ->brandLogo(fn () => view('guycolle-theme::components.login-logo'))
    Styles live in resources/css/theme.css (.gc-theme-login-*)
--}}
<div class="gc-theme-login-brand">
    <img
        src="{{ asset('vendor/guycolle-theme/logo-full.svg') }}"
        alt="GUYCOLLE"
        class="gc-theme-login-logo"
    />
</div>
