<x-layouts.app>
    <x-slot:title>Role</x-slot>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
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
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr class="text-muted fw-semibold">
                        <th scope="col" class="ps-0">Permission</th>
                        <th scope="col">View</th>
                        <th scope="col">Create</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="border-top">
                        @foreach ($modules as $module)
                            <tr>
                                <th>{{ $module['name'] }}</th>
                                @foreach ($module['permission'] as $permission)
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary" type="checkbox" id="primary2-check" name="permission[]" value="{{ $permission['name'] }}" {{ $permission['checked'] ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                @endforeach
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

    @push('script')
        <script>
            $(function(){
                $('.form-permission').on('submit', function(){
                    const t = $(this)
                    t.find('button').prop('disabled', true)
                    t.find('.btn-save').html('<div class="spinner-border spinner-border-sm" role="status"></div> Save')
                })
            })
        </script>
    @endpush
</x-layouts.app>