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

    public function index()
    {
        if (Auth::user()->role == 'admin') {

            $jabatan = Jabatan::count();
            $golongan = Golongan::count();
            $pegawai = Pegawai::count();

            $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();
            $bulan = Perhitungan::select('bulan')->groupBy('bulan')->get();

            foreach ($tahun as $item) {
                if ($item->tahun == false) {
                    $tahun_baru = 'Tidak ada data';
                } else {
                    $tahun_baru = $item->tahun;
                }
            }

            if ($tahun_baru == false) {
                $data = DB::select("SELECT
                            bulan,
                            (CASE
                                WHEN COUNT(*) > 1 THEN sum(omzet)
                                ELSE omzet
                            END) AS omzet
                            FROM perhitungans
                            GROUP BY bulan
                            ORDER BY bulan DESC");
            } else {
                $data = DB::select("SELECT
                            bulan,
                            (CASE
                                WHEN COUNT(*) > 1 THEN sum(omzet)
                                ELSE omzet
                            END) AS omzet
                            FROM perhitungans
                            WHERE tahun = '$tahun_baru'
                            GROUP BY bulan
                            ORDER BY bulan DESC");
            }
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



            return view('admin.index', [
                'tahun_pilih' => $tahun_baru,
                'jabatan' => $jabatan,
                'golongan' => $golongan,
                'pegawai' => $pegawai,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'b' => $b,
                'c' => $c,
                'd' => $d,
                'datas' => $datas
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

            $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();
            $bulan = Perhitungan::select('bulan')->groupBy('bulan')->get();
            foreach ($tahun as $item) {
                if ($item->tahun == false) {
                    $tahun_baru = 'Tidak ada data';
                } else {
                    $tahun_baru = $item->tahun;
                }
            }

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
        $tahun = Perhitungan::select('tahun')->groupBy('tahun')->get();
        $data = DB::select("SELECT
                            bulan,
                            (CASE
                                WHEN COUNT(*) > 1 THEN sum(omzet)
                                ELSE omzet
                            END) AS omzet
                            FROM perhitungans
                            WHERE tahun = '$request->tahun'
                            GROUP BY bulan
                            ORDER BY bulan DESC");

        $data_tahun = DB::select("SELECT SUM(omzet) as 'omzet', tahun
                    FROM `perhitungans`
                    GROUP BY tahun
                    ORDER BY bulan DESC");

        $a = [null, null, null, null, null, null, null, null, null, null, null, null];

        for ($i = 0; $i < count($a); $i++) {
            if ($a[$i] === null) {
                $a[$i] = 0;
            }
        }

        foreach ($data as $item) {

            if ($item->bulan == 1) {
                $a[0] = (int) $item->bulan;
            } else if ($item->bulan == 2) {
                $a[1] = (int) $item->omzet;
            } else if ($item->bulan == 3) {
                $a[2] = (int) $item->omzet;
            } else if ($item->bulan == 4) {
                $a[3] = (int) $item->omzet;
            } else if ($item->bulan == 5) {
                $a[4] = (int) $item->omzet;
            } else if ($item->bulan == 6) {
                $a[5] = (int) $item->omzet;
            } else if ($item->bulan == 7) {
                $a[6] = (int) $item->omzet;
            } else if ($item->bulan == 8) {
                $a[7] = (int) $item->omzet;
            } else if ($item->bulan == 9) {
                $a[8] = (int) $item->omzet;
            } else if ($item->bulan == 10) {
                $a[9] = (int) $item->omzet;
            } else if ($item->bulan == 11) {
                $a[10] = (int) $item->omzet;
            } else if ($item->bulan == 12) {
                $a[11] = (int) $item->omzet;
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
            'datas' => $a,
            'b' => $b,
            'data' => $data,
            'tahun_pilih' => $request->tahun,
            'tahun' => $tahun,
            'c' => $c,
            'd' => $d,
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
