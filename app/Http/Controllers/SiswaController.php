<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Mongodb\Facades\Mongodb;
use MongoDB\BSON\ObjectId;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datasiswa()
    {
        $siswa = Siswa::all();
        return response()->json([
            'data' => $siswa,
        ]);
    }

    public function index()
    {
        //$siswa = Siswa::all();
        // return response()->json([
        //     'data' => $siswa,
        // ]);
        return Siswa::raw(function ($collection) {
            return $collection->aggregate(
                [[
                    '$lookup' => [
                        'from' => 'nilais',
                        'foreignField' => 'nama_siswa',
                        'localField' => 'nama_siswa',
                        'as' => 'info_nilai',
                    ]
                ]]
            );
        });
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
            'nama_siswa' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'nama_orangtua' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = request()->all();
        $siswa = Siswa::create($input);

        return response()->json([
            'data' => $siswa,
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'nama_siswa' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'nama_orangtua' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = request()->all();

        Siswa::find($id)->update($input);

        return response()->json([
            'message' => 'data has updated !',
            'success' => true,
            'data' => Siswa::find($id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return response()->json([
            'message' => 'Success Deleted !',
            'success' => true,
        ]);
    }
}
