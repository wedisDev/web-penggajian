<?php

namespace App\Http\Controllers;

use App\Models\BonusOmzet;
use App\Models\Cabang;
use App\Models\Jabatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BonusOmzetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonus = DB::table('bonus_omzets')
            ->select('bonus_omzets.id as id', 'bonus_omzets.id_cabang as id_cabang', 'bonus_omzets.bonus', 'cabangs.nama_cabang as nama_cabang', 'cabangs.alamat')
            ->join('cabangs', 'cabangs.id', '=', 'bonus_omzets.id_cabang')
            ->get();
        $cabang = Cabang::all();
        return view('owner.bonusOmzet.index', [
            'bonus' => $bonus,
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
        $validator = Validator::make(request()->all(), [
            // 'id_jabatan' => 'required',
            'id_cabang' => 'required',
            'bonus' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {

            Alert::success('Success', 'Bonus Omzet berhasil ditambahkan');

            $bonus = new BonusOmzet();

            $bonus->id_jabatan = $request->get('id_jabatan');
            $bonus->id_cabang = $request->get('id_cabang');
            $bonus->bonus = $request->get('bonus');
            $bonus->save();

            return redirect()->back();
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
            'id_cabang' => 'required',
            'bonus' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {


            $bonus = BonusOmzet::findOrFail($id);
            $bonus->id_cabang = $request->get('id_cabang');
            $bonus->bonus = $request->get('bonus');
            $bonus->save();
            Alert::success('Success', 'Bonus Omzet berhasil diubah');
            // dd($bonus->save());

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
        $bonus = BonusOmzet::findOrFail($id);
        $bonus->delete();

        return redirect()->back();
    }
}
