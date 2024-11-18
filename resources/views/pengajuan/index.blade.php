<x-layouts.app>
    <x-slot:title>pengajuan</x-slot>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">pengajuan</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">pengajuan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <x-cards.card>
        <div class="mb-3">
            <div class="row">
                <div class="col-md-4 col-xl-2">
                    <div class="position-relative">
                        <x-inputs.input type="text" class="search-datatable ps-5" id="input-search" placeholder="Search pengajuan" autocomplete="false" />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                
                <!-- @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('create pengajuan')))
                    <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <x-buttons.button-primary data-bs-toggle="modal" data-bs-target="#modal-pengajuan" class="btn-add-pengajuan"><i class="ti ti-plus"></i>Add pengajuan</x-buttons.button-primary>
                    </div>
                @endif -->
                
            </div>
        </div>
        <div class="table-responsive">
            {!! $dataTable->table(['class' => 'table align-middle text-nowrap pengajuan-datatable w-100','id'=>'pengajuan']) !!}
        </div>
    </x-cards.card>

    <x-elements.modal id="modal-pengajuan" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-body">
            <x-inputs.form class="form-pengajuan">
                <div class="form-group mb-2">
                    <x-inputs.input id="user_id" name="user_id" class="" label="User Id" required/>
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="matakuliah_id" name="matakuliah_id" class="" label="Matakuliah Id" required/>
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="name" name="name" class="" label="Name" required/>
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="status" name="status" class="" label="Status" required/>
                </div>
            </x-inputs.form>
        </div>
        <div class="modal-footer">
            <x-buttons.button-danger class="font-medium waves-effect" data-bs-dismiss="modal">Close</x-buttons.button-danger>
            <x-buttons.button-save-with-icon class="btn-save"/>
        </div>
    </x-elements.modal>

    @push('css')
        <link rel="stylesheet" href="{{ asset('templates/mdrnz/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('templates/mdrnz/css/custom-datatables.css') }}">
        <style>.dataTables_length,.dataTables_filter{display: none}.dataTable{font-size: .83rem}.table > :not(caption) > * > * { padding: 10px 10px;}</style>
    @endpush
    @push('script')
        <script type="module" src="{{ asset('templates/mdrnz/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        {{ $dataTable->scripts(attributes: ['type' => 'module','id' => 'pengajuan']) }}
        @vite('resources/js/page/pengajuan.js')
    @endpush
</x-layouts.app>