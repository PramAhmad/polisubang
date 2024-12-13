<x-layouts.app>
    <x-slot:title>Barang</x-slot>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Barang</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <x-cards.card>
        <div class="mb-2">
        <div class="row align-items-center mb-3">
    <!-- Download Excel -->
    <div class="col-md-2 col-xl-2">
        <a href="{{ route('barang.export') }}" class="btn btn-success waves-effect waves-light">
            <i class="ti ti-download me-2"></i>Download Excel
        </a>
    </div>
    
    <!-- Import Excel -->
    <div class="col-md-2 col-xl-3">
        <input type="file" id="import-file" class="form-control" accept=".xlsx, .xls">
    </div>
    
    <div class="col-md-2">
        <button id="import-btn" class="btn btn-primary mt-2">Import Excel</button>
    </div>
</div>

        </div>
        <div class="mb-3">
            
            <div class="row">
                <div class="col-md-4 col-xl-2">
                    <div class="position-relative">
                        <x-inputs.input type="text" class="search-datatable ps-5" id="input-search" placeholder="Search Barang" autocomplete="false" />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
              
                @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('create barang')))
                    <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <x-buttons.button-primary data-bs-toggle="modal" data-bs-target="#modal-barang" class="btn-add-barang"><i class="ti ti-plus"></i>Tambah Barang</x-buttons.button-primary>
                    </div>
                @endif
            </div>
           
        </div>
        <div class="table-responsive">
            {!! $dataTable->table(['class' => 'table align-middle text-nowrap barang-datatable w-100']) !!}
        </div>
    </x-cards.card>

    <x-elements.modal id="modal-barang" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-body">
        <x-inputs.form class="form-barang">
           
            <div class="form-group mb-2">
                <x-inputs.input id="nama_barang" name="nama_barang" class="" label="Nama Barang" required/>
            </div>
            <div class="form-group mb-2">
                <x-inputs.input id="jumlah" name="jumlah" class="" label="Jumlah" required/>
            </div>
            <div class="form-group mb-2">
                <x-inputs.input type="date" id="tanggal_expired" name="tanggal_expired" class="" label="Tanggal Expired" />
            </div>
            <!-- type -->
            <div class="form-group mb-2">
                <x-inputs.select id="type" name="type" class="" label="Type" required>
                    <option value="bahan">Barang</option>
                    <option value="alat">Alat</option>
                </x-inputs.select>
            </div>  
            <div class="form-group mb-2">
                <!-- kondisi select baik/rusak -->
                <x-inputs.select id="kondisi" name="kondisi" class="" label="Kondisi" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                </x-inputs.select>
            </div>
            <div class="form-group mb-2">
                <x-inputs.input id="lokasi_barang" name="lokasi_barang" class="" label="Lokasi Barang" required/>
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
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        @vite('resources/js/page/barang.js')
    <script>
        $(document).ready(function() {
            $('#import-btn').on('click', function() {
                var fileInput = $('#import-file')[0].files[0];

                if (!fileInput) {
                    alert('Please select a file.');
                    return;
                }

                var formData = new FormData();
                formData.append('file', fileInput);
                
                $.ajax({
                    url: "{{ route('barang.import') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Optionally, reload data in your DataTable or update the UI as needed
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON?.errors;
                        var errorMessage = "Error importing file.";
                        if (errors) {
                            errorMessage = Object.values(errors).map(error => error[0]).join('\n');
                        }
                        alert(errorMessage);
                    }
                });
            });
        });
    </script>

    @endpush
</x-layouts.app>