@extends('layouts.dashboard.dashboard')

@section('title', 'Daftar Surat Kepulangan')

@section('content')
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Daftar Surat Kepulangan Anggota</h2>
        <a href="#" class="btn" style="background-color: #2ecc71; font-size: 14px; color: white; text-decoration: none; padding: 8px 12px; border-radius: 4px;">+ Ajukan Surat</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: white;">
        <thead>
            <tr style="background-color: #f8f9fa; border-bottom: 2px solid #eee;">
                <th style="padding: 12px; text-align: left;">No</th>
                <th style="padding: 12px; text-align: left;">No Surat</th>
                <th style="padding: 12px; text-align: left;">Nama Anggota</th>
                <th style="padding: 12px; text-align: left;">Tanggal Pulang</th>
                <th style="padding: 12px; text-align: left;">Tanggal Kembali</th>
                <th style="padding: 12px; text-align: left;">Alasan</th>
                <th style="padding: 12px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semua_surat as $index => $surat)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;">{{ $index + 1 }}</td>
                    <td style="padding: 12px; font-weight: bold; color: #34495e;">{{ $surat->nomor_surat }}</td>

                    {{-- Di sini keajaiban Eloquent, kita bisa langsung panggil nama membernya --}}
                    <td style="padding: 12px;">{{ $surat->member->name ?? 'Anggota Tidak Ditemukan' }}</td>

                    <td style="padding: 12px;">{{ \Carbon\Carbon::parse($surat->tanggal_mulai_pulang)->format('d-m-Y') }}</td>
                    <td style="padding: 12px;">{{ \Carbon\Carbon::parse($surat->tanggal_kembali)->format('d-m-Y') }}</td>
                    <td style="padding: 12px; color: #7f8c8d;">{{ $surat->alasan_pulang ?? '-' }}</td>
                    <td style="padding: 12px; text-align: center;">
                        <button style="color: #3498db; border: none; background: none; cursor: pointer;">Detail</button> |
                        <button style="color: #e74c3c; border: none; background: none; cursor: pointer;">Cetak</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center; color: #888;">
                        Belum ada riwayat surat kepulangan anggota.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
