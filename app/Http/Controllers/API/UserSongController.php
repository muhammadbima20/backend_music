<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSong;
use App\Models\Song;
use Laravel\Sanctum\PersonalAccessToken;

class UserSongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = $token->tokenable;

        $savedSong = UserSong::where('user_id', $user->id)->pluck('song_id')->toArray();
        $data['songs'] = Song::whereIn('id', $savedSong)->get();

        return response([
            'data' => $data,
            'message' => 'List Saved Songs'
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
        $params = $request->all();
        $token = PersonalAccessToken::findToken($request->bearerToken());

        $user = $token->tokenable;

        $savedSong = UserSong::where('user_id', $user->id)->where('song_id', $params['id'])->withTrashed()->first();

        $message = '';
        if (empty($savedSong)) {
            UserSong::create([
                'user_id' => $user->id,
                'song_id' => $params['id']
            ]);
            $message = 'This song added to saved song !';
        }else {
            if ($savedSong->trashed()) {
                $savedSong->restore();

                $message = 'This song is restored to your saved list !';
            }else {
                $message = 'This song already saved in your list !';
            }
        }

        return response([
            'message' => $message
        ], 200);
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
    public function destroy(Request $request)
    {
        $params = $request->all();
        $token = PersonalAccessToken::findToken($request->bearerToken());

        $user = $token->tokenable;

        $savedSong = UserSong::where('user_id', $user->id)->where('song_id', $params['id'])->first();
        $savedSong->delete();

        return response([
            'message' => 'Song has been removed from your saved list'
        ], 200);
    }
}
