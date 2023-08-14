<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilai = Nilai::all();
        return response()->json([
            'data' => $nilai,
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
        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required',
            'nama_matapelajaran' => 'required',
            'nilai_latihansoal1' => 'required',
            'nilai_latihansoal2' => 'required',
            'nilai_latihansoal3' => 'required',
            'nilai_latihansoal4' => 'required',
            'nilai_ulanganharian1' => 'required',
            'nilai_ulanganharian2' => 'required',
            'nilai_ulangan_tengah_semester' => 'required',
            'nilai_ulangan_semester' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = request()->all();
        $nilai = Nilai::create([
            'nama_siswa' => $input['nama_siswa'],
            'nama_matapelajaran' => $input['nama_matapelajaran'],
            'nilai_latihansoal1' => $input['nilai_latihansoal1'],
            'nilai_latihansoal2' => $input['nilai_latihansoal2'],
            'nilai_latihansoal3' => $input['nilai_latihansoal3'],
            'nilai_latihansoal4' => $input['nilai_latihansoal4'],
            'nilai_ulanganharian1' => $input['nilai_ulanganharian1'],
            'nilai_ulanganharian2' => $input['nilai_ulanganharian2'],
            'nilai_ulangan_tengah_semester' => $input['nilai_ulangan_tengah_semester'],
            'nilai_ulangan_semester' => $input['nilai_ulangan_semester'],
            'nilai_akhir' => (((15 / 100) * (($input['nilai_latihansoal1'] + $input['nilai_latihansoal2'] + $input['nilai_latihansoal3'] + $input['nilai_latihansoal4']) / 4)) + ((20 / 100) * (($input['nilai_ulanganharian1'] + $input['nilai_ulanganharian2']) / 2)) + ((25 / 100) * ($input['nilai_ulangan_tengah_semester'])) + ((40 / 100) * ($input['nilai_ulangan_semester']))),
        ]);

        return response()->json([
            'data' => $nilai,
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
}
