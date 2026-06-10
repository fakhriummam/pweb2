@extends('layouts.dashboard.dashboard')

@section('title', 'Perbarui Surat')

@section('content')
<div class="card" style="background: white; padding: 20px; border-radius: 8px;">
    <h3>Form Perbarui Data Surat Kepulangan</h3>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 4px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.surat.update', $surat->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- WAJIB: Mengaktifkan HTTP Method Spoofing PUT --}}

        <div style="margin-bottom: 15px;">
            <label for="nomor_surat">Nomor Surat</label><br>
            <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" style="width: 100%; padding: 8px; margin-top: 5px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="tanggal_mulai_pulang">Tanggal Mulai Pulang</label><br>
            <input type="date" name="tanggal_mulai_pulang" id="tanggal_mulai_pulang" value="{{ old('tanggal_mulai_pulang', $surat->tanggal_mulai_pulang) }}" style="width: 100%; padding: 8px; margin-top: 5px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="tanggal_kembali">Tanggal Kembali</label><br>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', $surat->tanggal_kembali) }}" style="width: 100%; padding: 8px; margin-top: 5px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="alasan_pulang">Alasan Pulang</label><br>
            <textarea name="alasan_pulang" id="alasan_pulang" style="width: 100%; padding: 8px; margin-top: 5px; height: 70px;">{{ old('alasan_pulang', $surat->alasan_pulang) }}</textarea>
        </div>

        <div>
            <a href="{{ route('dashboard.surat.index') }}" style="text-decoration: none; color: #333; margin-right: 10px;">Kembali</a>
            <button type="submit" style="background-color: #2ecc71; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
