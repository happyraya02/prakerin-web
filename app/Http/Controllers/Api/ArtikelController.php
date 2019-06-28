<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artikel;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::all();
        if (count($artikel) <= 0) {
            $response = [
                'succes' => false,
                'data' => 'Data Kosong',
                'message' => 'Artikel tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data' => $artikel,
            'message' => 'Berhasil'
        ];

        return response()->json($response, 200);
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
        // 1. tampung semua inputan ke $input
        $input = $request->all();

        // 2. buat validasi tampung ke $validator
        $validator = Validator::make($input, [
            'nama_kategori' => 'required|min:15'
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
        $artikel = Artikel::create($input);

        // 5. menampilkan response
        $response = [
            'success' => true,
            'data' => $artikel,
            'message' => 'Siswa berhasil ditambahkan.'
        ];

        // 6. tampilkan hasil
        return response()->json($response, 200);

        // 7. menampilkan error di heroku
        // heroku config:set APP_DEBUG=true
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artikel = Artikel::Find($id);
        if (!$artikel) {
            $response = [
                'succes' => false,
                'data' => 'Empety',
                'message' => 'siswa tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data' => $artikel,
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
        $artikel = Artikel::Find($id);
        $input = $request->all();

        if (!$artikel) {
            $response = [
                'succes' => false,
                'data' => 'Empety',
                'message' => 'siswa tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $validator = Validator::make($input, [
            'nama_kategori' => 'required|min:15'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error',
                'message' => $validator->errors()
            ];
            return response()->json($response, 500);
        }

        $artikel->nama_kategori = $input['nama_kategori'];
        $artikel->save();

        $response = [
            'success' => true,
            'data' => $artikel,
            'message' => 'Siswa berhasil diupdate.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = Artikel::Find($id);

        if (!$artikel) {
            $response = [
                'succes' => false,
                'data' => 'Empety',
                'message' => 'siswa tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $artikel->delete();

        $response = [
            'success' => true,
            'data' => $artikel,
            'message' => 'Siswa berhasil di hapus.'
        ];

        return response()->json($response, 200);
    }
}
