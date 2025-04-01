<?php
namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Http\Requests\StorePlaylistRequest;
class PlaylistController extends Controller{
    public function index(){
        $playlists = Playlist::with('songs')->orderBy('created_at')->get();
        return response()->json(['playlists' => $playlists]);
    }
    public function store(StorePlaylistRequest $request){
        $playlist = Playlist::create($request->only(['title','author']));
        $playlist->songs()->attach($request->songs);
        return response()->json(['message' => 'Playlist added successfully'], 201);
    }
}
