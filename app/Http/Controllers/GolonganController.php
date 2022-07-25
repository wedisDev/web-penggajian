<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Golongan;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $golongan = Golongan::all();

        return view('owner.golongan.index', [
            'golongan' => $golongan 
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
            'status' => 'required',
            'tunjangan_menikah' => 'required',
            'tunjangan_anak' => 'required'
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {

            Alert::success('Success', 'Golongan berhasil ditambahkan');

            $golongan = new Golongan();

            $golongan->nama_golongan = $request->get('status');
            $golongan->tunjangan_menikah = $request->get('tunjangan_menikah');
            $golongan->tunjangan_anak = $request->get('tunjangan_anak');
            
            $golongan->save();

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
            'status' => 'required',
            'tunjangan_menikah' => 'required',
            'tunjangan_anak' => 'required'
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {

            Alert::success('Success', 'Golongan berhasil diubah');

            $golongan = Golongan::findOrFail($id);

            $golongan->nama_golongan = $request->get('status');
            $golongan->tunjangan_menikah = $request->get('tunjangan_menikah');
            $golongan->tunjangan_anak = $request->get('tunjangan_anak');
            
            $golongan->save();

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
        $golongan = Golongan::findOrFail($id);
        $golongan->delete();

        return redirect()->back();
    }
}
