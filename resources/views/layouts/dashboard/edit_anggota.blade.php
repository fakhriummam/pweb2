@extends('layouts.dashboard.dashboard')

@section('title', 'Perbarui Anggota')

@section('content')
    <div class="card" style="background: white; padding: 20px; border-radius: 8px;">
        <h3>Form Perbarui Anggota Asrama</h3>

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.anggota.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label for="name">Nama Lengkap</label><br>
                <input type="text" name="name" id="name" value="{{ old('name', $member->name) }}" placeholder="Masukkan nama lengkap"
                    style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email">Alamat Email</label><br>
                <input type="email" name="email" id="email" value="{{ old('email', $member->email) }}" placeholder="Masukkan alamat email"
                    style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="status">Status Keanggotaan</label><br>
                <select name="status" id="status" style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" required>
                    <option value="active" {{ old('status', $member->status) == 'active' ? 'selected' : '' }}>Aktif (Active)</option>
                    <option value="inactive" {{ old('status', $member->status) == 'inactive' ? 'selected' : '' }}>Non-Aktif (Inactive)</option>
                </select>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit"
                    style="background-color: #2ecc71; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Simpan Perubahan</button>
                <a href="{{ route('dashboard.anggota') }}"
                    style="text-decoration: none; color: #333; margin-left: 15px; font-weight: bold;">Kembali</a>
            </div>
        </form>
    </div>
@endsection
