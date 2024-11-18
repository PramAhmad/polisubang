<div class="center action-buttons">
    @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('edit peminjaman')))
        <x-buttons.button-primary title="Edit" class="btn-edit" data-id="{{ $query->id }}"><i class="ti ti-pencil"></i></x-buttons.button-primary>
    @endif
    @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('delete peminjaman')))
        <x-buttons.button-danger title="Delete" class="btn-delete"><i class="ti ti-trash"></i></x-buttons.button-danger>
        <x-inputs.form action="{{ route('peminjaman.delete', $query->id) }}" method="POST" class="form-delete">@method('DELETE')</x-inputs.form>
    @endif
</div>