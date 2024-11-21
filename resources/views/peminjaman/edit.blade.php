<x-layouts.app>
    @push('css')
    <style>
        .responsive-margin {
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .responsive-margin {
                margin-top: 1rem;
            }
        }

        @media (max-width: 576px) {
            .responsive-margin {
                margin-top: 0.5rem;
            }
        }

        .add-barang:hover {
            color: white;
        }
    </style>
    @endpush
    
    <x-slot:title>Edit peminjaman</x-slot>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Edit peminjaman</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('peminjaman.index') }}">peminjaman</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit peminjaman</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <x-cards.card>
        <div class="mb-3">
            <x-inputs.form class="form-peminjaman" id="editpeminjamanForm">
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-inputs.input id="name" name="name" label="Nama" value="{{ $peminjaman->name }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-inputs.select id="matakuliah_id" name="matakuliah_id" label="Matakuliah">
                                <option value="">Pilih Matakuliah</option>
                                @foreach ($matakuliahs as $matakuliah)
                                <option value="{{ $matakuliah->id }}" 
                                    {{ $peminjaman->matakuliah_id == $matakuliah->id ? 'selected' : '' }}>
                                    {{ $matakuliah->name }}
                                </option>
                                @endforeach
                            </x-inputs.select>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Prasat Section -->
                <div id="dynamicPrasat">
                    @foreach($peminjaman->prasat as $index => $prasat)
                    <div class="card p-3 shadow-md my-3 prasat-card">
                        <div class="card-title">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Prasat ke-{{ $index + 1 }}</h5>
                                <button type="button" class="btn btn-danger btn-sm remove-prasat">
                                    <i class="ti ti-x fs-5"></i>
                                </button>
                            </div>
                        </div>

                        <div class="prasat-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-inputs.input 
                                            id="nama_prasat" 
                                            name="nama_prasat[]" 
                                            label="Nama Prasat" 
                                            value="{{ $prasat->nama_prasat }}" 
                                        />
                                    </div>
                                </div>
                            </div>

                            <div id="dynamicBarang-{{ $index }}" class="dynamic-barang">
                                @foreach($prasat->barangByPrasat as $barangIndex => $barang)
                                <div class="row mt-2 barang-item">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <x-inputs.select 
                                                id="barang_id" 
                                                name="barang_id[{{ $index }}][]" 
                                                label="Barang"
                                            >
                                                <option value="">Pilih Barang</option>
                                                @foreach ($barangs as $b)
                                                <option 
                                                    value="{{ $b->id }}" 
                                                    {{ $barang->barang_id == $b->id ? 'selected' : '' }}
                                                >
                                                    {{ $b->nama_barang }}
                                                </option>
                                                @endforeach
                                            </x-inputs.select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <x-inputs.input 
                                                id="qty" 
                                                name="qty[{{ $index }}][]" 
                                                type="number" 
                                                label="Quantity" 
                                                value="{{ $barang->qty }}" 
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm remove-barang mt-4">
                                            <i class="ti ti-trash fs-5"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button 
                                type="button" 
                                class="btn btn-outline-primary add-barang mt-3" 
                                data-prasat="{{ $index }}"
                            >
                                <i class="ti ti-circle-plus fs-3"></i> Tambah Barang
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-success add-prasat mt-3">
                            <i class="ti ti-circle-plus fs-3 me-2"></i>Tambah Prasat
                        </button>
                    </div>
                </div>

                <x-buttons.button-save-with-icon class="btn-save mt-5" />
            </x-inputs.form>
        </div>
    </x-cards.card>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let prasatIndex = `{{ count($peminjaman->prasat) }}`;
            console.log(prasatIndex);

            // Function to add new Prasat
            $('.add-prasat').click(function() {
                var newPrasat = `
                <div class="card p-3 shadow-md my-3 prasat-card">
                    <div class="card-title">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Prasat ke-${prasatIndex + 1}</h5>
                            <button type="button" class="btn btn-danger btn-sm remove-prasat">
                                <i class="ti ti-x fs-5"></i>
                            </button>
                        </div>
                    </div>
                    <div class="prasat-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <x-inputs.input 
                                        id="nama_prasat" 
                                        name="nama_prasat[]" 
                                        label="Nama Prasat" 
                                    />
                                </div>
                            </div>
                        </div>

                        <div id="dynamicBarang-${prasatIndex}" class="dynamic-barang">
                            <div class="row mt-2 barang-item">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <x-inputs.select 
                                            id="barang_id" 
                                            name="barang_id[${prasatIndex}][]" 
                                            label="Barang"
                                        >
                                            <option value="">Pilih Barang</option>
                                            @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">
                                                {{ $barang->nama_barang }}
                                            </option>
                                            @endforeach
                                        </x-inputs.select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <x-inputs.input 
                                            id="qty" 
                                            name="qty[${prasatIndex}][]" 
                                            type="number" 
                                            label="Quantity" 
                                        />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-barang mt-4">
                                        <i class="ti ti-trash fs-5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button 
                            type="button" 
                            class="btn btn-outline-primary add-barang mt-3" 
                            data-prasat="${prasatIndex}"
                        >
                            <i class="ti ti-circle-plus fs-3"></i> Tambah Barang
                        </button>
                    </div>
                </div>`;
                
                $('#dynamicPrasat').append(newPrasat);
                prasatIndex++;
            });

            // Add Barang within Prasat
            $(document).on('click', '.add-barang', function() {
                const prasatId = $(this).data('prasat');
                var newBarang = `
                <div class="row mt-2 barang-item">
                    <div class="col-md-5">
                        <div class="form-group">
                            <x-inputs.select 
                                id="barang_id" 
                                name="barang_id[${prasatId}][]" 
                                label="Barang"
                            >
                                <option value="">Pilih Barang</option>
                                @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">
                                    {{ $barang->nama_barang }}
                                </option>
                                @endforeach
                            </x-inputs.select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <x-inputs.input 
                                id="qty" 
                                name="qty[${prasatId}][]" 
                                type="number" 
                                label="Quantity" 
                            />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-barang mt-4">
                            <i class="ti ti-trash fs-5"></i>
                        </button>
                    </div>
                </div>`;
                
                $(`#dynamicBarang-${prasatId}`).append(newBarang);
            });

            // Remove Prasat
            $(document).on('click', '.remove-prasat', function() {
                $(this).closest('.prasat-card').remove();
            });

            // Remove Barang
            $(document).on('click', '.remove-barang', function() {
                $(this).closest('.barang-item').remove();
            });

            // Form Submit Handler
            $('#editpeminjamanForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                
                $.ajax({
                    type: 'POST',
                    url: `{{ route('peminjaman.update', $peminjaman->id) }}`,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.btn-save').html('<div class="spinner-border spinner-border-sm" role="status"></div>').prop('disabled', true);
                        $('#editpeminjamanForm').find('.error-message').remove();
                    },
                    success: function(response) {
                        toastr.success(`${response.message}`, "Success");
                        window.location.href = `{{ route('peminjaman.index') }}`;
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(field, messages) {
                                    let selector = `[name="${field}"]`;
                                    $(selector).closest('.form-group').append(`<small class="error-message text-danger">${messages[0]}</small>`);
                                });
                            } else {
                                toastr.error(`${xhr.responseJSON.message}`, "Error");
                            }
                        } else {
                            toastr.error(`Terjadi kesalahan`, "Error");
                        }

                        $('.btn-save').html('<i class="ti ti-device-floppy"></i> Simpan').prop('disabled', false);
                    }
                });
            });
        });
    </script>
</x-layouts.app>