<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->get();
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $cabang = Cabang::all();

        return view('owner.pegawai.index', [
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'cabang' => $cabang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $cabang = Cabang::all();

        return view('owner.pegawai.create', [
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'cabang' => $cabang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama_pegawai' => 'required',
            'status' => 'required',
            'jumlah_anak' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            
            Alert::success('Success', 'Pegawai berhasil ditambahkan');

            $pegawai = new Pegawai();

            $pegawai->nama_pegawai = $request->get('nama_pegawai'); 
            $pegawai->jenis_kelamin = $request->get('jenis_kelamin');
            $pegawai->alamat = $request->get('alamat');
            $pegawai->id_jabatan = $request->get('id_jabatan');
            $pegawai->id_cabang = $request->get('id_cabang');
            $pegawai->status = $request->get('status');
            $pegawai->tahun_masuk = $request->get('tahun_masuk');
            $pegawai->jumlah_anak = $request->get('jumlah_anak');

            $pegawai->save();

            return redirect()->route('pegawai.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $cabang = Cabang::all();

        return view('owner.pegawai.edit', [
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'cabang' => $cabang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'nama_pegawai' => 'required',
            'status' => 'required',
            'jumlah_anak' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            
            Alert::success('Success', 'Pegawai berhasil diUbah');

            $pegawai = Pegawai::findOrFail($id);

            $pegawai->nama_pegawai = $request->get('nama_pegawai'); 
            $pegawai->jenis_kelamin = $request->get('jenis_kelamin');
            $pegawai->alamat = $request->get('alamat');
            $pegawai->id_jabatan = $request->get('id_jabatan');
            $pegawai->id_cabang = $request->get('id_cabang');
            $pegawai->status = $request->get('status');
            $pegawai->tahun_masuk = $request->get('tahun_masuk');
            $pegawai->jumlah_anak = $request->get('jumlah_anak');

            $pegawai->save();

            return redirect()->route('pegawai.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->back();
    }

    public function rincian()
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->get();

        return view('pegawai.rincian.index', [
            'pegawai' => $pegawai
        ]);
    }
}
