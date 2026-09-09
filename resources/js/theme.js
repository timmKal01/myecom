const STORAGE_KEY = 'theme';

function systemPrefersDark() {
    return window.matchMedia('(prefers-color-scheme: dark)').matches;
}

function apply(theme) {
    document.documentElement.classList.toggle('dark', theme === 'dark');
}

const Theme = {
    /** 'light' | 'dark' | 'system' — what the user actually chose. */
    get preference() {
        const stored = localStorage.getItem(STORAGE_KEY);
        return stored === 'light' || stored === 'dark' ? stored : 'system';
    },

    /** 'light' | 'dark' — what's actually applied right now. */
    get active() {
        const pref = this.preference;
        return pref === 'system' ? (systemPrefersDark() ? 'dark' : 'light') : pref;
    },

    set(preference) {
        if (preference === 'system') {
            localStorage.removeItem(STORAGE_KEY);
        } else {
            localStorage.setItem(STORAGE_KEY, preference);
        }
        apply(this.active);
    },

    toggle() {
        this.set(this.active === 'dark' ? 'light' : 'dark');
    },
};

window.Theme = Theme;

window
    .matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', () => {
        if (Theme.preference === 'system') {
            apply(Theme.active);
        }
    });
