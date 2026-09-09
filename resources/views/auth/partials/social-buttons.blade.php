<div class="flex items-center justify-center gap-4">
    <a
        href="{{ route('social.redirect', 'facebook') }}"
        aria-label="Continue with Facebook"
        class="flex items-center justify-center w-11 h-11 rounded-full border border-line bg-surface hover:border-accent hover:-translate-y-0.5 hover:shadow-md transition-all duration-200"
    >
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#1877F2" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.91h-2.34V22c4.78-.76 8.44-4.92 8.44-9.94z"/>
        </svg>
    </a>

    <a
        href="{{ route('social.redirect', 'google') }}"
        aria-label="Continue with Google"
        class="flex items-center justify-center w-11 h-11 rounded-full border border-line bg-surface hover:border-accent hover:-translate-y-0.5 hover:shadow-md transition-all duration-200"
    >
        <svg class="w-5 h-5" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
            <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.6-6 8-11.3 8-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.8 1.1 7.9 3l5.7-5.7C34.6 6.1 29.6 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.2-.1-2.3-.4-3.5z"/>
            <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.6 15.6 18.9 13 24 13c3 0 5.8 1.1 7.9 3l5.7-5.7C34.6 6.1 29.6 4 24 4 16.3 4 9.7 8.3 6.3 14.7z"/>
            <path fill="#4CAF50" d="M24 44c5.5 0 10.4-1.9 14.2-5.1l-6.6-5.4C29.6 35.4 27 36 24 36c-5.3 0-9.7-3.4-11.3-8L6 33.1C9.4 39.6 16.2 44 24 44z"/>
            <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.2 4.2-4.1 5.6l6.6 5.4C41.4 36.3 44 30.6 44 24c0-1.2-.1-2.3-.4-3.5z"/>
        </svg>
    </a>

    <a
        href="{{ route('social.redirect', 'apple') }}"
        aria-label="Continue with Apple"
        class="flex items-center justify-center w-11 h-11 rounded-full border border-line bg-surface hover:border-accent hover:-translate-y-0.5 hover:shadow-md transition-all duration-200"
    >
        <svg class="w-5 h-5 text-ink" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.365 1.43c0 1.14-.415 2.07-1.246 2.79-.985.85-2.086 1.34-3.09 1.26-.135-1.1.415-2.24 1.185-2.94.805-.72 2.185-1.26 3.15-1.11zM20.63 17.36c-.42.97-.92 1.9-1.55 2.75-.83 1.14-1.66 2.28-2.98 2.3-1.29.02-1.71-.76-3.18-.76-1.48 0-1.94.74-3.16.78-1.27.04-2.24-1.23-3.08-2.36-1.68-2.31-2.96-6.53-1.24-9.38.85-1.42 2.38-2.32 4.04-2.34 1.24-.02 2.42.83 3.18.83.76 0 2.18-1.03 3.68-.88.63.03 2.4.25 3.53 1.9-.09.06-2.11 1.23-2.09 3.68.02 2.92 2.57 3.9 2.6 3.91-.02.07-.4 1.38-1.31 2.71z"/>
        </svg>
    </a>
</div>
