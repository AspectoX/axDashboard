@props([
    'actions' => [],
    'breadcrumbs' => [],
    'heading',
    'subheading' => null,
])

<header
    {{ $attributes->class(['fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between']) }}
>
    <div>
        @if ($breadcrumbs)
            <x-filament::breadcrumbs
                :breadcrumbs="$breadcrumbs"
                class="hidden mb-2 sm:block"
            />
        @endif

        <h1
            class="text-2xl font-bold tracking-tight fi-header-heading text-gray-950 dark:text-white sm:text-3xl"
        >
            {!! $heading !!}
        </h1>

        @if ($subheading)
            <p
                class="max-w-2xl mt-2 text-lg text-gray-600 fi-header-subheading dark:text-gray-400"
            >
                {{ $subheading }}
            </p>
        @endif
    </div>

    <div
        @class([
            'flex shrink-0 items-center gap-3',
            'sm:mt-7' => $breadcrumbs,
        ])
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_ACTIONS_BEFORE, scopes: $this->getRenderHookScopes()) }}

        @if ($actions)
            <x-filament::actions :actions="$actions" />
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_ACTIONS_AFTER, scopes: $this->getRenderHookScopes()) }}
    </div>
</header>
