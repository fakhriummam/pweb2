@extends('layouts.dashboard.dashboard')

@section('title', 'Daftar Anggota')

@section('content')
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Daftar Anggota Asrama</h2>
        <a href="#" class="btn" style="background-color: #2ecc71; font-size: 14px; color: white; text-decoration: none; padding: 8px 12px; border-radius: 4px;">+ Tambah Anggota</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: white;">
        <thead>
            <tr style="background-color: #f8f9fa; border-bottom: 2px solid #eee;">
                <th style="padding: 12px; text-align: left;">No</th>
                <th style="padding: 12px; text-align: left;">Nama Lengkap</th>
                <th style="padding: 12px; text-align: left;">Email</th>
                <th style="padding: 12px; text-align: left;">Status</th>
                <th style="padding: 12px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop data dinamis dari database --}}
            @forelse($members as $index => $member)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;">{{ $index + 1 }}</td>
                    <td style="padding: 12px;">{{ $member->name }}</td>
                    <td style="padding: 12px;">{{ $member->email }}</td>
                    <td style="padding: 12px;">
                        {{-- Styling badge status sederhana --}}
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;
                            background-color: {{ $member->status == 'active' ? '#e5f9e7' : '#fde8e8' }};
                            color: {{ $member->status == 'active' ? '#1f7834' : '#c53030' }};">
                            {{ ucfirst($member->status) }}
                        </span>
                    </td>
                    <td style="padding: 12px; text-align: center;">
                        <button style="color: #3498db; border: none; background: none; cursor: pointer;">Edit</button> |
                        <button style="color: #e74c3c; border: none; background: none; cursor: pointer;">Hapus</button>
                    </td>
                </tr>
            @empty
                {{-- Tampilan jika database masih kosong --}}
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; color: #888;">
                        Belum ada data anggota asrama.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
