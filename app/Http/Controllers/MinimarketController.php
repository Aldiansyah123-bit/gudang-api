<?php

namespace App\Http\Controllers;

use App\Models\Minimarket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MinimarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Minimarket::all();
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
            'name'      => 'required',
            'location'  => 'required',
            'foto'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        if ($request->hasFile('foto')) {
            $name       = $request->file('foto')->getClientOriginalName();
            $filename   = pathinfo($name, PATHINFO_FILENAME);
            $ext        = $request->file('foto')->getClientOriginalExtension();
            $foto       = $filename.'_'.time().'.'.$ext;
            $path       = $request->file('foto')->move(public_path('/storage/minimarket'),$foto);
        }
        else{
            $foto = null;
        }

        $data = Minimarket::create([
            'name'      => $request->name,
            'location'  => $request->location,
            'foto'      => $foto,
        ]);

        return response()->json(['data' => $data]);
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
