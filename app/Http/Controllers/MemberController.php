<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->get();
        return view('layouts.dashboard.anggota', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        return view('layouts.dashboard.create_anggota');
    }

    /**
     * Store a newly created member in database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format penulisan email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar di sistem.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status pilihan tidak valid.',
        ]);

        Member::create($validatedData);

        return redirect()->route('dashboard.anggota')->with('sukses', 'Data anggota asrama baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('layouts.dashboard.edit_anggota', compact('member'));
    }

    /**
     * Update the specified member in database.
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format penulisan email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar di sistem.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status pilihan tidak valid.',
        ]);

        $member->update($validatedData);

        return redirect()->route('dashboard.anggota')->with('sukses', 'Data anggota asrama berhasil diperbarui!');
    }

    /**
     * Remove the specified member from database.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('dashboard.anggota')->with('sukses', 'Data anggota asrama berhasil dihapus dari sistem.');
    }
}
