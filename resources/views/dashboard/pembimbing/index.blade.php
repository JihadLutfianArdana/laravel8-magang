@extends('dashboard.layouts.main')

@section('container')
    <h2 class="mb-4">Penilaian Pembimbing Lapangan</h2>
    <hr class="my-4">

    <div class="card mb-4">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h4 class="card-title mb-4">Nama Pembimbing Lapangan : {{ $pembimbing->nama_pegawai }}</h4>
            <br>

            <form action="/dashboard/penilaian-pembimbing-lapangan" method="POST">
                @csrf

                <input type="hidden" name="nip_pembimbing" value="{{ $pembimbing->nip }}">

                @php
                    $fields = [
                        '1. Keterampilan Pembimbing dalam Memberikan Arahan' => 'poin_1',
                        '2. Kepedulian dan Sikap terhadap Peserta' => 'poin_2',
                        '3. Kemampuan dalam Membimbing dan Memberikan Solusi' => 'poin_3',
                        '4. Kedisiplinan dan Tanggung Jawab Pembimbing' => 'poin_4',
                        '5. Kesiapan Pembimbing dalam Memberikan Materi dan Bimbingan' => 'poin_5',
                    ];
                    $opsi = ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'];
                @endphp

                @foreach ($fields as $label => $name)
                    <div class="form-group row mb-3">
                        <label class="col-sm-6 col-form-label">{{ $label }}</label>
                        <div class="col-sm-6">
                            <select name="{{ $name }}" class="form-control @error($name) is-invalid @enderror">
                                <option value="">-- Pilih Penilaian --</option>
                                @foreach ($opsi as $option)
                                    <option value="{{ $option }}"
                                        {{ old($name, optional($penilaian)->$name) == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                            @error($name)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                @endforeach

                {{-- Saran --}}
                <div class="form-group row mb-4">
                    <label for="saran" class="col-sm-6 col-form-label">Saran untuk Pembimbing</label>
                    <div class="col-sm-6">
                        <textarea name="saran" id="saran" class="form-control" rows="2" placeholder="Tulis saran...">{{ $penilaian->saran ?? '' }}</textarea>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ $penilaian ? 'Perbarui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($penilaian)
        <div class="card mb-4">
            <div class="card-body">
                <h4>Penilaian Kinerja Pembimbing Lapangan - {{ $pembimbing->nama_pegawai }}</h4>
                @if ($penilaian && $penilaian->tanggal_penilaian)
                    <p><strong>Tanggal Penilaian:</strong>
                        {{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('l, d F Y') }}</p>
                @endif
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr class="bg-info text-white text-center">
                                <th>Aspek Yang Dinilai</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. Keterampilan Pembimbing dalam Memberikan Arahan</td>
                                <td class="text-center">{{ $penilaian->poin_1 }}</td>
                            </tr>
                            <tr>
                                <td>2. Kepedulian dan Sikap terhadap Peserta</td>
                                <td class="text-center">{{ $penilaian->poin_2 }}</td>
                            </tr>
                            <tr>
                                <td>3. Kemampuan dalam Membimbing dan Memberikan Solusi</td>
                                <td class="text-center">{{ $penilaian->poin_3 }}</td>
                            </tr>
                            <tr>
                                <td>4. Kedisiplinan dan Tanggung Jawab Pembimbing</td>
                                <td class="text-center">{{ $penilaian->poin_4 }}</td>
                            </tr>
                            <tr>
                                <td>5. Kesiapan Pembimbing dalam Memberikan Materi dan Bimbingan</td>
                                <td class="text-center">{{ $penilaian->poin_5 }}</td>
                            </tr>
                            <tr>
                                <td>6. Saran</td>
                                <td class="text-center">{{ $penilaian->saran ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-body">
                <p class="text-muted text-center">Belum ada penilaian yang tersimpan.</p>
            </div>
        </div>
    @endif
@endsection
