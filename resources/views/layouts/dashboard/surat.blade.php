@extends('layouts.dashboard.dashboard')

@section('title', 'Daftar Surat')

@section('content')
    <div class="card" style="padding: 20px;">
        <div class="card-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Daftar Surat Kepulangan Anggota</h2>
            <a href="{{ route('dashboard.surat.create') }}" class="btn"
                style="background-color: #2ecc71; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">+
                Ajukan Surat</a>
        </div>

        @if (session('sukses'))
            <div
                style="background-color: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb;">
                {{ session('sukses') }}
            </div>
        @endif

        <table style="width: 100%; border-collapse: collapse; background: white;">
            <thead>
                <tr style="background-color: #f8f9fa; border-bottom: 2px solid #eee;">
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Pulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaSurat as $index => $s)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px; font-weight: bold; color: #34495e;">{{ $s->nomor_surat }}</td>

                        <td style="padding: 12px;">{{ $s->member->name ?? 'Anggota Tidak Ditemukan' }}</td>

                        <td style="padding: 12px;">{{ $s->tanggal_mulai_pulang }}</td>
                        <td style="padding: 12px; text-align: center;">
                            <button style="color: #3498db; border: none; background: none; cursor: pointer;">Detail</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; color: #888;">
                            Belum ada data pengajuan surat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
