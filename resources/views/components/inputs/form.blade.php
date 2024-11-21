@props([
    'method' => 'POST',
    'action' => url()->current()
])

<form {{ $attributes->merge(['method' => $method, 'action' => $action]) }} enctype="multipart/form-data">
    @csrf
    {{ $slot }}
</form>