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
        // $perhitungan = Perhitungan::selec;
        // dd($perhitungan[0]);
        // dd($perhitungan);
        return view('owner.transaksi.index', [
            'pegawai' => $pegawai,
            'cabang' => $cabang
        ]);
    }

    public function pilihCabang()
    {
        $cabang = Cabang::all();
        // dd($cabang);
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
        // dd($pegawai);
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
        // dd($pegawai[0]);
        // if (!empty($pegawai)) {
        // } else {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Pegawai dalam cabang ini tidak ada',
        //     ]);
        // }
        // dd($pegawai);
        return view('owner.transaksi.create', [
            'pegawai' => $pegawai,
            // 'bonus' => $bonus
        ]);
        // dd($pegawai != $pegawai);
        // if (!$pegawai) {
        //     $data = 'no';
        //     // dd($pegawai[0]->id_cabang);
        //     // dd($data);
        //     // return response()->json('Data gagal disimpan', 400);
        // } else {
        //     $data = 'yes';
        //     dd($pegawai[0]->id_cabang);

        //     // return view('owner.transaksi.create', [
        //     //     'pegawai' => $pegawai,
        //     //     // 'bonus' => $bonus
        //     // ]);
        // }
        // dd($pegawai);

        // $data1 = DB::select("SELECT * FROM pegawais
        // JOIN jabatans ON jabatans.id = pegawais.id_jabatan
        // JOIN cabangs ON pegawais.id_cabang = cabangs.id WHERE pegawais.id_cabang = '$id'");

        // $data2 = DB::select("SELECT * FROM bonus_omzets
        // JOIN cabangs ON cabangs.id = bonus_omzets.id_cabang
        // JOIN jabatans ON jabatans.id = bonus_omzets.id_jabatan WHERE bonus_omzets.id_cabang = '$id'");

        // $data3 = DB::select('SELECT * FROM golongans');

        // $bonus = $data1[0]->gapok + $data1[0]->tunjangan_makmur + $data1[0]->tunjangan_makan + $data1[0]->tunjangan_transportasi + $data1[0]->tunjangan_lembur + $data1[0]->tunjangan_menikah + $data1[0]->tunjangan_anak + $data1[0]->bonus_tahunan;
        // dd($pegawai, $data1);
        // $datas = [];
        // // $datas2 = [
        // //     'test' => 'hallo'
        // // ];
        // array_push($datas, $data1, $data2, $data3);
        // // array_push($datas, $bonus2);
        // // dd($datas);


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
        // dd($request->all());

        // $total_gaji = $pegawai[0]->gapok
        //     + $pegawai[0]->bonus_tahunan
        //     + $pegawai[0]->tunjangan_makmur
        //     + $pegawai[0]->tunjangan_makan
        //     + $pegawai[0]->tunjangan_transportasi
        //     + $pegawai[0]->tunjangan_menikah
        //     + $pegawai[0]->tunjangan_anak
        //     + $pegawai[0]->bonus
        //     + ($pegawai[0]->tunjangan_lembur * $request->lembur);
        // $tunjangan_makan = 10000 * (26 - 1);
        // $tunjangan_lembur = 15000 * (26 - 5);
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
        // dd('Tunjangan makan : ' . $tunjangan_makan, $tunjangan_lembur);

        if ($omzet <= $data->bonus) {
            $thr = 1 * $data->gapok;

            // + $data->lembur
            // * $data->tunjangan_lembur


            // $gaji = $data->gapok + $tunjangan + $data->bonus_omzet + $thr - $data->pelanggaran;



            // dd(
            //     'gaji tanpa pelanggaran' . $gaji - $request->pelanggaran,
            //     'Pelanggaran: ' . 100000,
            //     'GAJI TOTAL: ' . $gaji
            // );



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


        // $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
        //     ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
        //     ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
        //     ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
        //     ->where('pegawais.id_cabang', $id)
        //     ->get();

        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'pegawais.id_cabang')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('pegawais.id', $id)
            ->get();
        // dd($request->all(), $id, $pegawai);

        // $datas = DB::select("SELECT * FROM pegawais
        // JOIN jabatans ON jabatans.id = pegawais.id_jabatan
        // JOIN cabangs ON pegawais.id_cabang = cabangs.id
        // WHERE pegawais.id_cabang = '$id' ");
        // dd($pegawai);
        // $total_gaji = $pegawai[0]->gapok
        //     + $pegawai[0]->bonus_tahunan
        //     + $pegawai[0]->tunjangan_makmur
        //     + $pegawai[0]->tunjangan_makan
        //     + $pegawai[0]->tunjangan_transportasi
        //     + $pegawai[0]->tunjangan_menikah
        //     + $pegawai[0]->tunjangan_anak
        //     + $pegawai[0]->bonus
        //     + ($pegawai[0]->tunjangan_lembur * $request->lembur);

        $validator = Validator::make(request()->all(), [
            'pegawai_id' => 'required',
            'bulan' => 'required',
            'lembur' => 'required',
            'pelanggaran' => 'required',
            'omzet' => 'required',
            'bonus_omzet' => 'required',
            'total' => 'required',
        ]);


        $tunjangan_makan = 10000 * (26 - $request->alpha);
        $tunjangan_lembur = 15000 * (26 - $request->alpha);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Berhasil', 'Data Berhasil Disimpan');

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
            dd($gaji, $request->all());

            $data->id_pegawai = $request->pegawai_id;
            $data->bulan = $request->bulan;
            $data->lembur = $request->lembur;
            $data->pelanggaran = $request->pelanggaran;
            $data->omzet = $request->omzet;
            $data->tahun = $request->tahun;
            $data->bonus_omzet = $request->bonus_omzet;
            $data->total = $request->total;
            $data->alpha = $request->alpha;
            // $data->total = $total_gaji - $request->pelanggaran;
            // dd($data);
            // dd();
            // $data->save();

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
