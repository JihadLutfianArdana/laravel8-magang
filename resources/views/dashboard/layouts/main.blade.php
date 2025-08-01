<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SIMAGANG | {{ $title }}</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('template/images/logo_prov3.png') }}" type="image/x-icon">
    <!-- Custom Stylesheet -->
    {{-- <link href="{{ asset('template/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('template/css/select2.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('template/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <link href="{{ asset('template/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .dataTables_filter input {
            border: 1px solid #ced4da;
            /* Border untuk input */
            border-radius: 4px;
            /* Radius sudut */
            padding: 0.2rem 0.5rem;
            /* Kurangi padding untuk ukuran lebih kecil */
            box-shadow: none;
            /* Menghilangkan shadow */
            width: 200px;
            /* Tentukan lebar input sesuai kebutuhan */
            max-width: 100%;
            /* Batasi lebar maksimum agar responsif */
            height: 20px;
            /* Sesuaikan tinggi input jika diperlukan */
        }

        .dataTables_filter input.form-control {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .badge-pending-users {
            font-size: 12px;
            margin-left: 28px;
            padding: 2px 6px;
            border-radius: 50%;
            background-color: #dc3545;
            color: #fff;
        }

        .badge-unread-count {
            font-size: 12px;
            margin-left: 10px;
            padding: 2px 6px;
            border-radius: 50%;
            background-color: #dc3545;
            color: #fff;
        }
    </style>



</head>

<body>

    @include('dashboard.layouts.preloader')

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('dashboard.layouts.nav-header')
        @include('dashboard.layouts.sidebar')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->

            <div class="container-fluid mt-2">
                @yield('container')
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('template/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('template/js/custom.min.js') }}"></script>
    <script src="{{ asset('template/js/settings.js') }}"></script>
    <script src="{{ asset('template/js/gleek.js') }}"></script>
    <script src="{{ asset('template/js/styleSwitcher.js') }}"></script>
    {{-- <script src="{{ asset('template/js/select2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('template/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('template/plugins/sweetalert/js/sweetalert.init.js') }}"></script> --}}

    <script src="{{ asset('template/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ asset('template/plugins/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('template/plugins/toastr/js/toastr.init.js') }}"></script>
    <script src="{{ asset('template/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('template/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('template/js/plugins-init/chartist.init.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the file input and label
            var fileInput = document.getElementById('foto');
            var fileLabel = document.querySelector('.custom-file-label');

            // Listen for file selection
            fileInput.addEventListener('change', function(event) {
                var fileName = event.target.files[0] ? event.target.files[0].name : "Pilih file...";
                fileLabel.textContent = fileName;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the file input and label
            var fileInput = document.getElementById('file_sertifikat');
            var fileLabel = document.querySelector('.custom-file-label');

            // Listen for file selection
            fileInput.addEventListener('change', function(event) {
                var fileName = event.target.files[0] ? event.target.files[0].name : "Pilih file...";
                fileLabel.textContent = fileName;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#nama_peserta').select2({
                placeholder: "Pilih Nama Peserta",
                allowClear: true
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen input file dan labelnya
            const fileInput = document.getElementById('dok_kegiatan');
            const fileLabel = document.querySelector('.custom-file-label');

            // Event listener untuk input file
            fileInput.addEventListener('change', function() {
                const fileName = fileInput.files[0] ? fileInput.files[0].name : 'Pilih file...';
                fileLabel.textContent = fileName;
            });
        });
    </script>

    <script>
        function updateFileName() {
            var fileInput = document.getElementById('dok_kegiatan');
            var fileName = fileInput.files[0] ? fileInput.files[0].name : 'Pilih file...';
            var fileLabel = document.querySelector('label[for="dok_kegiatan"]');
            fileLabel.textContent = fileName;
        }
    </script>

    <script>
        document.getElementById('nism').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const namaPeserta = selectedOption.getAttribute('data-nama');
            document.getElementById('nama_peserta').value = namaPeserta || '';
        });
    </script>

    <script>
        document.getElementById('delete-photo-button').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah tombol langsung submit form

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "File akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-photo-form')
                        .submit(); // Submit form jika user mengonfirmasi
                }
            });
        });
    </script>

    <script>
        // Event listener untuk mengaktifkan SweetAlert pada tombol hapus
        document.querySelectorAll('.delete-form button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Menghentikan form agar tidak submit langsung

                const form = this.closest('form');

                // Menggunakan SweetAlert2 untuk konfirmasi penghapusan
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi, kirim form untuk menghapus
                        form.submit();
                    }
                });
            });
        });
    </script>

    <script>
        function toggleAdditionalInputs(select) {
            const additionalInputs = document.getElementById('additionalInputs');
            additionalInputs.style.display = select.value === 'Sakit' || select.value === 'Izin' ? 'block' : 'none';
        }
    </script>

    <script>
        $('#gambarModal').on('show.bs.modal', function(event) {
            var link = $(event.relatedTarget); // Tombol yang diklik
            var gambarUrl = link.data('bukti'); // Ambil URL gambar dari data-bukti

            var modal = $(this);
            modal.find('#gambarBukti').attr('src', gambarUrl); // Set gambar ke modal
        });
    </script>

    <script>
        document.getElementById('formAbsensiModal').addEventListener('submit', function(event) {
            var status = document.getElementById('status').value;
            var alasan = document.getElementById('alasan').value;
            var bukti = document.getElementById('bukti').files.length;

            if ((status === 'Sakit' || status === 'Izin') && (!alasan || (status === 'Sakit' && bukti === 0))) {
                event.preventDefault(); // Mencegah form submit

                // Menampilkan error menggunakan SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Form Tidak Valid',
                    text: 'Alasan dan Bukti harus diisi jika status Sakit atau Izin.',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirimkan formulir penghapusan setelah konfirmasi
                    document.getElementById('delete-Form-' + id).submit();
                }
            });
        }
    </script>

    @yield('scripts')

</body>

</html>
