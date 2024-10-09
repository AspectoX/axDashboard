import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        colors: {
            'axDark': '#312E81',
            'axDark-light': '#45428D',
            'axMedium': '#818cf8',
            'axNormal': '#A5B4FC',
            'axLight': '#E0E7FF',
        }
    }
}
