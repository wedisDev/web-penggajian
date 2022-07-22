<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (Auth::user()->role == 'admin') {

            $jabatan = Jabatan::count();
            $golongan = Golongan::count();
            $pegawai = Pegawai::count();

            return view('admin.index', [
                'jabatan' => $jabatan,
                'golongan' => $golongan,
                'pegawai' => $pegawai
            ]);
            
        } elseif(Auth::user()->role == 'pegawai') {
            return view('pegawai.index');
        } elseif (Auth::user()->role == 'owner') {
            return view('owner.index');
        }
        
    }

    public function pilihCabang()
    {
        return view('owner.pilih',  [
            'cabang' => Cabang::all()
        ]);
    }
}
