<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Tag;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::all();
        if (!$tag) {
            $response = [
                'succes' => false,
                'data' => 'Data Kosong',
                'message' => 'Tag tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data' => $tag,
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
            'nama_tag' => 'required|unique:tags'
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

        $tag = new Tag();
        $tag->nama_tag = $request->nama_tag;
        $tag->slug = str_slug($request->nama_tag, '-');
        $tag->save();

        // 4.buat fungsi untuk menghendle semua inputan-> dimasukan ke table
        $tag = Tag::create($input);

        // 5. menampilkan response
        $response = [
            'success' => true,
            'data' => $tag,
            'message' => 'Tag berhasil ditambahkan.'
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
        return Tag::Find($id);
        if (!$tag) {
            $response = [
                'succes' => false,
                'data' => 'Empety',
                'message' => 'Tag tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'succes' => true,
            'data' => $tag,
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
        $tag = Tag::Find($id);
        $input = $request->all();

        if (!$tag) {
            $response = [
                'succes' => false,
                'data' => 'Empety',
                'message' => 'Tag tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $validator = Validator::make($input, [
            'nama_tag' => 'required|min:15'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error',
                'message' => $validator->errors()
            ];
            return response()->json($response, 500);
        }

        $tag->nama_tag = $input['nama_tag'];
        $tag->save();

        $response = [
            'success' => true,
            'data' => $tag,
            'message' => 'Tag berhasil diupdate.'
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
        $tag = Tag::Find($id);

        if (!$tag) {
            $response = [
                'succes' => false,
                'data' => 'Empety',
                'message' => 'Tag tidak ditemukan'
            ];
            return response()->json($response, 404);
        }

        $tag->delete();

        $response = [
            'success' => true,
            'data' => $tag,
            'message' => 'Tag berhasil di hapus.'
        ];

        return response()->json($response, 200);
    }
}
