<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $validatedData = $request->validate([
            'nomor_surat' => 'required|unique:surats,nomor_surat',
            'member_id'            => 'required|exists:members,id',
            'tanggal_mulai_pulang' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'alasan_pulang' => 'nullable|string',
            // Validasi berkas pendukung (Maksimal 2048 KB / 2 MB)
            'berkas_pendukung' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Jika santri/pengurus mengunggah berkas
        if ($request->hasFile('berkas_pendukung')) {
            $namaFile = time() . '_' . $request->file('berkas_pendukung')->getClientOriginalName();
            // Simpan file ke storage/app/public/berkas_surat
            $path = $request->file('berkas_pendukung')->storeAs('berkas_surat', $namaFile, 'public');
            $validatedData['berkas_pendukung'] = $path;
        }

        // Ambil ID santri yang sedang login saat ini untuk dimasukkan ke data member_id
        // $validatedData['member_id'] = auth()->id();

        Surat::create($validatedData);

        return redirect()->route('dashboard.surat.index')->with('sukses', 'Data permohonan surat izin santri berhasil dikirim!');
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
        $validatedData = $request->validate(
            [
                // Aturan unique diabaikan untuk ID surat ini sendiri agar bisa disimpan tanpa dianggap duplikat
                'nomor_surat' => 'required|max:50|unique:surats,nomor_surat,' . $surat->id,
                'tanggal_mulai_pulang' => 'required|date',
                'tanggal_kembali' => 'required|date',
                'alasan_pulang' => 'nullable|string',
            ],
            [
                'nomor_surat.required' => 'Nomor surat wajib diisi.',
                'nomor_surat.unique' => 'Nomor surat ini telah terdaftar pada sistem.',
            ],
        );

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

    public function cetakPdf($id)
    {
        $surat = Surat::findOrFail($id);

        // Memanggil view cetak dan mengirimkan data $surat ke dalamnya
        $pdf = Pdf::loadView('layouts.dashboard.cetak', compact('surat'));

        // Menampilkan langsung PDF di browser (stream)
        // return $pdf->stream('Surat_Izin_Santri_' . $surat->nomor_surat . '.pdf');
        return $pdf->stream('Surat_Izin_Santri_' . $surat->id . '.pdf');
    }
}
