<?php

namespace App\Http\Controllers;

use App\Models\Fakturmasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FakturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();

        $data = Fakturmasuk::with('user','barang','category','suplier','gudang')
                ->when(($auth && $auth->role_id!=1), function ($q) use ($auth){
                    return $q->where('user_id', $auth->id);
                })
                ->orderBy('id', 'DESC')
                ->get();

        return response()->json(['data' => $data]);
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
        $validator = Validator::make($request->all(), [
            'barang_id'     => 'required',
            'catbarang_id'  => 'required',
            'suplier_id'    => 'required',
            'gudang_id'     => 'required',
            'qty'           => 'required',
            'foto'          => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        if ($request->hasFile('foto')) {
            $name       = $request->file('foto')->getClientOriginalName();
            $filename   = pathinfo($name, PATHINFO_FILENAME);
            $ext        = $request->file('foto')->getClientOriginalExtension();
            $foto       = $filename.'_'.time().'.'.$ext;
            $path       = $request->file('foto')->move(public_path('/storage/faktur'),$foto);
        }else{
            $foto = null;
        }

        $auth = auth()->user();

        $data = Fakturmasuk::create([
            'user_id'       => $auth->id,
            'barang_id'     => $request->barang_id,
            'catbarang_id'  => $request->catbarang_id,
            'suplier_id'    => $request->suplier_id,
            'gudang_id'     => $request->gudang_id,
            'qty'           => $request->qty,
            'foto'          => $foto
        ]);

        return response()->json(['data' => $data, 'message' => 'Data Successfully']);
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
        //
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
    }
}
