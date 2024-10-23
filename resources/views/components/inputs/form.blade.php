@props([
    'method' => 'POST',
    'action' => url()->current()
])

<form {{ $attributes->merge(['method' => $method, 'action' => $action]) }}>
    @csrf
    {{ $slot }}
</form>