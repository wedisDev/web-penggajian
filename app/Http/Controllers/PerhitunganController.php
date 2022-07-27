<?php

namespace App\Http\Controllers;

use App\Models\BonusOmzet;
use App\Models\Cabang;
use App\Models\Pegawai;
use App\Models\Perhitungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabang = Cabang::all();
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->get();
        
        return view('owner.transaksi.index', [
            'pegawai' => $pegawai,
            'cabang' => $cabang
        ]);
    }

    public function pilihCabang()
    {
        $cabang = Cabang::all();
        return view('owner.transaksi.pilih', [
            'cabang' => $cabang
        ]);
    }

    public function filterCabangTransaksi($id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabangs = Cabang::all();
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->where('cb.id', $id)
            ->get();
        // dd($cabang);
        return view('owner.transaksi.filterCabang', [
            'pegawai' => $pegawai,
            'cabang' => $cabang,
            'cabangs' => $cabangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
            ->where('pegawais.id_cabang', $id)
            ->get();

        return view('owner.transaksi.create', [
            'pegawai' => $pegawai,
        ]);
    }

    public function datatransaksi(Request $request)
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
            ->where('pegawais.id', $request->pegawai_id)
            ->first();
        return response()->json($pegawai);
    }

    public function hitungOmzet(Request $request, $id)
    {
        // $data = BonusOmzet::join('cabangs as cb', 'cb.id', '=', 'bonus_omzets.id_cabang')
        //     ->where('bonus_omzets.id_cabang', $id)
        //     ->first();
        $data =  Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
                ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
                ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
                ->where('bo.id_cabang', $id)
                ->first();

        $omzet = $request->omzet;

        if ($omzet <= $data->bonus) {
            $thr = 1 * $data->gapok;
            $tunjangan = $data->tunjangan_makan + $data->tunjangan_makmur + $data->tunjangan_transport + $data->lembur * $data->tunjangan_lembur + $data->tunjangan_menikah + $data->jumlah_anak * $data->tunjangan_anak;
            $gaji = $data->gapok + $tunjangan + $data->bonus_omzet + $thr - $data->pelanggaran;
            
            $hasil = 0;
            return response()->json([
                'bonus' => $hasil,
                'hitung' => $gaji
            ]);
        } else {
            $thr = 1 * $data->gapok;
            $tunjangan = $data->tunjangan_makan + $data->tunjangan_makmur + $data->tunjangan_transport + $data->lembur * $data->tunjangan_lembur + $data->tunjangan_menikah + $data->jumlah_anak * $data->tunjangan_anak;
            $gaji = $data->gapok + $tunjangan + $data->bonus_omzet + $thr - $data->pelanggaran;

            return response()->json([
                'bonus' => $data,
                'hitung' => $gaji
            ]);
        }
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
            'pegawai_id' => 'required',
            'bulan' => 'required',
            'lembur' => 'required',
            'pelanggaran' => 'required',
            'omzet' => 'required',
            'bonus_omzet' => 'required',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Berhasil', 'Data Berhasil Disimpan');

            $data = new Perhitungan();

            $data->id_pegawai = $request->pegawai_id;
            $data->bulan = $request->bulan;
            $data->lembur = $request->lembur;
            $data->pelanggaran = $request->pelanggaran;
            $data->omzet = $request->omzet;
            $data->tahun = $request->tahun;
            $data->bonus_omzet = $request->bonus_omzet;
            $data->total = $request->total;
            // dd($data);
            $data->save();

            return redirect()->route('transaksi.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
