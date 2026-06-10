<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Member;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Nama variabel memakai camelCase: $semuaSurat
        $semuaSurat = Surat::with('member')->get();
        return view('layouts.dashboard.surat', compact('semuaSurat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        return view('layouts.dashboard.create_surat', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input dari Form
        $validatedData = $request->validate([
            'nomor_surat'          => 'required|unique:surats,nomor_surat|max:50',
            'member_id'            => 'required|numeric',
            'tanggal_mulai_pulang' => 'required|date',
            'tanggal_kembali'      => 'required|date',
            'alasan_pulang'        => 'nullable|string'
        ], [
            // Pesan error kustom bahasa Indonesia
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'nomor_surat.unique'   => 'Nomor surat tersebut sudah terdaftar di sistem.',
            'member_id.required'   => 'Anggota pemohon wajib dipilih.'
        ]);

        // 2. Simpan ke database menggunakan Mass Assignment Model Surat
        Surat::create($validatedData);

        // 3. Kembalikan ke halaman utama tabel surat dengan notifikasi sukses
        return redirect()->route('dashboard.surat.index')->with('sukses', 'Surat permohonan kepulangan berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $surat = Surat::findOrFail($id);

        // Sesuaikan lokasi folder view edit milikmu
        return view('layouts.dashboard.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        // Jalankan aturan validasi data server-side
        $validatedData = $request->validate([
            // Aturan unique diabaikan untuk ID surat ini sendiri agar bisa disimpan tanpa dianggap duplikat
            'nomor_surat'          => 'required|max:50|unique:surats,nomor_surat,' . $surat->id,
            'tanggal_mulai_pulang' => 'required|date',
            'tanggal_kembali'      => 'required|date',
            'alasan_pulang'        => 'nullable|string'
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'nomor_surat.unique'   => 'Nomor surat ini telah terdaftar pada sistem.'
        ]);

        // Update entitas data menggunakan fungsi update Eloquent
        $surat->update($validatedData);

        // Alihkan halaman ke indeks tabel utama disertai pesan kilat (flash message) sukses
        return redirect()->route('dashboard.surat.index')->with('sukses', 'Data surat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari objek data surat berdasarkan ID penunjuk
        $surat = Surat::findOrFail($id);

        // Eksekusi fungsi delete bawaan Eloquent ORM
        $surat->delete();

        // Kembalikan ke halaman index dengan alert flash message pemberitahuan
        return redirect()->route('dashboard.surat.index')->with('sukses', 'Data surat berhasil dihapus dari sistem.');
    }
}
