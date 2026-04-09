{{--
    GUYCOLLE Theme – Login Page Logo/Branding
    Usage in PanelProvider:
        ->brandLogo(fn () => view('guycolle-theme::components.login-logo'))
--}}
<div class="gc-theme-login-brand">
    <img
        src="{{ asset('vendor/guycolle-theme/logo-full.svg') }}"
        alt="GUYCOLLE"
        class="gc-theme-login-logo"
    />
</div>

<style>
    .gc-theme-login-brand {
        display: flex;
        justify-content: center;
        padding: 8px 0 16px;
    }
    .gc-theme-login-logo {
        height: 40px;
        width: auto;
        display: block;
    }
    .dark .gc-theme-login-logo {
        filter: invert(1) hue-rotate(180deg);
    }
</style>
