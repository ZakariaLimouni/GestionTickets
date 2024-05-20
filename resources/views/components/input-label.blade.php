@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-black-900 dark:text-black-300']) }}>
    {{ $value ?? $slot }}
</label>