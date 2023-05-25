<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Omzet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

use function GuzzleHttp\Promise\all;

class OmzetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $month = $date->month;
        $year = $date->year;
        $omzet = DB::table('cabangs as c')
            ->select('c.nama_cabang', DB::raw('MONTH(o.date) as date'), DB::raw('YEAR(o.date) as year'), 'o.omzet', 'c.id as id', 'o.id as id_omzet', 'o.id as id_omzet')
            ->join('omzet as o', 'o.id_cabang', '=', 'c.id')
            ->get();
        $create_omzet = Cabang::groupBy('nama_cabang')
            ->select('nama_cabang', 'id')
            ->get();

        return view('owner.omzet.index', compact('omzet', 'create_omzet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function buat_omzet($id, $bulan)
    {
        $omzet = DB::table('cabangs as c')
            ->select('o.omzet')
            ->join('omzet as o', 'o.id_cabang', '=', 'c.id')
            ->whereMonth('o.date', $bulan)
            ->where('c.id', $id)
            ->get();

        if (empty($omzet[0])) {
            return response([
                'data' => 'Data Not Found'
            ], 200);
        } else {
            return response([
                'data' => $omzet[0]
            ], 200);
        }
    }


    public function filter(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'date' => 'required'
            ]);

            if ($validator->fails()) {
                Alert::error('error input', $validator->messages()->all());
                return back();
            }

            $date_now = Carbon::today();
            $date_filter = Carbon::parse($request->date('date'))->format('d/m/Y');
            $date = Carbon::createFromFormat('d/m/Y',  $date_filter);
            $month = $date->month;
            $year = $date->year;
            if ($request->date > $date_now) {
                Alert::error('error filter', 'Tanggal melebihi hari ini');
                return back();
            }

            $omzet = DB::table('cabangs as c')
                ->select('c.nama_cabang', DB::raw('MONTH(o.date) as date'), 'o.omzet', 'c.id as id', 'o.id as id_omzet')
                ->join('omzet as o', 'o.id_cabang', '=', 'c.id')
                ->whereMonth('o.date', '=', $month)
                ->get();

            return view('owner.omzet.filter', compact('omzet'));
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_cabang' => 'required',
                'bulan' => 'required',
                'omzet' => 'required',
            ]);

            if ($validator->fails()) {
                Alert::error('Error', $validator->messages()->all());
                return back()->withInput();
            }
            $date_filter = Carbon::parse($request->date('bulan'))->format('d/m/Y');
            $date = Carbon::createFromFormat('d/m/Y',  $date_filter);

            $omzet = new Omzet();
            $omzet->id_cabang = $request->id_cabang;
            $omzet->omzet = $request->omzet;
            $omzet->date = $date;
            $omzet->save();
            Alert::success('Success', 'Omzet Successfully Created');
            return back();
        } catch (Exception $error) {
            dd($error->getMessage());
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
        $validator = Validator::make(request()->all(), [
            'id' => 'required',
            'omzet' => 'required',
            'id_omzet' => 'required'
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {

            $bonus = Omzet::findOrFail($request->id_omzet);
            $bonus->updated_at = Carbon::now();
            $bonus->omzet = $request->get('omzet');
            $bonus->save();
            Alert::success('Success', 'Omzet berhasil diubah');

            return redirect()->back();
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
        //
        $omzet = Omzet::findOrFail($id);
        $omzet->delete();
        Alert::success('Success', 'Omzet berhasil dihapus');
        return back();
    }
}
