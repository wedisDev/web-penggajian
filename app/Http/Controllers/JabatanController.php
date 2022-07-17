<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = Jabatan::all();

        return view('owner.jabatan.index', [
            'jabatan' => $jabatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.jabatan.create');
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
            'nama_jabatan' => 'required',
            'gapok' => 'required',
            'tunjangan_makmur' => 'required',
            'tunjangan_transportasi' => 'required',
            'tunjangan_makan' => 'required',
            'tunjangan_lembur' => 'required'
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Success', 'Jabatan berhasil ditambahkan');

            $jabatan = new Jabatan();
            // dd($request);
            
            $jabatan->nama_jabatan = $request->get('nama_jabatan');
            $jabatan->gapok = $request->get('gapok');
            $jabatan->tunjangan_makmur = $request->get('tunjangan_makmur');
            $jabatan->tunjangan_transportasi = $request->get('tunjangan_transportasi');
            $jabatan->tunjangan_makan = $request->get('tunjangan_makan');
            $jabatan->tunjangan_lembur = $request->get('tunjangan_lembur');
            
            $jabatan->save();

            return redirect()->route('jabatan.index');
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
        $jabatan = Jabatan::find($id);
        return view('owner.jabatan.edit', [
            'jabatan' => $jabatan
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
            'nama_jabatan' => 'required',
            'gapok' => 'required',
            'tunjangan_makmur' => 'required',
            'tunjangan_transportasi' => 'required',
            'tunjangan_makan' => 'required',
            'tunjangan_lembur' => 'required'
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Success', 'Jabatan berhasil diubah');

            $jabatan = Jabatan::findOrFail($id);

            $jabatan->nama_jabatan = $request->get('nama_jabatan');
            $jabatan->gapok = $request->get('gapok');
            $jabatan->tunjangan_makmur = $request->get('tunjangan_makmur');
            $jabatan->tunjangan_transportasi = $request->get('tunjangan_transportasi');
            $jabatan->tunjangan_makan = $request->get('tunjangan_makan');
            $jabatan->tunjangan_lembur = $request->get('tunjangan_lembur');

            $jabatan->save();

            return redirect()->route('jabatan.index');
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
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->back();
    }
}
