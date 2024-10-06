@props([
    'user' => filament()->auth()->user(),
])

<x-filament::avatar
    {{-- :src="filament()->getUserAvatarUrl($user)" --}}
    :src="Auth::user()->profile_photo_url"
    :alt="__('filament-panels::layout.avatar.alt', ['name' => filament()->getUserName($user)])"
    :attributes="
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->class(['fi-user-avatar'])
    "
/>
