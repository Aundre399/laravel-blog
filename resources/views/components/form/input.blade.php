@props(['name'])
<div class="mb-6">

    <x-form.label name="{{ $name }}" />

    <input class="border border-gray-200 rounded p-2 w-full"

    name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes(['value' => old($name)]) }}>

    <x-form.error name="{{ $name }}" />

</div>
