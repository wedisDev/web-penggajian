<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Perhitungan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
        //     ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
        //     ->get();
        $pegawai = DB::select("SELECT
            pegawais.id as 'id',
            pegawais.nama_pegawai as 'nama_pegawai',
            pegawais.jenis_kelamin as 'jenis_kelamin',
            pegawais.alamat as 'alamat',
            pegawais.tahun_masuk as 'tahun_masuk',
            pegawais.jumlah_anak as 'jumlah_anak',
            pegawais.status as 'status',
            jabatans.bonus_tahunan as 'bonus_tahunan',
            jabatans.nama_jabatan as 'nama_jabatan',
            cabangs.nama_cabang as 'nama_cabang'
                FROM Pegawais
                JOIN jabatans ON jabatans.id = pegawais.id_jabatan
                JOIN cabangs ON cabangs.id = pegawais.id_cabang");
        // dd($pegawai);
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

    public function gaji()
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->select('ph.id', 'jb.nama_jabatan', 'ph.lembur', 'gl.nama_golongan', 'pegawais.jumlah_anak', 'ph.total', 'ph.bulan', 'ph.tahun')
            ->get();
        // <td>{{ $item->nama_pegawai }}</td>
        //                     <td>{{ $item->nama_jabatan }}</td>
        //                     <td>{{ $item->pelanggaran }}</td>
        //                     <td>{{ $item->lembur }}</td>
        //                     <td>{{ $item->nama_golongan }}</td>
        //                     <td>{{ $item->jumlah_anak }}</td>
        //                     <td>{{ number_format($item->total) }}</td>
        //                     <td>{{ $item->bulan }}</td>
        //                     <td>{{ $item->tahun }}</td>
        // select * fron pegawai join jabatans ON jabatans.id = pegawais.id_jabatan
        // JOIN cabangs ON cabangs.id = pegawais.id_cabang
        // JOIN golongans ON golongans.nama_golongan = pegawais.status
        // JOIN perhitungans ON perhitungans.id_pegawai = pegawais.id

        // dd($pegawai);

        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $cabang = Cabang::all();

        $tahun = Perhitungan::select('tahun')->distinct()->get();
        // dd($tahun);

        return view('owner.pegawai.gaji', [
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'cabang' => $cabang,
            'tahun' => $tahun
        ]);
    }

    public function deleteGaji($id)
    {
        // dd($id);
        $pegawai = Perhitungan::findOrFail($id);
        $pegawai->delete();
        Alert::success('Delete Success');

        return redirect()->back();
    }

    public function filterGajiPertahun($tahun)
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->orderBy('ph.bulan')
            ->where('ph.tahun', $tahun)
            ->get();

        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $cabang = Cabang::all();

        $tahun = Perhitungan::select('tahun')->distinct()->get();
        // dd($tahun);

        return view('owner.pegawai.gaji', [
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'cabang' => $cabang,
            'tahun' => $tahun
        ]);
    }

    public function filterGajiCabang($id)
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('cb.id', $id)
            ->get();

        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $cabang = Cabang::all();

        return view('owner.pegawai.gajiByCabang', [
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'cabang' => $cabang
        ]);
    }

    public function slipGaji($bulan, $tahun, $id)
    {
        $date = Carbon::now();
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('ph.id', $id)
            ->where('ph.bulan', $bulan)
            ->where('ph.tahun', $tahun)
            ->get();
        // dd($pegawai);

        foreach ($pegawai as $item) {
            if ($item->jumlah_anak == 0) {
                $item->tunjangan_anak = 0;
            } else {
                $item->tunjangan_anak = $item->tunjangan_anak * $item->jumlah_anak;
            }
        }

        $date_new = $date->toFormattedDateString();
        $tahun = $pegawai[0]->created_at->year();
        $masuk =  27 - $pegawai[0]->alpha;
        $tunjangan_makan  = $pegawai[0]->tunjangan_makan * $masuk;

        return view('owner.pegawai.slip-gaji', [
            'pegawai' => $pegawai,
            'tanggal' => $date_new,
            'tahun' => $tahun,
            'tunjangan_makan' => $tunjangan_makan,
            'masuk' => $masuk
        ]);

        $pdf = PDF::loadView('owner.pegawai.slip-gaji', [
            'pegawai' => $pegawai,
            'tanggal' => $date_new,
            'tahun' => $tahun,
            'tunjangan_makan' => $tunjangan_makan,
            'masuk' => $masuk
        ])->setpaper('a4', 'landscape');

        return $pdf->download('slip-gaji' . '-' . $pegawai[0]->nama_pegawai . '.pdf');
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
        // dd($request->all());

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {

            Alert::success('Success', 'Pegawai berhasil ditambahkan');

            $pegawai = new Pegawai();
            $idCabang = $request->get('id_cabang');

            // $cekId = Pegawai::latest()->first()->id;
            // dd($cekId);
            $buatID =
                IdGenerator::generate(['table' => 'pegawais', 'length' => 7, 'prefix' => date('y') . $idCabang]);

            $email = Str::lower(str_replace(' ', '', $request->get('nama_pegawai'))) . '@gmail.com';
            $cekEmail = User::where('email', $email)->get();
            // dd($cekEmail, $email);
            if ($cekEmail == $email) {
                Alert::error('Email sudah ada', 'Harap masukan email yang lain');
                return back()->withInput();
            }

            $pegawai->id = $buatID;
            $pegawai->nama_pegawai = $request->get('nama_pegawai');
            $pegawai->jenis_kelamin = $request->get('jenis_kelamin');
            $pegawai->alamat = $request->get('alamat');
            $pegawai->id_jabatan = $request->get('id_jabatan');
            $pegawai->id_cabang = $idCabang;
            $pegawai->status = $request->get('status');
            $pegawai->tahun_masuk = $request->get('tahun_masuk');
            $pegawai->jumlah_anak = $request->get('jumlah_anak');

            User::create([
                'id_pegawai' => $buatID,
                'name' => $request->get('nama_pegawai'),
                'role' => 'pegawai',
                'email' => $email,
                'password' => bcrypt($buatID),
            ]);

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
        $cabang = Cabang::all();
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        // dd($pegawai, $golongan);
        return view('owner.pegawai.edit', compact('pegawai', 'cabang', 'jabatan', 'golongan'));
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
            // 'jumlah_anak' => 'required',
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
            if (empty($request->get('jumlah_anak'))) {
                $pegawai->jumlah_anak = 0;
            } else {
                $pegawai->jumlah_anak = $request->get('jumlah_anak');
            }
            $pegawai->tahun_masuk = $request->get('tahun_masuk');

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
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('pegawais.id', Auth::user()->id_pegawai)
            ->get();


        return view('pegawai.rincian.index', [
            'pegawai' => $pegawai
        ]);
    }

    public function pelanggaran()
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->where('pegawais.id', Auth::user()->id_pegawai)
            ->get();
        return view('pegawai.pelanggaran.index', [
            'pegawai' => $pegawai
        ]);
    }

    public function history()
    {
        $pegawai = Pegawai::join('jabatans as jb', 'jb.id', '=', 'pegawais.id_jabatan')
            ->join('cabangs as cb', 'cb.id', '=', 'pegawais.id_cabang')
            ->join('perhitungans as ph', 'ph.id_pegawai', '=', 'pegawais.id')
            ->join('golongans as gl', 'gl.nama_golongan', '=', 'pegawais.status')
            ->where('pegawais.id', Auth::user()->id_pegawai)
            ->get();
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $cabang = Cabang::all();

        return view('pegawai.history.index', [
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'cabang' => $cabang
        ]);
    }
}
