<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datakelas()
    {
        $kelas = Kelas::all();
        return response()->json([
            'data' => $kelas,
        ]);
    }

    public function index()
    {
        $kelas = Kelas::all();
        return Kelas::raw(function ($collection) {
            return $collection->aggregate(
                [[
                    '$lookup' => [
                        'as' => 'detail_kelas',
                        'from' => 'siswas',
                        'foreignField' => 'nama_kelas',
                        'localField' => 'nama_kelas'
                    ]
                ]]
            );
        });
        // return response()->json([
        //     'data' => ,
        // ]);
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
            'nama_kelas' => 'required',
            'keterangan' => 'required',
            'pembimbing' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = request()->all();

        $kelas = Kelas::create($input);

        return response()->json([
            'data' => $kelas,
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        return response()->json([
            'data' => $kelas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'keterangan' => 'required',
            'pembimbing' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = request()->all();

        Kelas::find($id)->update($input);

        return response()->json([
            'message' => 'data has updated !',
            'success' => true,
            'data' => Kelas::find($id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();

        return response()->json([
            'message' => 'Success Deleted !',
            'success' => true,
        ]);
    }
}
