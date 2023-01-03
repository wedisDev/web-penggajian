<?php

namespace App\Http\Controllers;

use App\Models\BonusOmzet;
use App\Models\Cabang;
use App\Models\Pegawai;
use App\Models\Perhitungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // dd($id);
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('pegawais.id_cabang', $id)
            ->get();

        foreach ($pegawai as $item) {
            if (!$item->id) {
                $pegawai = 'Data Kosong';
                break;
            }
            return view('owner.transaksi.index', [
                'pegawai' => $pegawai,
            ]);
        }
        Alert::error('Error', 'Pegawai tidak didaftarkan');
        return back();
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

        $data =  Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
            ->where('bo.id_cabang', $id)
            ->first();

        $omzet = $request->omzet;
        $tunjangan_makan = 10000 * (26 - $request->alpha);
        $tunjangan_lembur = 15000 * (26 - $request->alpha);
        $tunjangan = $data->tunjangan_makmur
            + $data->tunjangan_menikah
            + $data->tunjangan_anak
            + $tunjangan_makan
            + $data->tunjangan_transportasi;
        $gaji = $data->gapok
            + $tunjangan
            + $data->bonus_tahunan
            + $request->bonus_omzet
            + ($tunjangan_lembur * $request->lembur)
            - $request->pelanggaran;

        if ($omzet <= $data->bonus) {
            $thr = 1 * $data->gapok;
            $hasil = 0;
            return response()->json([
                'bonus' => $hasil,
                'hitung' => $gaji
            ]);
        } else {
            $thr = 1 * $data->gapok;

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
        $id = $request->pegawai_id;
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'pegawais.id_cabang')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('pegawais.id', $id)
            ->get();

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

            $tunjangan_makan = (26 - $request->alpha) * 10000;
            $tunjangan_lembur = (26 - $request->alpha) * 15000;
            $data = new Perhitungan();
            $tunjangan = $data->tunjangan_makmur
                + $data->tunjangan_menikah
                + $data->tunjangan_anak
                + $tunjangan_makan
                + $data->tunjangan_transportasi;

            $gaji = $data->gapok
                + $tunjangan
                + $data->bonus_tahunan
                + $request->bonus_omzet
                + ($tunjangan_lembur * $request->lembur)
                - $request->pelanggaran;

            $data->id_pegawai = $request->pegawai_id;
            $data->bulan = $request->bulan;
            $data->lembur = $request->lembur;
            $data->pelanggaran = $request->pelanggaran;
            $data->omzet = $request->omzet;
            $data->tahun = $request->tahun;
            $data->bonus_omzet = $request->bonus_omzet;
            $data->total = $gaji;
            $data->alpha = $request->alpha;
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
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
            ->join('golongans as gl', 'gl.id', '=', 'pegawais.status')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->where('ph.id', $id)
            ->get();
        // dd($pegawai);
        return view('owner.transaksi.edit', [
            'pegawai' => $pegawai,
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
            Alert::success('Berhasil', 'Data Berhasil Diubah');

            $data = Perhitungan::findOrFail($id);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Perhitungan::findOrFail($id);
        $pegawai->delete();

        return redirect()->back();
    }
}
