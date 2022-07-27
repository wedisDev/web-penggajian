<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Perhitungan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Svg\Tag\Rect;

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
        } elseif (Auth::user()->role == 'pegawai') {
            return view('pegawai.index');
        } elseif (Auth::user()->role == 'owner') {

            $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();
            $data = Perhitungan::orderBy('omzet', 'desc')->get();
            
            $a = [];
            foreach ($data  as $item) {
                $x['omzet'] = $item->omzet;

                array_push($a, $item->omzet);
            }

            $b = [];
            foreach ($data as $item) {
                $x['bulan'] = $item->bulan;

                array_push($b, $item->bulan);
            }

            return view('owner.index', [
                'a' => $a,
                'b' => $b,
                'data' => $data,
                'tahun' => $tahun
            ]);
        }
    }

    public function chartByYear(Request $request)
    {
        $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();
        $data = Perhitungan::orderBy('omzet', 'desc')
            ->where('tahun', $request->tahun)
            ->get();

        $a = [];
        foreach ($data  as $item) {
            $x['omzet'] = $item->omzet;

            array_push($a, $item->omzet);
        }

        $b = [];
        foreach ($data as $item) {
            $x['bulan'] = $item->bulan;

            array_push($b, $item->bulan);
        }

        return view('owner.index', [
            'a' => $a,
            'b' => $b,
            'data' => $data,
            'tahun' => $tahun
        ]);
    }

    public function pilihCabang()
    {
        return view('owner.pilih',  [
            'cabang' => Cabang::all()
        ]);
    }

    public function changePassword($id)
    {
        $data = User::findOrFail($id);

        return view('owner.ubahPassword.changePassword', compact('data'));
    }

    public function storePassword(Request $request, $id)
    {
        Alert::success('Success', 'Berhasil mengubah password');
        $password = $request->password;
        User::where('id', $id)->update(['password' => bcrypt($password)]);
        // $data->password = bcrypt($password);


        return redirect()->back();
    }
}
