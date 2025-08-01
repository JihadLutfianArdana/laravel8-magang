<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AbsensiPesertaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailMagangController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\JadwalMagangController;
use App\Http\Controllers\KegiatanMagangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PendaftaranPesertaController;
use App\Http\Controllers\PenilaianPesertaController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PenilaianPembimbingController;
use App\Models\User;
use App\Models\ProfilePeserta;
use App\Models\PendaftaranPeserta;
use App\Models\PenilaianPembimbing;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/beranda');
});

Route::get('/beranda', [PendaftaranPesertaController::class, 'home'])->middleware('guest');
Route::get('/tentang-kami', [PendaftaranPesertaController::class, 'about'])->middleware('guest');
Route::get('/program-magang', [PendaftaranPesertaController::class, 'program'])->middleware('guest');
Route::get('/beranda-magang', [PendaftaranPesertaController::class, 'main'])->middleware('guest');
Route::get('/pendaftaran-peserta', [PendaftaranPesertaController::class, 'daftar'])->middleware('guest');
Route::post('/pendaftaran-peserta', [PendaftaranPesertaController::class, 'store'])->middleware('guest');

Route::post('/cek-status-pendaftaran', function (Request $request) {
    $namaInput = trim(strtolower($request->nama_lengkap));

    $peserta = PendaftaranPeserta::get()->first(function ($peserta) use ($namaInput) {
        return strtolower(trim($peserta->nama_lengkap)) === $namaInput;
    });

    $jumlahPeserta = User::where('is_admin', 0)->count();

    return response()->json([
        'status' => $peserta ? $peserta->status : null,
        'jumlah_peserta' => $jumlahPeserta
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::middleware(['auth', 'preventAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::middleware(['auth', 'preventAdmin'])->group(function () {
    Route::get('/dashboard/profile', [ProfileController::class, 'index']);
    Route::get('/dashboard/profile/edit', [ProfileController::class, 'edit']);
    Route::post('/dashboard/profile', [ProfileController::class, 'update']);
    Route::delete('/dashboard/profile/delete-photo', [ProfileController::class, 'deletePhoto']);
    Route::get('/dashboard/reset-password-peserta', [PasswordController::class, 'indexPeserta']);
    Route::post('/dashboard/reset-password-peserta', [PasswordController::class, 'updatePeserta']);
});

Route::middleware(['auth', 'preventAdmin'])->group(function () {
    Route::get('/dashboard/penilaian-pembimbing-lapangan', [PenilaianPembimbingController::class, 'index']);
    Route::post('/dashboard/penilaian-pembimbing-lapangan', [PenilaianPembimbingController::class, 'store']);
});

Route::middleware(['auth', 'preventAdmin'])->group(function () {
    Route::get('/dashboard/detail', [DetailMagangController::class, 'index']);
    Route::get('/dashboard/detail/create', [DetailMagangController::class, 'edit']);
    Route::post('/dashboard/detail', [DetailMagangController::class, 'update']);
});

Route::get('/api/profile-peserta/{nism}', function ($nism) {
    return ProfilePeserta::where('nism', $nism)->first();
});

Route::middleware(['auth', 'preventAdmin'])->group(function () {
    Route::get('/dashboard/kegiatan', [KegiatanMagangController::class, 'index']);
    Route::get('/dashboard/kegiatan/create', [KegiatanMagangController::class, 'create']);
    Route::post('/dashboard/kegiatan', [KegiatanMagangController::class, 'store']);
    Route::get('/dashboard/kegiatan/{id}/edit', [KegiatanMagangController::class, 'edit']);
    Route::put('/dashboard/kegiatan/{id}', [KegiatanMagangController::class, 'update']);
    Route::delete('/dashboard/kegiatan/{id}', [KegiatanMagangController::class, 'destroy']);
    Route::get('/dashboard/kegiatan/print', [KegiatanMagangController::class, 'print']);
    Route::delete('/dashboard/kegiatan/{id}/delete-foto', [KegiatanMagangController::class, 'deleteFoto']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/grafik-penerimaan', [GrafikController::class, 'index']);
    Route::get('/dashboard/grafik-penerimaan/print', [GrafikController::class, 'print']);
    Route::get('/dashboard/grafik-penerimaan-tahunan/print', [GrafikController::class, 'printTahunan']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/penilaian-pembimbing', [PenilaianPembimbingController::class, 'indexAdmin']);
    Route::get('/dashboard/penilaian-pembimbing/lihat-penilaian/{id}', [PenilaianPembimbingController::class, 'showAdmin']);
    Route::get('/dashboard/penilaian-pembimbing/{id}/cetak', [PenilaianPembimbingController::class, 'cetak']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/laporan-peserta', [LaporanController::class, 'index']);
    Route::get('/dashboard/laporan-kegiatan-peserta', [LaporanController::class, 'print']);
    Route::get('/dashboard/laporan-absensi-peserta', [LaporanController::class, 'printAbsensi']);
    Route::get('/dashboard/laporan-penilaian-peserta', [LaporanController::class, 'printPenilaian']);
    Route::get('/dashboard/laporan-penilaian-pembimbing', [LaporanController::class, 'printPenilaianPembimbing']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/kegiatan-admin', [KegiatanMagangController::class, 'indexMain']);
    Route::get('/dashboard/kegiatan-admin/detail-magang/{id}', [DetailMagangController::class, 'show']);
    Route::get('/dashboard/kegiatan-admin/kegiatan-magang/{user_id}', [KegiatanMagangController::class, 'indexKegiatan']);
    Route::post('/dashboard/kegiatan-admin/kegiatan-magang/{id}/revisi', [KegiatanMagangController::class, 'updateRevisi']);
    Route::put('/dashboard/kegiatan-admin/kegiatan-magang/{id}/status', [KegiatanMagangController::class, 'updateStatus']);
    Route::get('/dashboard/kegiatan-admin/print/{user_id}', [KegiatanMagangController::class, 'printAdmin']);
});

Route::middleware(['auth', 'preventAdmin'])->group(function () {
    Route::get('/dashboard/absensi', [AbsensiPesertaController::class, 'index']);
    Route::post('/dashboard/absensi/store', [AbsensiPesertaController::class, 'store']);
    Route::post('/dashboard/absensi/keluar', [AbsensiPesertaController::class, 'absenKeluar']);
    Route::get('/dashboard/absensi/{user_id}/print', [AbsensiPesertaController::class, 'printAbsensi']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/absensi-admin/{user_id}', [AbsensiPesertaController::class, 'indexAdmin']);
    Route::post('/dashboard/absensi-admin/store/{user_id}', [AbsensiPesertaController::class, 'storeAdmin']);
    Route::post('/dashboard/absensi-admin/keluar/{user_id}', [AbsensiPesertaController::class, 'absenkeluarAdmin']);
    Route::get('/dashboard/absensi-admin/{id}/edit', [AbsensiPesertaController::class, 'editAdmin']);
    Route::put('/dashboard/absensi-admin/{id}/update', [AbsensiPesertaController::class, 'updateAdmin']);
    Route::delete('/dashboard/absensi-admin/{id}', [AbsensiPesertaController::class, 'destroyAdmin']);
    Route::delete('/dashboard/absensi-admin/{id}/delete-foto', [AbsensiPesertaController::class, 'deletebuktiAdmin']);
    Route::get('/dashboard/absensi-admin/{user_id}/print', [AbsensiPesertaController::class, 'printAbsensi']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/kelola-pengguna', [AdminController::class, 'index']);
    Route::post('/dashboard/kelola-pengguna', [AdminController::class, 'store']);
    Route::get('/dashboard/kelola-pengguna/print', [AdminController::class, 'print']);
    Route::get('/dashboard/kelola-pengguna/printAP', [AdminController::class, 'printAP']);
    Route::get('/dashboard/kelola-pengguna/printPL', [AdminController::class, 'printPL']);
    Route::get('/dashboard/kelola-pengguna/printPS', [AdminController::class, 'printPS']);
    Route::delete('/dashboard/kelola-pengguna/{id}', [AdminController::class, 'destroy']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/verifikasi-peserta', [PesertaController::class, 'index']);
    Route::post('/dashboard/verifikasi-peserta/approve/{id}', [PesertaController::class, 'approve']);
    Route::post('/dashboard/verifikasi-peserta/reject/{id}', [PesertaController::class, 'reject']);
    Route::delete('/dashboard/verifikasi-peserta/delete/{id}', [PesertaController::class, 'destroy']);
    Route::get('/dashboard/verifikasi-peserta/print', [PesertaController::class, 'print']);
    Route::get('/dashboard/verifikasi-peserta/profile/{nama}', [ProfileController::class, 'show']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/jadwal-peserta', [JadwalMagangController::class, 'index']);
    Route::get('/dashboard/buat-jadwal-peserta', [JadwalMagangController::class, 'create']);
    Route::post('/dashboard/jadwal-peserta', [JadwalMagangController::class, 'store']);
    Route::get('/dashboard/edit-jadwal-peserta/{id}', [JadwalMagangController::class, 'edit']);
    Route::put('/dashboard/jadwal-peserta/{id}', [JadwalMagangController::class, 'update']);
    Route::delete('/dashboard/jadwal-peserta/{id}', [JadwalMagangController::class, 'destroy']);
    Route::get('/dashboard/report-jadwal-peserta', [JadwalMagangController::class, 'printPeserta']);
});

Route::middleware(['auth', 'preventAdmin'])->group(function () {
    Route::get('/dashboard/jadwal-magang', [JadwalMagangController::class, 'show']);
    Route::get('/dashboard/laporan-jadwal-peserta', [JadwalMagangController::class, 'printPeserta']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/pendaftaran-peserta', [PendaftaranPesertaController::class, 'index']);
    Route::get('/dashboard/pendaftaran-peserta/surat-balasan/{id}', [PendaftaranPesertaController::class, 'showSurat']);
    Route::delete('/dashboard/pendaftaran-peserta/{id}', [PendaftaranPesertaController::class, 'destroy']);
    Route::post('/dashboard/pendaftaran-peserta/update-check-status', [PendaftaranPesertaController::class, 'updateCheckStatus']);
    Route::post('/dashboard/pendaftaran-peserta/surat-balasan/{id}', [PendaftaranPesertaController::class, 'storeSuratBalasan']);
    Route::get('/dashboard/surat-balasan/print/{id}', [PendaftaranPesertaController::class, 'print']);
    Route::get('/dashboard/pendaftaran-peserta/laporan-surat-balasan', [PendaftaranPesertaController::class, 'printSB']);
    Route::get('/dashboard/pendaftaran-peserta/laporan-persetujuan-magang', [PendaftaranPesertaController::class, 'printPM']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/data-ruangan', [RuanganController::class, 'index']);
    Route::get('/dashboard/data-ruangan/create', [RuanganController::class, 'create']);
    Route::post('/dashboard/data-ruangan', [RuanganController::class, 'store']);
    Route::get('/dashboard/data-ruangan/{nip}/edit', [RuanganController::class, 'edit']);
    Route::put('/dashboard/data-ruangan/{nip}', [RuanganController::class, 'update']);
    Route::delete('/dashboard/data-ruangan/{nip}', [RuanganController::class, 'destroy']);
});

// Route::middleware('admin')->group(function () {
//     Route::match(['get', 'post'], '/dashboard/penilaian-akhir', [PenilaianPesertaController::class, 'indexAdmin']);
//     Route::get('/dashboard/penilaian-akhir/peringkat-peserta', [PenilaianPesertaController::class, 'rank']);
//     Route::get('/dashboard/penilaian-akhir/peringkat-peserta/{id}', [PenilaianPesertaController::class, 'printRank']);
//     Route::get('/dashboard/penilaian-akhir/form-penilaian/{user_id}', [PenilaianPesertaController::class, 'edit']);
//     Route::post('/dashboard/penilaian-akhir/form-penilaian/{user_id}', [PenilaianPesertaController::class, 'store']);
//     Route::get('/dashboard/penilaian-akhir/cetak-penilaian/{user_id}', [PenilaianPesertaController::class, 'print']);
//     Route::get('/dashboard/penilaian-akhir/sertifikat/{user_id}', [PenilaianPesertaController::class, 'generateCertificate']);
//     Route::get('/dashboard/penilaian-akhir/laporan-sertifikat-magang/cetak', [PenilaianPesertaController::class, 'printSertifikat']);
//     Route::get('/dashboard/penilaian-akhir/laporan-perangkingan-peserta-terbaik', [PenilaianPesertaController::class, 'printAllRanking']);
// });

Route::middleware(['auth', 'preventAdmin'])->group(function () {
    Route::get('/dashboard/penilaian-magang-peserta', [PenilaianPesertaController::class, 'show']);
    Route::get('/dashboard/penilaian-akhir/peringkat-peserta-cetak/{id}', [PenilaianPesertaController::class, 'printRankPM']);
    Route::get('/dashboard/penilaian-magang-peserta/cetak-penilaian/{user_id}', [PenilaianPesertaController::class, 'print']);
    Route::get('/dashboard/penilaian-magang-peserta/sertifikat/{user_id}', [PenilaianPesertaController::class, 'generateCertificate']);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'indexAdmin']);
    Route::get('/dashboard/reset-password-admin', [PasswordController::class, 'indexAdmin']);
    Route::post('/dashboard/reset-password-admin', [PasswordController::class, 'updateAdmin']);
});

// ADMIN PENDAFTARAN DAN PEMBIMBING LAPANGAN

// Rute untuk Admin Pendaftaran
Route::middleware('adminPendaftaran')->group(function () {
    Route::get('/dashboard/grafik-penerimaan/admin-pendaftaran', [GrafikController::class, 'indexAP']);
    Route::get('/dashboard/grafik-penerimaan/print/admin-pendaftaran', [GrafikController::class, 'printAP']);
    Route::get('/dashboard/grafik-penerimaan-tahunan/print/admin-pendaftaran', [GrafikController::class, 'printTahunan']);
});

Route::middleware('adminPendaftaran')->group(function () {
    Route::get('/dashboard/penilaian-pembimbing/admin-pendaftaran', [PenilaianPembimbingController::class, 'indexAP']);
    Route::get('/dashboard/penilaian-pembimbing/lihat-penilaian/admin-pendaftaran/{id}', [PenilaianPembimbingController::class, 'showAP']);
    Route::get('/dashboard/penilaian-pembimbing/admin-pendaftaran/{id}/cetak', [PenilaianPembimbingController::class, 'cetakAP']);
});

Route::middleware('adminPendaftaran')->group(function () {
    Route::get('/dashboard/admin-pendaftaran', [DashboardController::class, 'indexAdminPendaftaran']);
    Route::get('/dashboard/reset-password-adminpendaftaran', [PasswordController::class, 'indexAdminAP']);
    Route::post('/dashboard/reset-password-adminpendaftaran', [PasswordController::class, 'updateAdminAP']);
});


Route::middleware('adminPendaftaran')->group(function () {
    Route::get('/dashboard/pendaftaran-peserta/admin-pendaftaran', [PendaftaranPesertaController::class, 'indexAP']);
    Route::get('/dashboard/pendaftaran-peserta/surat-balasan/admin-pendaftaran/{id}', [PendaftaranPesertaController::class, 'showSuratAP']);
    Route::delete('/dashboard/pendaftaran-peserta/admin-pendaftaran/{id}', [PendaftaranPesertaController::class, 'destroyAP']);
    Route::post('/dashboard/pendaftaran-peserta/update-check-status/admin-pendaftaran', [PendaftaranPesertaController::class, 'updateCheckStatus']);
    Route::post('/dashboard/pendaftaran-peserta/surat-balasan/admin-pendaftaran/{id}', [PendaftaranPesertaController::class, 'storeSuratBalasanAP']);
    Route::get('/dashboard/surat-balasan/print/admin-pendaftaran/{id}', [PendaftaranPesertaController::class, 'printAP']);
    Route::get('/dashboard/pendaftaran-peserta/laporan-surat-balasan/admin-pendaftaran', [PendaftaranPesertaController::class, 'printSBAP']);
    Route::get('/dashboard/pendaftaran-peserta/laporan-persetujuan-magang/admin-pendaftaran', [PendaftaranPesertaController::class, 'printPMAP']);
});

Route::middleware('adminPendaftaran')->group(function () {
    Route::get('/dashboard/kelola-pengguna/admin-pendaftaran', [AdminController::class, 'indexAP']);
    Route::post('/dashboard/kelola-pengguna/admin-pendaftaran', [AdminController::class, 'storeAP']);
    Route::get('/dashboard/kelola-pengguna/printP/admin-pendaftaran', [AdminController::class, 'print']);
    Route::get('/dashboard/kelola-pengguna/printAP/admin-pendaftaran', [AdminController::class, 'printAP']);
    Route::get('/dashboard/kelola-pengguna/printPL/admin-pendaftaran', [AdminController::class, 'printPL']);
    Route::get('/dashboard/kelola-pengguna/printPS/admin-pendaftaran', [AdminController::class, 'printPS']);
    Route::delete('/dashboard/kelola-pengguna/admin-pendaftaran/{id}', [AdminController::class, 'destroyAP']);
});

Route::middleware('adminPendaftaran')->group(function () {
    Route::get('/dashboard/verifikasi-peserta/admin-pendaftaran', [PesertaController::class, 'indexAP']);
    Route::post('/dashboard/verifikasi-peserta/approve/admin-pendaftaran/{id}', [PesertaController::class, 'approveAP']);
    Route::post('/dashboard/verifikasi-peserta/reject/admin-pendaftaran/{id}', [PesertaController::class, 'rejectAP']);
    Route::delete('/dashboard/verifikasi-peserta/delete/admin-pendaftaran/{id}', [PesertaController::class, 'destroyAP']);
    Route::get('/dashboard/verifikasi-peserta/print/admin-pendaftaran', [PesertaController::class, 'print']);
    Route::get('/dashboard/verifikasi-peserta/profile/{nama}/admin-pendaftaran', [ProfileController::class, 'showAP']);
});

Route::middleware('adminPendaftaran')->group(function () {
    Route::get('/dashboard/data-ruangan/admin-pendaftaran', [RuanganController::class, 'indexAP']);
    Route::get('/dashboard/data-ruangan/admin-pendaftaran/create', [RuanganController::class, 'createAP']);
    Route::post('/dashboard/data-ruangan/admin-pendaftaran', [RuanganController::class, 'storeAP']);
    Route::get('/dashboard/data-ruangan/admin-pendaftaran/{nip}/edit', [RuanganController::class, 'editAP']);
    Route::put('/dashboard/data-ruangan/admin-pendaftaran/{nip}', [RuanganController::class, 'updateAP']);
    Route::delete('/dashboard/data-ruangan/admin-pendaftaran/{nip}', [RuanganController::class, 'destroyAP']);
});

// Rute untuk Pembimbing Lapangan
Route::middleware('pembimbingLapangan')->group(function () {
    Route::get('/dashboard/pembimbing-lapangan', [DashboardController::class, 'indexPembimbingLapangan']);
    Route::get('/dashboard/reset-password-pembimbing', [PasswordController::class, 'indexPL']);
    Route::post('/dashboard/reset-password-pembimbing', [PasswordController::class, 'updatePL']);
});

Route::middleware('pembimbingLapangan')->group(function () {
    Route::get('/dashboard/penilaian-pembimbing/pembimbing-lapangan', [PenilaianPembimbingController::class, 'indexPL']);
    Route::get('/dashboard/penilaian-pembimbing/lihat-penilaian/pembimbing-lapangan/{id}', [PenilaianPembimbingController::class, 'showPL']);
    Route::get('/dashboard/penilaian-pembimbing/pembimbing-lapangan/{id}/cetak', [PenilaianPembimbingController::class, 'cetakPL']);
});

Route::middleware('pembimbingLapangan')->group(function () {
    Route::get('/dashboard/laporan-peserta/pembimbing-lapangan', [LaporanController::class, 'indexPL']);
    Route::get('/dashboard/laporan-kegiatan-peserta/pembimbing-lapangan', [LaporanController::class, 'printPL']);
    Route::get('/dashboard/laporan-absensi-peserta/pembimbing-lapangan', [LaporanController::class, 'printAbsensiPL']);
    Route::get('/dashboard/laporan-penilaian-peserta/pembimbing-lapangan', [LaporanController::class, 'printPenilaianPL']);
    Route::get('/dashboard/laporan-penilaian-pembimbing/pembimbing-lapangan', [LaporanController::class, 'printPenilaianPembimbing']);
});

Route::middleware('pembimbingLapangan')->group(function () {
    Route::get('/dashboard/kelola-pengguna/pembimbing-lapangan', [AdminController::class, 'indexPL']);
    Route::get('/dashboard/verifikasi-peserta/pembimbing-lapangan', [PesertaController::class, 'indexPL']);
    Route::get('/dashboard/verifikasi-peserta/profile/{nama}/pembimbing-lapangan', [ProfileController::class, 'showPL']);
    Route::get('/dashboard/data-ruangan/pembimbing-lapangan', [RuanganController::class, 'indexPL']);
});

Route::middleware('pembimbingLapangan')->group(function () {
    Route::get('/dashboard/jadwal-peserta/pembimbing-lapangan', [JadwalMagangController::class, 'indexPL']);
    Route::get('/dashboard/buat-jadwal-peserta/pembimbing-lapangan', [JadwalMagangController::class, 'createPL']);
    Route::post('/dashboard/jadwal-peserta/pembimbing-lapangan', [JadwalMagangController::class, 'storePL']);
    Route::get('/dashboard/edit-jadwal-peserta/pembimbing-lapangan/{id}', [JadwalMagangController::class, 'editPL']);
    Route::put('/dashboard/jadwal-peserta/pembimbing-lapangan/{id}', [JadwalMagangController::class, 'updatePL']);
    Route::delete('/dashboard/jadwal-peserta/pembimbing-lapangan/{id}', [JadwalMagangController::class, 'destroyPL']);
    Route::get('/dashboard/report-jadwal-peserta/pembimbing-lapangan', [JadwalMagangController::class, 'printPeserta']);
});

Route::middleware('pembimbingLapangan')->group(function () {
    Route::get('/dashboard/kegiatan-pembimbing', [KegiatanMagangController::class, 'indexMainPL']);
    Route::get('/dashboard/kegiatan-pembimbing/detail-magang/{id}', [DetailMagangController::class, 'showPL']);
    Route::get('/dashboard/kegiatan-pembimbing/kegiatan-magang/{user_id}', [KegiatanMagangController::class, 'indexKegiatanPL']);
    Route::post('/dashboard/kegiatan-pembimbing/kegiatan-magang/{id}/revisi', [KegiatanMagangController::class, 'updateRevisi']);
    Route::put('/dashboard/kegiatan-pembimbing/kegiatan-magang/{id}/status', [KegiatanMagangController::class, 'updateStatus']);
    Route::get('/dashboard/kegiatan-pembimbing/print/{user_id}', [KegiatanMagangController::class, 'printAdmin']);
});

Route::middleware('pembimbingLapangan')->group(function () {
    Route::get('/dashboard/absensi-pembimbing/{user_id}', [AbsensiPesertaController::class, 'indexAdminPL']);
    Route::post('/dashboard/absensi-pembimbing/store/{user_id}', [AbsensiPesertaController::class, 'storeAdmin']);
    Route::post('/dashboard/absensi-pembimbing/keluar/{user_id}', [AbsensiPesertaController::class, 'absenkeluarAdmin']);
    Route::get('/dashboard/absensi-pembimbing/{id}/edit', [AbsensiPesertaController::class, 'editAdminPL']);
    Route::put('/dashboard/absensi-pembimbing/{id}/update', [AbsensiPesertaController::class, 'updateAdminPL']);
    Route::delete('/dashboard/absensi-pembimbing/{id}', [AbsensiPesertaController::class, 'destroyAdmin']);
    Route::delete('/dashboard/absensi-pembimbing/{id}/delete-foto', [AbsensiPesertaController::class, 'deletebuktiAdminPL']);
    Route::get('/dashboard/absensi-pembimbing/{user_id}/print', [AbsensiPesertaController::class, 'printAbsensi']);
});

Route::middleware('pembimbingLapangan')->group(function () {
    Route::match(['get', 'post'], '/dashboard/penilaian-akhir/pembimbing-lapangan', [PenilaianPesertaController::class, 'indexAdminPL']);
    Route::get('/dashboard/penilaian-akhir/peringkat-peserta/pembimbing-lapangan', [PenilaianPesertaController::class, 'rankPL']);
    Route::get('/dashboard/penilaian-akhir/peringkat-peserta-cetak/pembimbing-lapangan/{id}', [PenilaianPesertaController::class, 'printRankPL']);
    Route::get('/dashboard/penilaian-akhir/form-penilaian/pembimbing-lapangan/{user_id}', [PenilaianPesertaController::class, 'editPL']);
    Route::post('/dashboard/penilaian-akhir/form-penilaian/pembimbing-lapangan/{user_id}', [PenilaianPesertaController::class, 'storePL']);
    Route::get('/dashboard/penilaian-akhir/cetak-penilaian/pembimbing-lapangan/{user_id}', [PenilaianPesertaController::class, 'print']);
    Route::get('/dashboard/penilaian-akhir/sertifikat/pembimbing-lapangan/{user_id}', [PenilaianPesertaController::class, 'generateCertificate']);
    Route::get('/dashboard/penilaian-akhir/laporan-sertifikat-magang/cetak/pembimbing-lapangan', [PenilaianPesertaController::class, 'printSertifikatPL']);
    Route::get('/dashboard/penilaian-akhir/laporan-perangkingan-peserta-terbaik/pembimbing-lapangan', [PenilaianPesertaController::class, 'printAllRankingPL']);
});

Route::middleware('adminPendaftaran')->group(function () {
    Route::match(['get', 'post'], '/dashboard/penilaian-akhir/admin-pendaftaran', [PenilaianPesertaController::class, 'indexAdminAP']);
    Route::get('/dashboard/penilaian-akhir/peringkat-peserta/admin-pendaftaran', [PenilaianPesertaController::class, 'rankAP']);
    Route::get('/dashboard/penilaian-akhir/peringkat-peserta-cetak/admin-pendaftaran/{id}', [PenilaianPesertaController::class, 'printRankPL']);
    Route::get('/dashboard/penilaian-akhir/form-penilaian/admin-pendaftaran/{user_id}', [PenilaianPesertaController::class, 'editAP']);
    Route::get('/dashboard/penilaian-akhir/sertifikat/admin-pendaftaran/{user_id}', [PenilaianPesertaController::class, 'generateCertificate']);
    Route::get('/dashboard/penilaian-akhir/laporan-sertifikat-magang/cetak/admin-pendaftaran', [PenilaianPesertaController::class, 'printSertifikatPL']);
    Route::get('/dashboard/penilaian-akhir/laporan-perangkingan-peserta-terbaik/admin-pendaftaran', [PenilaianPesertaController::class, 'printAllRankingPL']);
});

Route::middleware('admin')->group(function () {
    Route::match(['get', 'post'], '/dashboard/penilaian-akhir', [PenilaianPesertaController::class, 'indexAdmin']);
    Route::get('/dashboard/penilaian-akhir/peringkat-peserta', [PenilaianPesertaController::class, 'rank']);
    Route::get('/dashboard/penilaian-akhir/peringkat-peserta/{id}', [PenilaianPesertaController::class, 'printRank']);
    Route::get('/dashboard/penilaian-akhir/form-penilaian/{user_id}', [PenilaianPesertaController::class, 'edit']);
    Route::post('/dashboard/penilaian-akhir/form-penilaian/{user_id}', [PenilaianPesertaController::class, 'store']);
    Route::get('/dashboard/penilaian-akhir/cetak-penilaian/{user_id}', [PenilaianPesertaController::class, 'print']);
    Route::get('/dashboard/penilaian-akhir/sertifikat/{user_id}', [PenilaianPesertaController::class, 'generateCertificate']);
    Route::get('/dashboard/penilaian-akhir/laporan-sertifikat-magang/cetak', [PenilaianPesertaController::class, 'printSertifikat']);
    Route::get('/dashboard/penilaian-akhir/laporan-perangkingan-peserta-terbaik', [PenilaianPesertaController::class, 'printAllRanking']);
});
