{{-- Applies the saved/system theme before first paint, so there's no
     flash of the wrong mode. Must stay a plain inline <script> in <head>
     (not Vite-bundled) since it has to run synchronously, before body
     renders. --}}
<script>
    (function () {
        try {
            var stored = localStorage.getItem('theme');
            var theme = stored === 'light' || stored === 'dark'
                ? stored
                : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') document.documentElement.classList.add('dark');
        } catch (e) {}
    })();
</script>
