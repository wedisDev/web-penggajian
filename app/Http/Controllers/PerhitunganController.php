<?php

namespace App\Http\Controllers;

use App\Models\BonusOmzet;
use App\Models\Cabang;
use App\Models\Pegawai;
use App\Models\Perhitungan;
use Carbon\Carbon;
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

        $pilih_pegawai = DB::select("SELECT pegawais.id as 'pegawai_id', cabangs.id as 'cabang_id', pegawais.nama_pegawai FROM `pegawais`
            JOIN cabangs ON pegawais.id_cabang = cabangs.id
            WHERE cabangs.id = '$id'");
        // dd($pilih_pegawai);
        return view('owner.transaksi.filterCabang', [
            'pegawai' => $pegawai,
            'pilih_pegawai' => $pilih_pegawai,
            'cabang' => $cabang,
            'cabangs' => $cabangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $cabang)
    {
        $date = Carbon::now();

        $month = $date->month;
        $year = $date->year;
        $pegawai = Pegawai::select(
            'pegawais.id',
            'pegawais.nama_pegawai',
            'pegawais.id_jabatan',
            'pegawais.id_cabang',
            'pegawais.jenis_kelamin',
            'pegawais.alamat',
            'pegawais.tahun_masuk',
            'pegawais.jumlah_anak',
            'jb.nama_jabatan',
            'jb.gapok',
            'jb.tunjangan_makmur',
            'jb.tunjangan_makan',
            'jb.tunjangan_transportasi',
            'jb.tunjangan_lembur',
            'jb.tunjangan_menikah',
            'jb.tunjangan_anak',
            'jb.bonus_tahunan',
            'cb.id as id_cabang',
            'cb.nama_cabang',
            'o.omzet',
            'bo.bonus',
            'gl.nama_golongan'
        )
            ->join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('omzet as o', 'o.id_cabang', '=', 'cb.id')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('pegawais.id_cabang', $cabang)
            ->where('pegawais.id', $id)
            ->whereMonth('o.date',  $month)
            ->get();
        $pegawai2 = Pegawai::select(
            'pegawais.id',
            'pegawais.nama_pegawai',
            'pegawais.id_jabatan',
            'pegawais.id_cabang',
            'pegawais.jenis_kelamin',
            'pegawais.alamat',
            'pegawais.tahun_masuk',
            'pegawais.jumlah_anak',
            'jb.nama_jabatan',
            'jb.gapok',
            'jb.tunjangan_makmur',
            'jb.tunjangan_makan',
            'jb.tunjangan_transportasi',
            'jb.tunjangan_lembur',
            'jb.tunjangan_menikah',
            'jb.tunjangan_anak',
            'jb.bonus_tahunan',
            'cb.id as id_cabang',
            'cb.nama_cabang',
            'o.omzet',
            'bo.bonus',
            'gl.nama_golongan'
        )
            ->join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('omzet as o', 'o.id_cabang', '=', 'cb.id')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'pegawais.id_cabang')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('pegawais.id_cabang', $cabang)
            ->where('pegawais.id', $id)
            ->whereMonth('o.date',  $month)
            ->get();

        $bonus = 0;

        foreach ($pegawai as $item) {
            if ($item->omzet >= $item->bonus) {
                $bonus = $item->omzet - ($item->omzet * 0.995);
            }
            if (!$item->id) {
                $perhitungan = Perhitungan::where('id_pegawai', $pegawai2[0]->id)->where('bulan',  $month)->first();
                if (empty($perhitungan)) {
                    return view('owner.transaksi.create', [
                        'pegawai' => $pegawai2,
                        'bonus' => $bonus
                    ]);
                } else {
                    Alert::error('Perhitungan Pegawai sudah ada');
                    return back();
                }
            }
            $perhitungan = Perhitungan::where('id_pegawai', $pegawai[0]->id)->where('bulan',  $month)->first();
            if (empty($perhitungan)) {
                return view('owner.transaksi.create', [
                    'pegawai' => $pegawai,
                    'bonus' => $bonus
                ]);
            } else {
                Alert::error('Perhitungan Pegawai sudah ada');
                return back();
            }
        }
        Alert::error('Error', 'Bonus Omzet cabang didaftarkan');
        return back();
    }

    public function hitung_bonus_omzet($bulan, $id)
    {
        // dd($bulan);
        $omzet = DB::table('cabangs as c')
            ->select('o.omzet')
            ->join('omzet as o', 'o.id_cabang', '=', 'c.id')
            ->whereMonth('o.date', '=', $bulan)
            ->where('c.id', $id)
            ->get();

        $bonus_omzet = DB::table('bonus_omzets')->where('id_cabang', $id)->select('bonus')->get();
        if (empty($omzet[0])) {
            return response()->json([
                'bonus_omzet' => 0
            ]);
        } elseif ($omzet[0]->omzet < $bonus_omzet[0]->bonus) {
            return response()->json([
                'bonus_omzet' => 0
            ]);
        } else {
            $bonus_omzet = $omzet[0]->omzet -  ($omzet[0]->omzet * 0.995);
            return response()->json([
                'bonus_omzet' => $bonus_omzet
            ], 200);
        }
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

    public function hitungOmzet(Request $request, $id, $bulan)
    {
        $data =  Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('omzet as o', 'o.id_cabang', '=', 'cb.id')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'cb.id')
            ->where('bo.id_cabang', $id)
            ->whereMonth('o.date', '=', $bulan)
            ->first();

        if (empty($data)) {
            return response()->json([
                'bonus' => 0,
                'cek' => $request->all()
            ]);
        } else {
            $omzet = $request->omzet;
            $tunjangan_makan = 10000 * (27 - $request->alpha);
            // $tunjangan_lembur = 15000 * (27 - $request->alpha);
            // $tunjangan = $data->tunjangan_makmur
            //     + $data->tunjangan_menikah
            //     + $data->tunjangan_anak
            //     + $tunjangan_makan
            //     + $data->tunjangan_transportasi;

            if ($omzet < $data->bonus) {
                $thr = 1 * $data->gapok;
                $hasil = 0;
                return response()->json([
                    'bonus' => $hasil,
                ]);
            } else {
                // $thr = 1 * $data->gapok;

                return response()->json([
                    'bonus' => $data,
                ]);
            }
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
            'omzet' => 'required',
            'bonus_omzet' => 'required',
        ]);



        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Berhasil', 'Data Berhasil Disimpan');
            $tunjangan_makan = (27 - $request->alpha) * $pegawai[0]->tunjangan_makan;
            $tunjangan_anak = ($pegawai[0]->tunjangan_anak * $pegawai[0]->jumlah_anak);
            $tunjangan_lembur = $request->lembur * $pegawai[0]->tunjangan_lembur;
            $data = new Perhitungan();
            $tunjangan = $pegawai[0]->tunjangan_makmur
                + $pegawai[0]->tunjangan_menikah
                + $tunjangan_anak
                + $tunjangan_makan
                + (27 - $request->alpha) * $pegawai[0]->tunjangan_transportasi;

            $gaji = $pegawai[0]->gapok
                + $tunjangan
                + (int) $request->bonus_omzet
                + $tunjangan_lembur
                - $request->pelanggaran;
            $data->id_pegawai = $request->pegawai_id;
            $data->bulan = $request->bulan;
            $data->lembur = $request->lembur == null ? 0 : $request->lembur;
            $data->pelanggaran = $request->pelanggaran == null ? 0 : $request->pelanggaran;
            $data->omzet = $request->omzet;
            $data->tahun = $request->tahun;
            $data->bonus_omzet = $request->bonus_omzet;
            $data->total = $gaji;
            $data->alpha = $request->alpha == null ? 0 : $request->alpha;
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
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
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
            // 'omzet' => 'required',
            // 'bonus_omzet' => 'required',
            // 'total' => 'required',
        ]);

        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('bonus_omzets as bo', 'bo.id_cabang', '=', 'pegawais.id_cabang')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->where('pegawais.id', $id)
            ->select(
                'pegawais.jumlah_anak',
                'jb.gapok',
                'jb.tunjangan_makmur',
                'jb.tunjangan_makan',
                'jb.tunjangan_transportasi',
                'jb.tunjangan_lembur',
                'jb.tunjangan_menikah',
                'jb.tunjangan_anak',
                'jb.bonus_tahunan',
                'cb.id as id_cabang',
                'cb.nama_cabang',
                'ph.id as id_perhitungan',
                'bo.bonus',
                'gl.nama_golongan'

            )
            ->get();

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Berhasil', 'Data Berhasil Diubah');

            $tunjangan_makan = (27 - $request->alpha) * $pegawai[0]->tunjangan_makan;
            $tunjangan_anak = ($pegawai[0]->tunjangan_anak * $pegawai[0]->jumlah_anak);
            $tunjangan_lembur = $request->lembur * $pegawai[0]->tunjangan_lembur;
            $tunjangan = $pegawai[0]->tunjangan_makmur
                + $pegawai[0]->tunjangan_menikah
                + $tunjangan_anak
                + $tunjangan_makan
                + (27 - $request->alpha) * $pegawai[0]->tunjangan_transportasi;
            $gaji = $pegawai[0]->gapok
                + $tunjangan
                + (int) $request->bonus_omzet
                + $tunjangan_lembur
                - $request->pelanggaran;

            $data = Perhitungan::findOrFail($pegawai[0]->id_perhitungan);


            $data->id_pegawai = $request->pegawai_id;
            $data->bulan = $request->bulan;
            $data->lembur = $request->lembur;
            $data->pelanggaran = $request->pelanggaran;
            $data->omzet = $request->omzet;
            $data->tahun = $request->tahun;
            $data->alpha = $request->alpha;
            $data->bonus_omzet = $request->bonus_omzet;
            $data->total = $gaji;
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
