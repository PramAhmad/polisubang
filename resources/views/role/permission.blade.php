<x-layouts.app>
    <x-slot:title>Role</x-slot>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Role</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Role</li>
                            <li class="breadcrumb-item" aria-current="page">Permission</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <x-cards.card>
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
            <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">{{ $role->name }}</h5>
                <p class="card-subtitle mb-0">Set Permission</p>
            </div>
        </div>
        <div class="table-responsive">
            <x-inputs.form class="form-permission" action="{{ route('role.permission.update', $role->id) }}">
                @method('PUT')
                <table class="table align-middle text-nowrap mb-0 w-100">
                    <thead>
                        <tr class="text-muted fw-semibold">
                        <th scope="col" class="ps-0">Access Menu</th>
                        <th scope="col">Permission</th>
                        </tr>
                    </thead>
                    <tbody class="border-top">
                        @foreach ($modules as $module)
                            <tr>
                                <th>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input danger menu-checked" type="checkbox" id="menu-{{ $module['id'] }}" name="menu[]" value="{{ $module['id'] }}" {{ $module['checked'] ? 'checked' : '' }}>
                                        <label class="form-check-label" for="menu-{{ $module['id'] }}">{{ $module['name'] }}</label>
                                    </div>
                                </th>
                                <td>
                                    <div class="row w-100">
                                        @foreach ($module['permission'] as $permission)
                                            <div class="col-md-2 col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary permission-checked" type="checkbox" id="{{ $permission['id'] }}" name="permission[]" {{ !$module['checked'] ? 'disabled' : ($permission['checked'] ? 'checked' : '') }} value="{{ $permission['permission_name'] }}">
                                                    <label class="form-check-label" for="{{ $permission['id'] }}">{{ ucwords($permission['name']) }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end mt-5">
                    <x-buttons.button-cancel type="button" onclick="location.href='{{ route('role.index') }}'"/>
                    <x-buttons.button-save-with-icon class="btn-save" />
                </div>
            </x-inputs.form>
        </div>
    </x-cards.card>
    @push('css')
        <style>.table{font-size: .83rem}.table > :not(caption) > * > * { padding: 10px 10px;}</style>
    @endpush

    @push('script')
        <script>
            $(function(){
                $('.form-permission').on('submit', function(){
                    const t = $(this)
                    t.find('button').prop('disabled', true)
                    t.find('.btn-save').html('<div class="spinner-border spinner-border-sm" role="status"></div> Save')
                })

                $('.menu-checked').on('change', function(){
                    const t = $(this)
                    
                    if (t.prop('checked')){
                        t.closest('tr').find('.form-check-input.permission-checked').prop('disabled', false)
                    } else {
                        t.closest('tr').find('.form-check-input.permission-checked').prop('disabled', true).prop('checked', false)
                    }
                })
            })
        </script>
    @endpush
</x-layouts.app>