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
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Svg\Tag\Rect;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // public function dashboard()
    // {
    //     $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();

    //     foreach ($tahun as $item) {
    //         if ($item->tahun) {
    //             $tahun_baru = $item->tahun;
    //         }
    //     }

    //     $cabangId = [1, 2, 3, 4,];
    //     $bulanData = [];
    //     $omzetData = [];

    //     foreach ($cabangId as $cabang) {
    //         $queryResult = DB::table('perhitungans')
    //             ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
    //             ->join('cabangs', 'pegawais.id_cabang', '=', 'cabangs.id')
    //             ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('SUM(perhitungans.omzet) as omzet'))
    //             ->where('cabangs.id', $cabangId)
    //             ->groupBy('perhitungans.bulan')
    //             ->orderByDesc('perhitungans.bulan')
    //             ->get();

    //         $bulanCabang = [];
    //         $omzetCabang = [];

    //         foreach ($queryResult as $result) {
    //             array_push($bulanCabang, $result->bulan);
    //             array_push($omzetCabang, $result->omzet);
    //         }

    //         array_push($bulanData, $bulanCabang);
    //         array_push($omzetData, $omzetCabang);
    //     }
    //     // dd($bulanCabang, $omzetCabang);
    //     dd($tahun);
    //     return view('admin.index', compact('bulanData', 'omzetData'));
    //     // dd($omzetData);

    // }

    public function index()
    {
        if (Auth::user()->role == 'admin') {

            $jabatan = Jabatan::count();
            $golongan = Golongan::count();
            $pegawai = Pegawai::count();

            $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();
            $bulan = Perhitungan::select('bulan')->groupBy('bulan')->get();

            if (empty($tahun)) {
                $tahun_baru = 'Tidak ada data';
            }

            foreach ($tahun as $item) {
                if ($item->tahun) {
                    $tahun_baru = $item->tahun;
                }
            }

            if ($tahun_baru == false) {
                $data1 = DB::select("SELECT cabangs.nama_cabang, perhitungans.bulan,
                            (CASE
                                WHEN COUNT(*) > 1 THEN sum(perhitungans.omzet)
                                ELSE perhitungans.omzet
                            END) AS omzet
                            FROM perhitungans
                            JOIN pegawais ON perhitungans.id_pegawai = pegawais.id
                            JOIN cabangs ON cabangs.id = pegawais.id_cabang
                            WHERE cabangs.id = 2
                            GROUP BY perhitungans.bulan
                            ORDER BY perhitungans.bulan DESC");
            } else {
                // $data = DB::select("SELECT cabangs.nama_cabang, perhitungans.bulan,
                //             (CASE
                //                 WHEN COUNT(*) > 1 THEN sum(perhitungans.omzet)
                //                 ELSE perhitungans.omzet
                //             END) AS omzet
                //             FROM perhitungans
                //             JOIN pegawais ON perhitungans.id_pegawai = pegawais.id
                //             JOIN cabangs ON cabangs.id = pegawais.id_cabang
                //             WHERE cabangs.id = 2 OR perhitungans.tahun = '$tahun_baru'
                //             GROUP BY perhitungans.bulan
                //             ORDER BY perhitungans.bulan DESC");
                $data1 = DB::table('perhitungans')
                    ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
                    ->join('cabangs', 'cabangs.id', '=', 'pegawais.id_cabang')
                    ->where('cabangs.id', 1)
                    ->where('perhitungans.tahun', '=', $tahun_baru)
                    ->groupBy('perhitungans.bulan')
                    ->orderBy('perhitungans.bulan', 'DESC')
                    ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('CASE WHEN COUNT(*) > 1 THEN SUM(perhitungans.omzet) ELSE perhitungans.omzet END AS omzet'))
                    ->get();

                $data2 = DB::table('perhitungans')
                    ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
                    ->join('cabangs', 'cabangs.id', '=', 'pegawais.id_cabang')
                    ->where('cabangs.id', 2)
                    ->where('perhitungans.tahun', '=', $tahun_baru)
                    ->groupBy('perhitungans.bulan')
                    ->orderBy('perhitungans.bulan', 'DESC')
                    ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('CASE WHEN COUNT(*) > 1 THEN SUM(perhitungans.omzet) ELSE perhitungans.omzet END AS omzet'))
                    ->get();
                $data3 = DB::table('perhitungans')
                    ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
                    ->join('cabangs', 'cabangs.id', '=', 'pegawais.id_cabang')
                    ->where('cabangs.id', 3)
                    ->where('perhitungans.tahun', '=', $tahun_baru)
                    ->groupBy('perhitungans.bulan')
                    ->orderBy('perhitungans.bulan', 'DESC')
                    ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('CASE WHEN COUNT(*) > 1 THEN SUM(perhitungans.omzet) ELSE perhitungans.omzet END AS omzet'))
                    ->get();
                $data4 = DB::table('perhitungans')
                    ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
                    ->join('cabangs', 'cabangs.id', '=', 'pegawais.id_cabang')
                    ->where('cabangs.id', 4)
                    ->where('perhitungans.tahun', '=', $tahun_baru)
                    ->groupBy('perhitungans.bulan')
                    ->orderBy('perhitungans.bulan', 'DESC')
                    ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('CASE WHEN COUNT(*) > 1 THEN SUM(perhitungans.omzet) ELSE perhitungans.omzet END AS omzet'))
                    ->get();
            }
            // dd($data1);
            // $data_tahun = DB::select("SELECT SUM(omzet) as 'omzet', tahun FROM `perhitungans` GROUP BY tahun ORDER BY omzet DESC");
            $data_tahun =
                DB::table('perhitungans')
                ->selectRaw('SUM(omzet) as omzet, tahun')
                ->groupBy('tahun')
                ->orderByDesc('omzet')
                ->get();

            $datas1 = [null, null, null, null, null, null, null, null, null, null, null, null];
            $datas2 = [null, null, null, null, null, null, null, null, null, null, null, null];
            $datas3 = [null, null, null, null, null, null, null, null, null, null, null, null];
            $datas4 = [null, null, null, null, null, null, null, null, null, null, null, null];

            for ($i = 0; $i < count($datas1); $i++) {
                if ($datas1[$i] === null) {
                    $datas1[$i] = 0;
                }
            }
            for ($i = 0; $i < count($datas2); $i++) {
                if ($datas2[$i] === null) {
                    $datas2[$i] = 0;
                }
            }
            for ($i = 0; $i < count($datas3); $i++) {
                if ($datas3[$i] === null) {
                    $datas3[$i] = 0;
                }
            }
            for ($i = 0; $i < count($datas4); $i++) {
                if ($datas4[$i] === null) {
                    $datas4[$i] = 0;
                }
            }

            // dd($data);




            foreach ($data1 as $item) {

                if ($item->bulan == 1) {
                    $datas1[0] = (int) $item->bulan;
                } else if ($item->bulan == 2) {
                    $datas1[1] = (int) $item->omzet;
                } else if ($item->bulan == 3) {
                    $datas1[2] = (int) $item->omzet;
                } else if ($item->bulan == 4) {
                    $datas1[3] = (int) $item->omzet;
                } else if ($item->bulan == 5) {
                    $datas1[4] = (int) $item->omzet;
                } else if ($item->bulan == 6) {
                    $datas1[5] = (int) $item->omzet;
                } else if ($item->bulan == 7) {
                    $datas1[6] = (int) $item->omzet;
                } else if ($item->bulan == 8) {
                    $datas1[7] = (int) $item->omzet;
                } else if ($item->bulan == 9) {
                    $datas1[8] = (int) $item->omzet;
                } else if ($item->bulan == 10) {
                    $datas1[9] = (int) $item->omzet;
                } else if ($item->bulan == 11) {
                    $datas1[10] = (int) $item->omzet;
                } else if ($item->bulan == 12) {
                    $datas1[11] = (int) $item->omzet;
                }
            }
            foreach ($data2 as $item) {

                if ($item->bulan == 1) {
                    $datas2[0] = (int) $item->bulan;
                } else if ($item->bulan == 2) {
                    $datas2[1] = (int) $item->omzet;
                } else if ($item->bulan == 3) {
                    $datas2[2] = (int) $item->omzet;
                } else if ($item->bulan == 4) {
                    $datas2[3] = (int) $item->omzet;
                } else if ($item->bulan == 5) {
                    $datas2[4] = (int) $item->omzet;
                } else if ($item->bulan == 6) {
                    $datas2[5] = (int) $item->omzet;
                } else if ($item->bulan == 7) {
                    $datas2[6] = (int) $item->omzet;
                } else if ($item->bulan == 8) {
                    $datas2[7] = (int) $item->omzet;
                } else if ($item->bulan == 9) {
                    $datas2[8] = (int) $item->omzet;
                } else if ($item->bulan == 10) {
                    $datas2[9] = (int) $item->omzet;
                } else if ($item->bulan == 11) {
                    $datas2[10] = (int) $item->omzet;
                } else if ($item->bulan == 12) {
                    $datas2[11] = (int) $item->omzet;
                }
            }
            foreach ($data3 as $item) {

                if ($item->bulan == 1) {
                    $datas3[0] = (int) $item->bulan;
                } else if ($item->bulan == 2) {
                    $datas3[1] = (int) $item->omzet;
                } else if ($item->bulan == 3) {
                    $datas3[2] = (int) $item->omzet;
                } else if ($item->bulan == 4) {
                    $datas3[3] = (int) $item->omzet;
                } else if ($item->bulan == 5) {
                    $datas3[4] = (int) $item->omzet;
                } else if ($item->bulan == 6) {
                    $datas3[5] = (int) $item->omzet;
                } else if ($item->bulan == 7) {
                    $datas3[6] = (int) $item->omzet;
                } else if ($item->bulan == 8) {
                    $datas3[7] = (int) $item->omzet;
                } else if ($item->bulan == 9) {
                    $datas3[8] = (int) $item->omzet;
                } else if ($item->bulan == 10) {
                    $datas3[9] = (int) $item->omzet;
                } else if ($item->bulan == 11) {
                    $datas3[10] = (int) $item->omzet;
                } else if ($item->bulan == 12) {
                    $datas3[11] = (int) $item->omzet;
                }
            }
            foreach ($data4 as $item) {

                if ($item->bulan == 1) {
                    $datas4[0] = (int) $item->bulan;
                } else if ($item->bulan == 2) {
                    $datas4[1] = (int) $item->omzet;
                } else if ($item->bulan == 3) {
                    $datas4[2] = (int) $item->omzet;
                } else if ($item->bulan == 4) {
                    $datas4[3] = (int) $item->omzet;
                } else if ($item->bulan == 5) {
                    $datas4[4] = (int) $item->omzet;
                } else if ($item->bulan == 6) {
                    $datas4[5] = (int) $item->omzet;
                } else if ($item->bulan == 7) {
                    $datas4[6] = (int) $item->omzet;
                } else if ($item->bulan == 8) {
                    $datas4[7] = (int) $item->omzet;
                } else if ($item->bulan == 9) {
                    $datas4[8] = (int) $item->omzet;
                } else if ($item->bulan == 10) {
                    $datas4[9] = (int) $item->omzet;
                } else if ($item->bulan == 11) {
                    $datas4[10] = (int) $item->omzet;
                } else if ($item->bulan == 12) {
                    $datas4[11] = (int) $item->omzet;
                }
            }




            // $b = [];
            // foreach ($data as $item) {
            //     $x['bulan'] = $item->bulan;

            //     array_push($b, $item->bulan);
            // }

            // $c = [];
            // foreach ($data_tahun as $item) {
            //     $x['tahun'] = $item->tahun;

            //     array_push($c, $item->tahun);
            // }

            // $d = [];
            // foreach ($data_tahun as $item) {
            //     $x['omzet'] = (int) $item->omzet;
            //     $v = $x['omzet'];
            //     array_push($d, $v);
            // }

            $cc = [];
            $b1 = collect($data1)->pluck('bulan')->toArray();
            $b2 = collect($data2)->pluck('bulan')->toArray();
            $b3 = collect($data3)->pluck('bulan')->toArray();
            $b4 = collect($data4)->pluck('bulan')->toArray();
            $nama1 = collect($data1)->pluck('nama_cabang')->toArray();
            $nama2 = collect($data2)->pluck('nama_cabang')->toArray();
            $nama3 = collect($data3)->pluck('nama_cabang')->toArray();
            $nama4 = collect($data4)->pluck('nama_cabang')->toArray();
            array_push($cc, $b1, $b2, $b3, $b4);
            $c = collect($data_tahun)->pluck('tahun')->toArray();
            $d = collect($data_tahun)->pluck('omzet')->map(fn ($item) => (int) $item)->toArray();

            // dd($nama1, $nama2, $nama3, $nama4);



            return view('admin.index', [
                'tahun_pilih' => $tahun_baru,
                'jabatan' => $jabatan,
                'golongan' => $golongan,
                'pegawai' => $pegawai,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'b1' => $b1,
                'b2' => $b2,
                'b3' => $b3,
                'b4' => $b4,
                'nama1' => $nama1,
                'nama2' => $nama2,
                'nama3' => $nama3,
                'nama4' => $nama4,
                'c' => $c,
                'd' => $d,
                'datas1' => $datas1,
                'datas2' => $datas2,
                'datas3' => $datas3,
                'datas4' => $datas4
            ]);
        } elseif (Auth::user()->role == 'pegawai') {
            // $id = Auth::user()->id;
            $id = Auth::user()->id_pegawai;
            // $id = 221001;

            // $data = DB::select("SELECT * FROM `users`
            //     JOIN pegawais ON pegawais.id = users.id_pegawai
            //     JOIN jabatans ON jabatans.id  = pegawais.id_jabatan
            //     JOIN cabangs ON cabangs.id = pegawais.id_cabang
            //     JOIN golongans ON pegawais.status = pegawais.status");
            $data = DB::select("SELECT * FROM `users`
                JOIN pegawais ON pegawais.id = users.id_pegawai
                JOIN jabatans ON jabatans.id  = pegawais.id_jabatan
                JOIN cabangs ON cabangs.id = pegawais.id_cabang
                JOIN golongans ON pegawais.status = pegawais.status
                WHERE users.id_pegawai = '$id'");
            // dd($data);
            // dd(Auth::user());
            return view('pegawai.index', [
                'data' => $data
            ]);
        } elseif (Auth::user()->role == 'owner') {
            $jabatan = Jabatan::count();
            $golongan = Golongan::count();
            $pegawai = Pegawai::count();
            $tahun_baru = 'Tidak ada data';


            $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();
            $bulan = Perhitungan::select('bulan')->groupBy('bulan')->get();
            foreach ($tahun as $item) {
                if ($item->tahun == false) {
                    $tahun_baru = 'Tidak ada data';
                } else {
                    $tahun_baru = $item->tahun;
                }
            }

            // dd($tahun);

            $data = Perhitungan::orderBy('omzet', 'desc')
                ->where(
                    'tahun',
                    $tahun_baru
                )
                ->get();

            $data_tahun = DB::select("SELECT SUM(omzet) as 'omzet', tahun FROM `perhitungans` GROUP BY tahun ORDER BY omzet DESC");
            $datas = [null, null, null, null, null, null, null, null, null, null, null, null];


            for ($i = 0; $i < count($datas); $i++) {
                if ($datas[$i] === null) {
                    $datas[$i] = 0;
                }
            }

            foreach ($data as $item) {

                if ($item->bulan == 1) {
                    $datas[0] = (int) $item->bulan;
                } else if ($item->bulan == 2) {
                    $datas[1] = (int) $item->omzet;
                } else if ($item->bulan == 3) {
                    $datas[2] = (int) $item->omzet;
                } else if ($item->bulan == 4) {
                    $datas[3] = (int) $item->omzet;
                } else if ($item->bulan == 5) {
                    $datas[4] = (int) $item->omzet;
                } else if ($item->bulan == 6) {
                    $datas[5] = (int) $item->omzet;
                } else if ($item->bulan == 7) {
                    $datas[6] = (int) $item->omzet;
                } else if ($item->bulan == 8) {
                    $datas[7] = (int) $item->omzet;
                } else if ($item->bulan == 9) {
                    $datas[8] = (int) $item->omzet;
                } else if ($item->bulan == 10) {
                    $datas[9] = (int) $item->omzet;
                } else if ($item->bulan == 11) {
                    $datas[10] = (int) $item->omzet;
                } else if ($item->bulan == 12) {
                    $datas[11] = (int) $item->omzet;
                }
            }

            $b = [];
            foreach ($data as $item) {
                $x['bulan'] = $item->bulan;

                array_push($b, $item->bulan);
            }

            $c = [];
            foreach ($data_tahun as $item) {
                $x['tahun'] = $item->tahun;

                array_push($c, $item->tahun);
            }

            $d = [];
            foreach ($data_tahun as $item) {
                $x['omzet'] = (int) $item->omzet;
                $v = $x['omzet'];
                array_push($d, $v);
            }

            return view('owner.index', [
                'jabatan' => $jabatan,
                'golongan' => $golongan,
                'tahun_pilih' => $tahun_baru,
                'pegawai' => $pegawai,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'b' => $b,
                'c' => $c,
                'd' => $d,
                'datas' => $datas
            ]);
        }
    }

    public function chartByYear(Request $request)
    {
        // $jabatan = Jabatan::count();
        $golongan = Golongan::count();
        $pegawai = Pegawai::count();

        $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();
        $bulan = Perhitungan::select('bulan')->groupBy('bulan')->get();

        // if (empty($tahun)) {
        //     $tahun_baru = 'Tidak ada data';
        // }

        // foreach ($tahun as $item) {
        //     if ($item->tahun) {
        //         $tahun_baru = $item->tahun;
        //     }
        // }

        // if ($tahun_baru == false) {
        //     $data1 = DB::select("SELECT cabangs.nama_cabang, perhitungans.bulan,
        //                     (CASE
        //                         WHEN COUNT(*) > 1 THEN sum(perhitungans.omzet)
        //                         ELSE perhitungans.omzet
        //                     END) AS omzet
        //                     FROM perhitungans
        //                     JOIN pegawais ON perhitungans.id_pegawai = pegawais.id
        //                     JOIN cabangs ON cabangs.id = pegawais.id_cabang
        //                     WHERE cabangs.id = 2
        //                     GROUP BY perhitungans.bulan
        //                     ORDER BY perhitungans.bulan DESC");
        // } else {
        //     // $data = DB::select("SELECT cabangs.nama_cabang, perhitungans.bulan,
        //     //             (CASE
        //     //                 WHEN COUNT(*) > 1 THEN sum(perhitungans.omzet)
        //     //                 ELSE perhitungans.omzet
        //     //             END) AS omzet
        //     //             FROM perhitungans
        //     //             JOIN pegawais ON perhitungans.id_pegawai = pegawais.id
        //     //             JOIN cabangs ON cabangs.id = pegawais.id_cabang
        //     //             WHERE cabangs.id = 2 OR perhitungans.tahun = '$tahun_baru'
        //     //             GROUP BY perhitungans.bulan
        //     //             ORDER BY perhitungans.bulan DESC");
        // }

        $tahun_baru = $request->tahun;
        // dd($request->all());
        $data1 = DB::table('perhitungans')
            ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
            ->join('cabangs', 'cabangs.id', '=', 'pegawais.id_cabang')
            ->where('cabangs.id', 1)
            ->where('perhitungans.tahun', '=', $tahun_baru)
            ->groupBy('perhitungans.bulan')
            ->orderBy('perhitungans.bulan', 'DESC')
            ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('CASE WHEN COUNT(*) > 1 THEN SUM(perhitungans.omzet) ELSE perhitungans.omzet END AS omzet'))
            ->get();

        $data2 = DB::table('perhitungans')
            ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
            ->join('cabangs', 'cabangs.id', '=', 'pegawais.id_cabang')
            ->where('cabangs.id', 2)
            ->where('perhitungans.tahun', '=', $tahun_baru)
            ->groupBy('perhitungans.bulan')
            ->orderBy('perhitungans.bulan', 'DESC')
            ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('CASE WHEN COUNT(*) > 1 THEN SUM(perhitungans.omzet) ELSE perhitungans.omzet END AS omzet'))
            ->get();
        $data3 = DB::table('perhitungans')
            ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
            ->join('cabangs', 'cabangs.id', '=', 'pegawais.id_cabang')
            ->where('cabangs.id', 3)
            ->where('perhitungans.tahun', '=', $tahun_baru)
            ->groupBy('perhitungans.bulan')
            ->orderBy('perhitungans.bulan', 'DESC')
            ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('CASE WHEN COUNT(*) > 1 THEN SUM(perhitungans.omzet) ELSE perhitungans.omzet END AS omzet'))
            ->get();
        $data4 = DB::table('perhitungans')
            ->join('pegawais', 'perhitungans.id_pegawai', '=', 'pegawais.id')
            ->join('cabangs', 'cabangs.id', '=', 'pegawais.id_cabang')
            ->where('cabangs.id', 4)
            ->where('perhitungans.tahun', '=', $tahun_baru)
            ->groupBy('perhitungans.bulan')
            ->orderBy('perhitungans.bulan', 'DESC')
            ->select('cabangs.nama_cabang', 'perhitungans.bulan', DB::raw('CASE WHEN COUNT(*) > 1 THEN SUM(perhitungans.omzet) ELSE perhitungans.omzet END AS omzet'))
            ->get();
        // dd($data1);
        // $data_tahun = DB::select("SELECT SUM(omzet) as 'omzet', tahun FROM `perhitungans` GROUP BY tahun ORDER BY omzet DESC");
        $data_tahun =
            DB::table('perhitungans')
            ->selectRaw('SUM(omzet) as omzet, tahun')
            ->groupBy('tahun')
            ->orderByDesc('omzet')
            ->get();

        $datas1 = [null, null, null, null, null, null, null, null, null, null, null, null];
        $datas2 = [null, null, null, null, null, null, null, null, null, null, null, null];
        $datas3 = [null, null, null, null, null, null, null, null, null, null, null, null];
        $datas4 = [null, null, null, null, null, null, null, null, null, null, null, null];

        for ($i = 0; $i < count($datas1); $i++) {
            if ($datas1[$i] === null) {
                $datas1[$i] = 0;
            }
        }
        for ($i = 0; $i < count($datas2); $i++) {
            if ($datas2[$i] === null) {
                $datas2[$i] = 0;
            }
        }
        for ($i = 0; $i < count($datas3); $i++) {
            if ($datas3[$i] === null) {
                $datas3[$i] = 0;
            }
        }
        for ($i = 0; $i < count($datas4); $i++) {
            if ($datas4[$i] === null) {
                $datas4[$i] = 0;
            }
        }

        // dd($data);




        foreach ($data1 as $item) {

            if ($item->bulan == 1) {
                $datas1[0] = (int) $item->bulan;
            } else if ($item->bulan == 2) {
                $datas1[1] = (int) $item->omzet;
            } else if ($item->bulan == 3) {
                $datas1[2] = (int) $item->omzet;
            } else if ($item->bulan == 4) {
                $datas1[3] = (int) $item->omzet;
            } else if ($item->bulan == 5) {
                $datas1[4] = (int) $item->omzet;
            } else if ($item->bulan == 6) {
                $datas1[5] = (int) $item->omzet;
            } else if ($item->bulan == 7) {
                $datas1[6] = (int) $item->omzet;
            } else if ($item->bulan == 8) {
                $datas1[7] = (int) $item->omzet;
            } else if ($item->bulan == 9) {
                $datas1[8] = (int) $item->omzet;
            } else if ($item->bulan == 10) {
                $datas1[9] = (int) $item->omzet;
            } else if ($item->bulan == 11) {
                $datas1[10] = (int) $item->omzet;
            } else if ($item->bulan == 12) {
                $datas1[11] = (int) $item->omzet;
            }
        }
        foreach ($data2 as $item) {

            if ($item->bulan == 1) {
                $datas2[0] = (int) $item->bulan;
            } else if ($item->bulan == 2) {
                $datas2[1] = (int) $item->omzet;
            } else if ($item->bulan == 3) {
                $datas2[2] = (int) $item->omzet;
            } else if ($item->bulan == 4) {
                $datas2[3] = (int) $item->omzet;
            } else if ($item->bulan == 5) {
                $datas2[4] = (int) $item->omzet;
            } else if ($item->bulan == 6) {
                $datas2[5] = (int) $item->omzet;
            } else if ($item->bulan == 7) {
                $datas2[6] = (int) $item->omzet;
            } else if ($item->bulan == 8) {
                $datas2[7] = (int) $item->omzet;
            } else if ($item->bulan == 9) {
                $datas2[8] = (int) $item->omzet;
            } else if ($item->bulan == 10) {
                $datas2[9] = (int) $item->omzet;
            } else if ($item->bulan == 11) {
                $datas2[10] = (int) $item->omzet;
            } else if ($item->bulan == 12) {
                $datas2[11] = (int) $item->omzet;
            }
        }
        foreach ($data3 as $item) {

            if ($item->bulan == 1) {
                $datas3[0] = (int) $item->bulan;
            } else if ($item->bulan == 2) {
                $datas3[1] = (int) $item->omzet;
            } else if ($item->bulan == 3) {
                $datas3[2] = (int) $item->omzet;
            } else if ($item->bulan == 4) {
                $datas3[3] = (int) $item->omzet;
            } else if ($item->bulan == 5) {
                $datas3[4] = (int) $item->omzet;
            } else if ($item->bulan == 6) {
                $datas3[5] = (int) $item->omzet;
            } else if ($item->bulan == 7) {
                $datas3[6] = (int) $item->omzet;
            } else if ($item->bulan == 8) {
                $datas3[7] = (int) $item->omzet;
            } else if ($item->bulan == 9) {
                $datas3[8] = (int) $item->omzet;
            } else if ($item->bulan == 10) {
                $datas3[9] = (int) $item->omzet;
            } else if ($item->bulan == 11) {
                $datas3[10] = (int) $item->omzet;
            } else if ($item->bulan == 12) {
                $datas3[11] = (int) $item->omzet;
            }
        }
        foreach ($data4 as $item) {

            if ($item->bulan == 1) {
                $datas4[0] = (int) $item->bulan;
            } else if ($item->bulan == 2) {
                $datas4[1] = (int) $item->omzet;
            } else if ($item->bulan == 3) {
                $datas4[2] = (int) $item->omzet;
            } else if ($item->bulan == 4) {
                $datas4[3] = (int) $item->omzet;
            } else if ($item->bulan == 5) {
                $datas4[4] = (int) $item->omzet;
            } else if ($item->bulan == 6) {
                $datas4[5] = (int) $item->omzet;
            } else if ($item->bulan == 7) {
                $datas4[6] = (int) $item->omzet;
            } else if ($item->bulan == 8) {
                $datas4[7] = (int) $item->omzet;
            } else if ($item->bulan == 9) {
                $datas4[8] = (int) $item->omzet;
            } else if ($item->bulan == 10) {
                $datas4[9] = (int) $item->omzet;
            } else if ($item->bulan == 11) {
                $datas4[10] = (int) $item->omzet;
            } else if ($item->bulan == 12) {
                $datas4[11] = (int) $item->omzet;
            }
        }




        // $b = [];
        // foreach ($data as $item) {
        //     $x['bulan'] = $item->bulan;

        //     array_push($b, $item->bulan);
        // }

        // $c = [];
        // foreach ($data_tahun as $item) {
        //     $x['tahun'] = $item->tahun;

        //     array_push($c, $item->tahun);
        // }

        // $d = [];
        // foreach ($data_tahun as $item) {
        //     $x['omzet'] = (int) $item->omzet;
        //     $v = $x['omzet'];
        //     array_push($d, $v);
        // }

        $cc = [];
        $b1 = collect($data1)->pluck('bulan')->toArray();
        $b2 = collect($data2)->pluck('bulan')->toArray();
        $b3 = collect($data3)->pluck('bulan')->toArray();
        $b4 = collect($data4)->pluck('bulan')->toArray();
        $nama1 = collect($data1)->pluck('nama_cabang')->toArray();
        $nama2 = collect($data2)->pluck('nama_cabang')->toArray();
        $nama3 = collect($data3)->pluck('nama_cabang')->toArray();
        $nama4 = collect($data4)->pluck('nama_cabang')->toArray();
        array_push($cc, $b1, $b2, $b3, $b4);
        $c = collect($data_tahun)->pluck('tahun')->toArray();
        $d = collect($data_tahun)->pluck('omzet')->map(fn ($item) => (int) $item)->toArray();

        // dd($nama1, $nama2, $nama3, $nama4);



        return view('admin.index', [
            'tahun_pilih' => $tahun_baru,
            'golongan' => $golongan,
            'pegawai' => $pegawai,
            'tahun' => $tahun,
            'bulan' => $bulan,
            'b1' => $b1,
            'b2' => $b2,
            'b3' => $b3,
            'b4' => $b4,
            'nama1' => $nama1,
            'nama2' => $nama2,
            'nama3' => $nama3,
            'nama4' => $nama4,
            'c' => $c,
            'd' => $d,
            'datas1' => $datas1,
            'datas2' => $datas2,
            'datas3' => $datas3,
            'datas4' => $datas4
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


        return redirect()->back();
    }
}
