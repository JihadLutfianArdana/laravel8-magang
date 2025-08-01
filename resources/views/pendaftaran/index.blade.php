@extends('layouts.main-login')

@section('container')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded" style="max-width: 450px; margin: auto;">
                    <div class="card-body py-5">
                        <div class="text-center">
                            <img class="mb-4" src="{{ asset('img/logo_prov.png') }}" alt="Logo Prov Kalsel" width="120"
                                height="100">
                            <h1 class="h5 mb-3 fw-bold text-primary">SISTEM INFORMASI MAGANG</h1>
                            <strong>
                                <p class="text-muted mb-4">Balai Pelatihan Kesehatan Provinsi Kalimantan Selatan</p>
                            </strong>
                        </div>

                        <div class="d-grid gap-3">
                            <a href="/login" class="btn btn-success">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>

                            <a href="/pendaftaran-peserta" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i> Daftar Peserta Magang
                            </a>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cekStatusModal">
                                <i class="bi bi-search"></i> Cek Status Pendaftaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cek Status Pendaftaran -->
    <div class="modal fade" id="cekStatusModal" tabindex="-1" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cekStatusModalLabel">Cek Status Pendaftaran Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cekStatusForm">
                        @csrf
                        <div class="mb-3">
                            <label for="namaLengkap" class="form-label">Masukkan Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" required>
                        </div>
                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary">Cek</button>
                            <button type="button" class="btn btn-secondary ms-2" id="resetStatus">Reset</button>
                        </div>
                    </form>
                    <div class="mt-3" id="hasilStatus" style="display: none;">
                        <strong>Status:</strong> <span id="statusPeserta" class="badge bg-info text-dark"></span>
                    </div>
                    <div class="mt-2" id="jumlahPesertaContainer" style="display: none;">
                        <strong>Jumlah Peserta Magang Saat Ini:</strong>
                        <span id="jumlahPeserta" class="badge bg-primary"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('cekStatusForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const nama = document.getElementById('namaLengkap').value;

            fetch('/cek-status-pendaftaran', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        nama_lengkap: nama
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const statusDiv = document.getElementById('hasilStatus');
                    const statusBadge = document.getElementById('statusPeserta');

                    const jumlahPesertaDiv = document.getElementById('jumlahPesertaContainer');
                    const jumlahPesertaBadge = document.getElementById('jumlahPeserta');

                    if (data.status) {
                        statusBadge.textContent = data.status;
                        statusBadge.className = data.status === 'Disetujui' ?
                            'badge bg-success' : 'badge bg-warning text-dark';
                    } else {
                        statusBadge.textContent = 'Tidak ditemukan';
                        statusBadge.className = 'badge bg-danger';
                    }

                    // Tampilkan status dan jumlah peserta
                    statusDiv.style.display = 'block';
                    jumlahPesertaBadge.textContent = data.jumlah_peserta + ' orang';
                    jumlahPesertaDiv.style.display = 'block';
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat mengecek status.');
                    console.error(error);
                });
        });

        // Event listener untuk tombol reset
        document.getElementById('resetStatus').addEventListener('click', function() {
            // Reset input
            document.getElementById('namaLengkap').value = '';

            // Sembunyikan hasil status dan jumlah peserta
            document.getElementById('hasilStatus').style.display = 'none';
            document.getElementById('jumlahPesertaContainer').style.display = 'none';
        });
    </script>
@endpush
