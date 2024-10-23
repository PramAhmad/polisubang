@props([
    'type' => 'submit'
])

<button {{ $attributes->merge(['class' => 'btn btn-primary', 'type' => $type]) }}><i class="ti ti-device-floppy"></i> Save</button>