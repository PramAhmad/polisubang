@props([
    'id' => null,
    'label' => null,
    'name' => null
])

@if ($label)
    <label for="{{ $id }}" class="form-label fw-semibold">{{ $label }}</label>
@endif

<select {{ $attributes->merge(['class' => 'form-select', 'name' => $name, 'id' => $id]) }}>
    {{ $slot }}
</select>

@error('{{ $name }}')
    <small class="text-danger">{{ $message }}</small>
@enderror