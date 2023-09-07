<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /* Get song data */
        $data['songs'] = [];
        if ($request->has('search')) {
            $data['songs'] = Song::where(function($query) use ($request) {
                return $query->where('song_name', 'LIKE', '%'.$request->search.'%')->orWhere('artist_name', 'LIKE', '%'.$request->search.'%');
            })->get();
        }else {
            $data['songs'] = Song::all();
        }
        return response([
            'data' => $data,
            'message' => 'List Songs'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
