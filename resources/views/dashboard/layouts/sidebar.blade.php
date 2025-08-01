<!--**********************************
        Sidebar start
    ***********************************-->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            @can('admin')
                <li class="nav-label">Dashboard</li>
                <li>
                    <a class="has-arrow" href="/dashboard-admin" aria-expanded="false">
                        <i class="icon-home menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="nav-label">Manajemen Pengguna</li>
                <li>
                    <a class="has-arrow" href="/dashboard/pendaftaran-peserta" aria-expanded="false">
                        <i class="icon-user-follow menu-icon"></i>
                        <span class="nav-text">Pendaftaran Peserta</span>
                        @if ($unreadCount > 0)
                            <span class="badge badge-danger badge-unread-count">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/kelola-pengguna" aria-expanded="false">
                        <i class="icon-people menu-icon"></i>
                        <span class="nav-text">Kelola Pengguna</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/verifikasi-peserta" aria-expanded="false">
                        <i class="icon-people menu-icon"></i>
                        <span class="nav-text">Verifikasi Peserta</span>
                        @if ($pendingUsersCount > 0)
                            <span class="badge badge-danger badge-pending-users">{{ $pendingUsersCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-label">Data Ruangan</li>
                <li>
                    <a class="has-arrow" href="/dashboard/data-ruangan" aria-expanded="false">
                        <i class="icon-home menu-icon"></i>
                        <span class="nav-text">Data Ruangan</span>
                    </a>
                </li> --}}
                <li class="nav-label">Data Peserta Magang</li>
                {{-- <li>
                    <a class="has-arrow" href="/dashboard/grafik-penerimaan" aria-expanded="false">
                        <i class="icon-chart menu-icon"></i><span class="nav-text">Grafik Penerimaan</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/jadwal-peserta" aria-expanded="false">
                        <i class="icon-clock menu-icon"></i><span class="nav-text">Jadwal Peserta</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/kegiatan-admin" aria-expanded="false">
                        <i class="icon-list menu-icon"></i><span class="nav-text">Kegiatan Harian</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/penilaian-akhir" aria-expanded="false">
                        <i class="icon-trophy menu-icon"></i><span class="nav-text">Penilaian Akhir</span>
                    </a>
                </li> --}}
                <li>
                    <a class="has-arrow" href="/dashboard/penilaian-pembimbing" aria-expanded="false">
                        <i class="icon-star menu-icon"></i><span class="nav-text">Penilaian Pembimbing</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/laporan-peserta" aria-expanded="false">
                        <i class="icon-notebook menu-icon"></i><span class="nav-text">Laporan Peserta</span>
                    </a>
                </li>
            @endcan

            <!-- Admin Pendaftaran -->
            @can('adminPendaftaran')
                <li class="nav-label">Dashboard</li>
                <li>
                    <a class="has-arrow" href="/dashboard/admin-pendaftaran" aria-expanded="false">
                        <i class="icon-home menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-label">Manajemen Pengguna</li>
                <li>
                    <a class="has-arrow" href="/dashboard/pendaftaran-peserta/admin-pendaftaran" aria-expanded="false">
                        <i class="icon-user-follow menu-icon"></i>
                        <span class="nav-text">Pendaftaran Peserta</span>
                        @if ($unreadCount > 0)
                            <span class="badge badge-danger badge-unread-count">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/kelola-pengguna/admin-pendaftaran" aria-expanded="false">
                        <i class="icon-people menu-icon"></i>
                        <span class="nav-text">Kelola Pengguna</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/verifikasi-peserta/admin-pendaftaran" aria-expanded="false">
                        <i class="icon-people menu-icon"></i>
                        <span class="nav-text">Verifikasi Peserta</span>
                        @if ($pendingUsersCount > 0)
                            <span class="badge badge-danger badge-pending-users">{{ $pendingUsersCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-label">Data Ruangan</li>
                <li>
                    <a class="has-arrow" href="/dashboard/data-ruangan/admin-pendaftaran" aria-expanded="false">
                        <i class="icon-home menu-icon"></i>
                        <span class="nav-text">Data Ruangan</span>
                    </a>
                </li>
                <li class="nav-label">Data Peserta Magang</li>
                <li>
                    <a class="has-arrow" href="/dashboard/grafik-penerimaan/admin-pendaftaran" aria-expanded="false">
                        <i class="icon-chart menu-icon"></i><span class="nav-text">Grafik Penerimaan</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/penilaian-akhir/admin-pendaftaran" aria-expanded="false">
                        <i class="icon-trophy menu-icon"></i><span class="nav-text">Penilaian Akhir</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/penilaian-pembimbing/admin-pendaftaran" aria-expanded="false">
                        <i class="icon-star menu-icon"></i><span class="nav-text">Penilaian Pembimbing</span>
                    </a>
                </li>
            @endcan

            @can('preventAdmin')
                <li class="nav-label">Dashboard</li>
                <li>
                    <a class="has-arrow" href="/dashboard" aria-expanded="false">
                        <i class="icon-home menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-label">Data Magang</li>
                <li>
                    <a class="has-arrow" href="/dashboard/absensi" aria-expanded="false">
                        <i class="icon-check menu-icon"></i><span class="nav-text">Absensi Harian</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/detail" aria-expanded="false">
                        <i class="icon-notebook menu-icon"></i><span class="nav-text">Detail Magang</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/jadwal-magang" aria-expanded="false">
                        <i class="icon-clock menu-icon"></i><span class="nav-text">Jadwal Ruangan</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/kegiatan" aria-expanded="false">
                        <i class="icon-list menu-icon"></i><span class="nav-text">Kegiatan Harian</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/penilaian-magang-peserta" aria-expanded="false">
                        <i class="icon-trophy menu-icon"></i><span class="nav-text">Penilaian Magang</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/penilaian-pembimbing-lapangan" aria-expanded="false">
                        <i class="icon-star menu-icon"></i><span class="nav-text">Penilaian Pembimbing</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/profile" aria-expanded="false">
                        <i class="icon-user menu-icon"></i><span class="nav-text">Profile Anda</span>
                    </a>
                </li>
            @endcan

            <!-- Pembimbing Lapangan -->
            @can('pembimbingLapangan')
                <li class="nav-label">Dashboard</li>
                <li>
                    <a class="has-arrow" href="/dashboard/pembimbing-lapangan" aria-expanded="false">
                        <i class="icon-home menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-label">Manajemen Pengguna</li>
                <li>
                    <a class="has-arrow" href="/dashboard/kelola-pengguna/pembimbing-lapangan" aria-expanded="false">
                        <i class="icon-people menu-icon"></i>
                        <span class="nav-text">Kelola Pengguna</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/verifikasi-peserta/pembimbing-lapangan" aria-expanded="false">
                        <i class="icon-people menu-icon"></i>
                        <span class="nav-text">Verifikasi Peserta</span>
                    </a>
                </li>
                <li class="nav-label">Data Ruangan</li>
                <li>
                    <a class="has-arrow" href="/dashboard/data-ruangan/pembimbing-lapangan" aria-expanded="false">
                        <i class="icon-home menu-icon"></i>
                        <span class="nav-text">Data Ruangan</span>
                    </a>
                </li>
                <li class="nav-label">Data Peserta Magang</li>
                <li>
                    <a class="has-arrow" href="/dashboard/jadwal-peserta/pembimbing-lapangan" aria-expanded="false">
                        <i class="icon-clock menu-icon"></i><span class="nav-text">Jadwal Peserta</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/kegiatan-pembimbing" aria-expanded="false">
                        <i class="icon-list menu-icon"></i><span class="nav-text">Kegiatan Harian</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="/dashboard/penilaian-akhir/pembimbing-lapangan" aria-expanded="false">
                        <i class="icon-trophy menu-icon"></i><span class="nav-text">Penilaian Akhir</span>
                    </a>
                </li>
                {{-- <li>
                    <a class="has-arrow" href="/dashboard/penilaian-pembimbing/pembimbing-lapangan"
                        aria-expanded="false">
                        <i class="icon-star menu-icon"></i><span class="nav-text">Penilaian Pembimbing</span>
                    </a>
                </li> --}}
                <li>
                    <a class="has-arrow" href="/dashboard/laporan-peserta/pembimbing-lapangan" aria-expanded="false">
                        <i class="icon-notebook menu-icon"></i><span class="nav-text">Laporan Peserta</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
