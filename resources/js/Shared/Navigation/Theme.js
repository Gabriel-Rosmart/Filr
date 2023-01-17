export const lightTheme = "cmyk"
export const darkTheme = "night"

export function getMediaPreference() {
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 
            darkTheme : lightTheme
}

export function getTheme() {
    return localStorage.getItem('theme')
}

export function setTheme(theme) {
    const html = document.querySelector('html')
    localStorage.setItem("theme", theme);

    // Set daisyUI theme preference
    html.setAttribute('data-theme', theme)

    // Toggle Tailwind dark mode
    if(theme === darkTheme) html.classList.add('dark')
    if(theme === lightTheme) html.classList.remove('dark')
}