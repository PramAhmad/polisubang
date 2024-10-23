@props([
    'id' => 'modal',
    'title' => '...',
    'size' => null,
    'position' => 'modal-dialog-centered'
])

<div {{ $attributes->merge(['class' => 'modal fade', 'id' => $id]) }} aria-labelledby="{{ $id }}" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable {{ $position }} {{ $size }}">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="{{ $id }}-title">{{ $title }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>