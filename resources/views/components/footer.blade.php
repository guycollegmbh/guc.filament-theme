{{--
    GUYCOLLE Theme – Footer Component
    Usage: <x-guycolle-theme::footer />
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

<style>
    .gc-theme-footer {
        border-top: 1px solid rgb(var(--gray-200));
        padding: 12px 24px;
        font-family: 'Source Sans 3', 'Source Sans Pro', sans-serif;
        font-size: 12px;
        color: #6B6566;
        background: transparent;
    }
    .dark .gc-theme-footer {
        border-top-color: rgb(var(--gray-700));
        color: #8E8A8A;
    }
    .gc-theme-footer-inner {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: center;
    }
    .gc-theme-footer-sep {
        opacity: 0.5;
    }
</style>
