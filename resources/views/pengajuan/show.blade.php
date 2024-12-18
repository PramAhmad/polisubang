    <x-layouts.app>
        <div class="card">
            <!-- Download PDF Button at the top -->
            <div class="card-header text-right">
                <a href="{{ route('pengajuan.download', ['id' => $pengajuan->id]) }}" class="btn btn-danger">
                    <i class="fa fa-download"></i> Download PDF
                </a>
            </div>

            <!-- Invoice Card -->
            <div class="card-body">
                <div class="invoice">
                    <div class="d-md-flex justify-content-between">
                        <h3 class="text-center">Surat Pengajuan</h3>
                    </div>
                    <hr>
                    <div class="row mt-4">
    @php $prasatCounter = 1; @endphp
    @foreach ($pengajuan->prasat as $prasat)
        @if($prasat->barangByprasat->count() > 0 || $prasat->pengajuanBarangLainya->count() > 0)
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="note-title text-truncate w-75 mb-0">{{ $prasat->nama_prasat }}</h6>
                        <p class="note-date fs-2">{{ Carbon\Carbon::parse($prasat->created_at)->format('Y-m-d') }}</p>

                        <!-- Tabel Barang By Prasat -->
                        @if($prasat->barangByprasat->count() > 0)
                            <h5 class="mt-3">Barang Prasat</h5>
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Quantity (Qty)</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prasat->barangByprasat as $barangIndex => $barang)
                                        <tr>
                                            <td>{{ $prasatCounter }}.{{ $barangIndex + 1 }}</td>
                                            <td>{{ $barang->barang->nama_barang }}</td>
                                            <td>{{ $barang->qty }}</td>
                                            <td>
                                                <span>No image</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Tabel Barang Lainnya -->
                        @if($prasat->pengajuanBarangLainya->count() > 0)
                            <h5 class="mt-3">Barang Lainnya</h5>
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Quantity (Qty)</th>
                                        <th>Gambar</th>
                                        <th>Estimasi Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prasat->pengajuanBarangLainya as $barangLainnyaIndex => $barangLainnya)
                                        <tr>
                                            <td>{{ $prasatCounter }}.{{ $barangLainnyaIndex + 1 }}</td>
                                            <td>{{ $barangLainnya->nama_barang }}</td>
                                            <td>{{ $barangLainnya->jumlah }}</td>
                                            <td>
                                                @if($barangLainnya->gambar)
                                                    <img src="{{ asset('upload/gambar/' . $barangLainnya->gambar) }}" 
                                                         alt="{{ $barangLainnya->nama_barang }}" 
                                                         width="100">
                                                @else
                                                    <span>No image</span>
                                                @endif
                                            </td>
                                            <td>{{ $barangLainnya->estimasi_harga }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            @php $prasatCounter++; @endphp
        @endif
    @endforeach
</div>

                  
                </div>
            </div>

            @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasPermissionTo('approval pengajuan'))
                <div class="card-footer">
                    <form action="{{ route('pengajuan.approve', $pengajuan->id) }}" method="POST">
                        @csrf
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="approve" name="status" value="approved"
                                {{ $pengajuan->status == 'approved' ? 'checked' : '' }}>
                            <label class="form-check-label" for="approve">Accept</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="reject" name="status" value="reject"
                                {{ $pengajuan->status == 'reject' ? 'checked' : '' }}>
                            <label class="form-check-label" for="reject">Reject</label>
                        </div>

                        <div id="rejectionReason" style="display: {{ $pengajuan->status == 'reject' ? 'block' : 'none' }};" class="mt-3">
                            <label for="reason">Alasan Reject:</label>
                            <textarea name="keterangan" id="reason" class="form-control">{{ $pengajuan->keterangan }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit Approval</button>
                    </form>
                </div>
            @endif
        </div>
    </x-layouts.app>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rejectRadio = document.getElementById('reject');
            const reasonSection = document.getElementById('rejectionReason');

            rejectRadio.addEventListener('change', function () {
                reasonSection.style.display = rejectRadio.checked ? 'block' : 'none';
            });

            const approveRadio = document.getElementById('approve');
            approveRadio.addEventListener('change', function () {
                if (approveRadio.checked) {
                    reasonSection.style.display = 'none';
                }
            });
        });
    </script>
