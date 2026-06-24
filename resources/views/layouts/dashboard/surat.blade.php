@extends('layouts.dashboard.dashboard')

@section('title', 'Daftar Surat')

@section('content')
    <div class="card" style="padding: 20px;">
        <div class="card-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Daftar Surat Izin Keluar/Pulang Santri</h2>
            <a href="{{ route('dashboard.surat.create') }}" class="btn"
                style="background-color: #2ecc71; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">+
                Ajukan Surat Izin</a>
        </div>

        @if (session('sukses'))
            <div
                style="background-color: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb;">
                {{ session('sukses') }}
            </div>
        @endif

        <table style="width: 100%; border-collapse: collapse; background: white;">
            <thead>
                <tr style="background-color: #2c3e50; color: white; border-bottom: 2px solid #eee; text-align: left;">
                    <th style="padding: 12px; text-align: center; width: 5%;">No</th>
                    <th style="padding: 12px; width: 20%;">No Surat Jalan</th>
                    <th style="padding: 12px; width: 25%;">Nama Santri</th>
                    <th style="padding: 12px; text-align: center; width: 15%;">Tanggal Izin</th>
                    <th style="padding: 12px; text-align: center; width: 15%;">Berkas Lampiran</th>
                    <th style="padding: 12px; text-align: center; width: 20%;">Aksi Pengelolaan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaSurat as $index => $s)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px; text-align: center;">{{ $index + 1 }}</td>
                        <td style="padding: 12px; font-weight: bold; color: #2c3e50;">{{ $s->nomor_surat }}</td>
                        <td style="padding: 12px;">{{ $s->member->name ?? 'Santri Tidak Ditemukan' }}</td>
                        <td style="padding: 12px; text-align: center;">{{ $s->tanggal_mulai_pulang }}</td>

                        <td style="padding: 12px; text-align: center;">
                            @if ($s->berkas_pendukung)
                                @php
                                    // Memastikan ekstensi file diubah ke huruf kecil semua agar singkron
                                    $ext = strtolower(pathinfo($s->berkas_pendukung, PATHINFO_EXTENSION));
                                @endphp

                                @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                    <a href="{{ asset('storage/' . $s->berkas_pendukung) }}" target="_blank">
                                        <img src="{{ url('storage/' . $s->berkas_pendukung) }}" alt="Berkas"
                                            class="rounded shadow-sm border"
                                            style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px;">
                                    </a>
                                @elseif($ext === 'pdf')
                                    <a href="{{ asset('storage/' . $s->berkas_pendukung) }}" target="_blank"
                                        style="text-decoration: none; background: #e74c3c; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; display: inline-block;">
                                        Lihat PDF
                                    </a>
                                @else
                                    <span class="badge bg-secondary"
                                        style="font-size: 11px; padding: 4px 8px; background: #7f8c8d; color: white; border-radius: 4px;">File
                                        Tersedia</span>
                                @endif
                            @else
                                <span style="color: #e67e22; font-size: 12px; font-style: italic;">Belum ada berkas</span>
                            @endif
                        </td>

                        <td style="padding: 12px; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 4px; flex-wrap: wrap;">
                                <a href="{{ route('dashboard.surat.cetak', $s->id) }}" target="_blank"
                                    style="text-decoration: none; background-color: #3498db; color: white; padding: 5px 10px; border-radius: 4px; font-size: 13px; font-weight: bold;">
                                    Cetak PDF
                                </a>

                                <a href="{{ route('dashboard.surat.edit', $s->id) }}"
                                    style="text-decoration: none; background: #f1c40f; color: black; padding: 5px 10px; border-radius: 4px; font-size: 13px; font-weight: bold;">
                                    Edit
                                </a>

                                <form action="{{ route('dashboard.surat.destroy', $s->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data surat izin santri ini?')"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: #e74c3c; color: white; padding: 5px 10px; border: none; border-radius: 4px; font-size: 13px; font-weight: bold; cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 20px; text-align: center; color: #888; font-style: italic;">
                            Belum ada data riwayat permohonan surat izin keluar/pulang santri.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
