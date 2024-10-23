<div class="center action-buttons">
    @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('edit role')))
        @if ($query->name !== 'superadmin')
            <a href="{{ route('role.permission', $query->id) }}" title="Set Permission" class="btn btn-sm btn-outline-primary" data-id="{{ $query->id }}"><i class="ti ti-lock"></i> Set Access Menu & Permission</a>
        @endif
        
        <x-buttons.button-primary title="Edit" class="btn-sm btn-edit" data-id="{{ $query->id }}"><i class="ti ti-pencil"></i></x-buttons.button-primary>
    @endif
    @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('delete role')))
        <x-buttons.button-danger title="Delete" class="btn-sm btn-delete"><i class="ti ti-trash"></i></x-buttons.button-danger>
        <x-inputs.form action="{{ route('role.delete', $query->id) }}" method="POST" class="form-delete">@method('DELETE')</x-inputs.form>
    @endif
</div>