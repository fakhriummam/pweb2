<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Surat;

class DashboardController extends Controller
{
    public function index(){
        return view("layouts.dashboard.content");
    }

    public function anggota(){
        $members = DB::table('members')->get();
        // return view("layouts.dashboard.anggota");
        return view("layouts.dashboard.anggota", compact('members'));
    }

    public function semuaSurat(){
        $semua_surat = Surat::with('member')->get();
        return view("layouts.dashboard.surat", compact('semua_surat'));
    }


}
