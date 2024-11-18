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
    <x-slot:title>Pengajuan</x-slot>
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Form Pengajuan</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Pengajuan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <x-cards.card>
            <div class="mb-3">
                <x-inputs.form class="form-pengajuan">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-inputs.input id="name" name="name" label="Nama" value="{{auth()->user()->name}}"  />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-inputs.select id="matakuliah_id" name="matakuliah_id" label="Matakuliah Id" >
                                    <option value="">Pilih Matakuliah</option>
                                    @foreach ($matakuliahs as $matakuliah)
                                    <option value="{{ $matakuliah->id }}">{{ $matakuliah->name }}</option>
                                    @endforeach
                                </x-inputs.select>
                            </div>
                        </div>
                    </div>

                    <div id="dynamicPrasat">
                        <div class="card p-3 shadow-md my-3">
                            <div class="card-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Prasat ke-1</h5>
                                    <button type="button" class="btn btn-danger btn-sm remove-prasat">
                                        <i class="ti ti-x fs-5"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="prasat-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <x-inputs.input id="nama_prasat" name="nama_prasat[]" label="Nama Prasat"  />
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Barang Section Start -->
                                <div id="dynamicBarang-0" class="dynamic-barang">
                                    <div class="row mt-2 barang-item">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <x-inputs.select id="barang_id" name="barang_id[0][]" label="Barang Id" >
                                                    <option value="">Pilih Barang</option>
                                                    @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                                    @endforeach
                                                </x-inputs.select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <x-inputs.input id="qty" name="qty[0][]" type="number" label="Quantity"  />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-sm remove-barang">
                                                <i class="ti ti-trash fs-5"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-outline-primary add-barang mt-3" data-prasat="0">
                                    <i class="ti ti-circle-plus fs-3"></i> Barang
                                </button>
                                <!-- Dynamic Barang Section End -->
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success add-prasat mt-3">Tambah Prasat</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="enableBarangLainnya" />
                        <label for="enableBarangLainnya">Ada Barang Lainnya?</label>
                    </div>

                    <div class="barang-lainnya mt-3 d-none">
                        <div id="dynamicPrasatLainnya">
                            <div class="card p-3 shadow-md my-3">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>Prasat Lainnya ke-1</h5>
                                        <button type="button" class="btn btn-danger btn-sm remove-prasat-lain">
                                            <i class="ti ti-x fs-5"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="prasat-lain-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-inputs.input id="nama_prasat_lain" name="nama_prasat_lain[]" label="Nama Prasat "  />
                                            </div>
                                        </div>
                                    </div>

                                    <div id="dynamicBarangLainnya-0" class="dynamic-barang-lainnya">
                                        <div class="row mt-2 barang-lain-item">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <x-inputs.input id="nama_barang_lain" name="nama_barang_lain[0][]" label="Nama Barang Lain"  />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <x-inputs.input id="jumlah_lain" name="jumlah_lain[0][]" type="number" label="Jumlah"  />
                                                </div>
                                            </div>
                                            <!-- estimasi_harga -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <x-inputs.input id="estimasi_harga" name="estimasi_harga[0][]" type="number" label="Estimasi Harga"  />
                                                </div>
                                            </div>
                                            <!-- gambar -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <x-inputs.input id="gambar" name="gambar[0][]" type="file" label="Gambar"  />
                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger btn-sm remove-barang-lain" style="margin-top:2rem;">
                                                    <i class="ti ti-trash fs-5"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary add-barang-lainnya mt-3" data-prasat-lain="0">
                                        <i class="ti ti-circle-plus fs-3"></i> Tambah Barang Lainnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-success add-prasat-lain mt-3 mb-3">
                            Tambah Prasat Lainnya
                        </button>
                    </div>



                    <x-buttons.button-save-with-icon class="btn-save mt-5" />
                </x-inputs.form>
            </div>
        </x-cards.card>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                let prasatIndex = 1;
                let prasatLainnyaIndex = 1;

                $('#enableBarangLainnya').change(function() {
                    if ($(this).is(':checked')) {
                        $('.barang-lainnya').removeClass('d-none');
                    } else {
                        $('.barang-lainnya').addClass('d-none');
                        $('#dynamicPrasatLainnya').empty();
                        prasatLainnyaIndex = 1;
                    }
                });

                $('.add-prasat').click(function() {
                    var newPrasat = `
            <div class="card p-3 shadow-md my-3">
                <div class="card-title">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Prasat ke-${prasatIndex + 1}</h5>
                        <button type="button" class="btn btn-danger btn-sm remove-prasat">
                            <i class="ti ti-x fs-5"></i>
                        </button>
                    </div>
                </div>
                <div class="prasat-item">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <x-inputs.input id="nama_prasat" name="nama_prasat[]" label="Nama Prasat"  />
                            </div>
                        </div>
                    </div>

                    <div id="dynamicBarang-${prasatIndex}" class="dynamic-barang mt-4">
                        <div class="row mt-2 barang-item">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <x-inputs.select id="barang_id" name="barang_id[${prasatIndex}][]" label="Barang Id" >
                                        <option value="">Pilih Barang</option>
                                        @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                        @endforeach
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <x-inputs.input id="qty" name="qty[${prasatIndex}][]" type="number" label="Quantity"  />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm remove-barang">
                                    <i class="ti ti-trash fs-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary add-barang mt-3" data-prasat="${prasatIndex}">
                        <i class="ti ti-circle-plus fs-3"></i> Barang
                    </button>
                </div>
            </div>`;
                    $('#dynamicPrasat').append(newPrasat);
                    prasatIndex++;
                });

                // Function to add new Prasat Lainnya
                $('.add-prasat-lain').click(function() {
                    var newPrasatLain = `
            <div class="card p-3 shadow-md my-3">
                <div class="card-title">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Prasat Lainnya ke-${prasatLainnyaIndex + 1}</h5>
                        <button type="button" class="btn btn-danger btn-sm remove-prasat-lain">
                            <i class="ti ti-x fs-5"></i>
                        </button>
                    </div>
                </div>
                <div class="prasat-lain-item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <x-inputs.input id="nama_prasat_lain" name="nama_prasat_lain[]" label="Nama Prasat "  />
                            </div>
                        </div>
                    </div>

                    <div id="dynamicBarangLainnya-${prasatLainnyaIndex}" class="dynamic-barang-lainnya">
                        <div class="row mt-2 barang-lain-item">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-inputs.input id="nama_barang_lain" name="nama_barang_lain[${prasatLainnyaIndex}][]" label="Nama Barang Lain"  />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <x-inputs.input id="jumlah_lain" name="jumlah_lain[${prasatLainnyaIndex}][]" type="number" label="Jumlah"  />
                                </div>
                            </div>
                       
                            <div class="col-md-2">
                                <div class="form-group">
                                    <x-inputs.input id="estimasi_harga" name="estimasi_harga[${prasatLainnyaIndex}][]" type="number" label="Estimasi Harga"  />
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="form-group">
                                    <x-inputs.input id="gambar" name="gambar[${prasatLainnyaIndex}][]" type="file" label="Gambar"  />
                                </div>
                            </div>
                            <div class="col-md-1 ">
                                <div class="form-group
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm remove-barang-lain" style="margin-top:2rem">
                                    <i class="ti ti-trash fs-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary add-barang-lainnya mt-3" data-prasat-lain="${prasatLainnyaIndex}">
                        <i class="ti ti-circle-plus fs-3"></i> Tambah Barang Lainnya
                    </button>
                </div>
            </div>`;
                    $('#dynamicPrasatLainnya').append(newPrasatLain);
                    prasatLainnyaIndex++;
                });

                    $(document).on('click', '.remove-prasat', function() {
                    $(this).closest('.card').remove();
                });

                $(document).on('click', '.remove-prasat-lain', function() {
                    $(this).closest('.card').remove();
                });

                $(document).on('click', '.add-barang', function() {
                    const prasatId = $(this).data('prasat');
                    var newBarang = `
            <div class="row mt-2 barang-item">
                <div class="col-md-5">
                    <div class="form-group">
                        <x-inputs.select id="barang_id" name="barang_id[${prasatId}][]" label="Barang Id" >
                            <option value="">Pilih Barang</option>
                            @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <x-inputs.input id="qty" name="qty[${prasatId}][]" type="number" label="Quantity"  />
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-barang">
                        <i class="ti ti-trash fs-5"></i>
                    </button>
                </div>
            </div>`;
                    $(`#dynamicBarang-${prasatId}`).append(newBarang);
                });

                $(document).on('click', '.add-barang-lainnya', function() {
                    const prasatLainId = $(this).data('prasat-lain');
                    var newBarangLain = `
            <div class="row mt-2 barang-lain-item">
                <div class="col-md-4">
                    <div class="form-group">
                        <x-inputs.input id="nama_barang_lain" name="nama_barang_lain[${prasatLainId}][]" label="Nama Barang Lain"  />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <x-inputs.input id="jumlah_lain" name="jumlah_lain[${prasatLainId}][]" type="number" label="Jumlah"  />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <x-inputs.input id="estimasi_harga" name="estimasi_harga[${prasatLainId}][]" type="number" label="Estimasi Harga"  />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <x-inputs.input id="gambar" name="gambar[${prasatLainId}][]" type="file" label="Gambar"  />
                    </div>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-barang-lain" style="margin-top:2rem">
                        <i class="ti ti-trash fs-5"></i>
                    </button>
                </div>
            </div>`;
                    $(`#dynamicBarangLainnya-${prasatLainId}`).append(newBarangLain);
                });

                $(document).on('click', '.remove-barang', function() {
                    $(this).closest('.row').remove();
                });

                $(document).on('click', '.remove-barang-lain', function() {
                    $(this).closest('.row').remove();
                });
            });
        </script>

        </script>


        <script>
            const saveBtn = $('.btn-save')
            const form = $('.form-pengajuan')
            $(document).ready(function() {
                $('.form-pengajuan').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: `{{ route('pengajuan.create') }}`,
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
                                    toastr.error(`${xhr.responseJSON.message}`, "Oops");
                                }
                            } else {
                                toastr.error(``, "Oops");
                            }
                        }
                    });
                });
            });
        </script>
</x-layouts.app>