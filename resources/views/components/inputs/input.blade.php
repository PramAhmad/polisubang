@props([
    'id' => null,
    'label' => null,
    'name' => null
])

@if($label)
    <label for="{{ $id }}" class="form-label fw-semibold">{{ $label }}</label>
@endif

<input {{ $attributes->merge(['class' => 'form-control', 'name' => $name, 'id' => $id]) }}>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@endif