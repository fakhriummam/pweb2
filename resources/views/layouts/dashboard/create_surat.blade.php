@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Surat')

@section('content')
    <div class="card" style="background: white; padding: 20px; border-radius: 8px;">
        <h3>Form Pengajuan Surat Kepulangan</h3>

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.surat.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Nomor Surat</label><br>
                <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}" placeholder="Contoh: 001/SKA/2026"
                    style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Anggota Pemohon</label><br>
                <select name="member_id" style="width: 100%; padding: 8px; margin-top: 5px;" required>
                    <option value="">-- Pilih Anggota --</option>
                    @foreach ($members as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Tanggal Mulai Pulang</label><br>
                <input type="date" name="tanggal_mulai_pulang" value="{{ date('Y-m-d') }}"
                    style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Tanggal Kembali</label><br>
                <input type="date" name="tanggal_kembali" style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Alasan Pulang</label><br>
                <textarea name="alasan_pulang" style="width: 100%; padding: 8px; margin-top: 5px; height: 70px;"></textarea>
            </div>

            <div>
                <button type="submit"
                    style="background-color: #2ecc71; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Simpan
                    Pengajuan</button>
                <a href="{{ route('dashboard.surat.index') }}"
                    style="text-decoration: none; color: #333; margin-left: 10px;">Kembali</a>
            </div>
        </form>
    </div>
@endsection
