@props([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
])

<header class="flex flex-col items-center ax-simple-header">
    @if ($logo)
        <x-filament-panels::logo class="mb-4" />
    @endif

    @if (filled($heading))
        <h1
            class="text-2xl font-bold tracking-tight text-center ax-simple-header-heading"
        >
            {!! $heading !!}
        </h1>
    @endif

    @if (filled($subheading))
        <p
            class="mt-2 text-sm text-center ax-simple-header-subheading"
        >
            {{ $subheading }}
        </p>
    @endif
</header>
