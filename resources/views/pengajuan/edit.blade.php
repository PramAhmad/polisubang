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
    
    <x-slot:title>Edit Pengajuan</x-slot>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Edit Pengajuan</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('pengajuan.index') }}">Pengajuan</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Pengajuan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <x-cards.card>
        <div class="mb-3">
            <x-inputs.form class="form-pengajuan">
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-inputs.input id="name" name="name" label="Nama" value="{{ $pengajuan->name }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-inputs.select id="matakuliah_id" name="matakuliah_id" label="Matakuliah">
                                <option value="">Pilih Matakuliah</option>
                                @foreach ($matakuliahs as $matakuliah)
                                <option value="{{ $matakuliah->id }}" {{ $pengajuan->matakuliah_id == $matakuliah->id ? 'selected' : '' }}>
                                    {{ $matakuliah->name }}
                                </option>
                                @endforeach
                            </x-inputs.select>
                        </div>
                    </div>
                </div>

                <div id="dynamicPrasat">
                    @foreach($pengajuan->prasat as $index => $prasat)
                    <div class="card p-3 shadow-md my-3">
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
                                        <x-inputs.input id="nama_prasat" name="nama_prasat[]" label="Nama Prasat" value="{{ $prasat->nama_prasat }}" />
                                    </div>
                                </div>
                            </div>

                            <div id="dynamicBarang-{{ $index }}" class="dynamic-barang">
                                @foreach($prasat->barangByPrasat as $barang)
                                <div class="row mt-2 barang-item">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <x-inputs.select id="barang_id" name="barang_id[{{ $index }}][]" label="Barang Id">
                                                <option value="">Pilih Barang</option>
                                                @foreach ($barangs as $b)
                                                <option value="{{ $b->id }}" {{ $barang->barang_id == $b->id ? 'selected' : '' }}>
                                                    {{ $b->nama_barang }}
                                                </option>
                                                @endforeach
                                            </x-inputs.select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <x-inputs.input id="qty" name="qty[{{ $index }}][]" type="number" label="Quantity" value="{{ $barang->qty }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm remove-barang">
                                            <i class="ti ti-trash fs-5"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-outline-primary add-barang mt-3" data-prasat="{{ $index }}">
                                <i class="ti ti-circle-plus fs-3"></i> Barang
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-success add-prasat mt-3">Tambah Prasat</button>
                    </div>
                </div>

                <x-buttons.button-save-with-icon class="btn-save mt-5" />
            </x-inputs.form>
        </div>
    </x-cards.card>

    @push('scripts')
    <script>
        $(document).ready(function() {
            let prasatIndex = `{{ count($pengajuan->prasat) }}`;
            let prasatLainnyaIndex = `{{ count($pengajuan->prasat) }}`;

            // Rest of your JavaScript code remains the same as in the create form
            // Just need to update the AJAX call for update

            $('.form-pengajuan').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: `{{ route('pengajuan.update', $pengajuan->id) }}`,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        saveBtn.html('<div class="spinner-border spinner-border-sm" pengajuan="status"></div>').prop('disabled', true)
                        form.find('.error-message').remove()
                    },
                    success: function(response) {
                        toastr.success(`${response.message}`, "Success");
                        window.location.href = `{{ route('pengajuan.index') }}`
                    },
                    complete: function() {
                        saveBtn.html('<i class="ti ti-device-floppy"></i> Save').prop('disabled', false)
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(i, item) {
                                    let attribute = `input[name="${i}"],select[name="${i}"],textarea[name="${i}"]`
                                    if (i.match(/\./g)) {
                                        attribute = `input[data-name="${i}"],select[data-name="${i}"],textarea[data-name="${i}"]`
                                    }
                                    form.find(attribute).closest('div').append(`<div class="w-100"><small class="error-message text-danger">${item}</small></div>`)
                                })
                            } else {
                                toastr.error(`${xhr.responseJSON.message}`, "Error");
                            }
                        } else {
                            toastr.error(`Something went wrong`, "Error");
                        }
                    }
                });
            });
        });
    </script>
    @endpush
</x-layouts.app>