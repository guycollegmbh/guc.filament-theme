{{--
    GUYCOLLE Theme – Footer Component
    Usage: <x-guycolle-theme::footer />
    Styles live in resources/css/theme.css (.gc-theme-footer*)
--}}
<footer class="gc-theme-footer">
    <div class="gc-theme-footer-inner">
        <span class="gc-theme-footer-copy">
            &copy; {{ date('Y') }} GUYCOLLE GmbH
        </span>
        <span class="gc-theme-footer-sep">·</span>
        <span class="gc-theme-footer-app">
            {{ config('app.name') }}
        </span>
        @isset($version)
            <span class="gc-theme-footer-sep">·</span>
            <span class="gc-theme-footer-version">v{{ $version }}</span>
        @endisset
    </div>
</footer>
