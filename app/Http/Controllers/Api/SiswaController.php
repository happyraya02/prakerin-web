<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\siswaa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswaa = siswaa::all();
        if (!$siswaa) {
            $response = [
                'succes' => false,
                'data' => 'Empety',
                'message' => 'siswa tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data' => $siswaa,
            'message' => 'Berhasil'
        ];

        return response()->json($response, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. tampung semua inputan ke $input
        $input = $request->all();

        // 2. buat validasi tampung ke $validator
        $validator = Validator::make($input, [
            'nama' => 'required|min:15'
        ]);

        // 3. cek validasi
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error',
                'message' => $validator->errors()
            ];
            return response()->json($response, 500);
        }

        // 4.buat fungsi untuk menghendle semua inputan-> dimasukan ke table
        $siswaa = siswaa::create($input);

        // 5. menampilkan response
        $response = [
            'success' => true,
            'data' => $siswaa,
            'message' => 'Siswa berhasil ditambahkan.'
        ];

        // 6. tampilkan hasil
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return siswaa::Find($id);
        if (!$siswaa) {
            $response = [
                'succes' => false,
                'data' => 'Empety',
                'message' => 'siswa tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'succes' => true,
            'data' => $siswaa,
            'message' => 'Berhasil'
        ];

        return response()->json($response, 200);
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
