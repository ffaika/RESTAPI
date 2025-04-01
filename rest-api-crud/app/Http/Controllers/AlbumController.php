<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;

class AlbumController extends Controller{
    public function index(){
        $albums = Album::with('songs')->orderBy('release_date', 'desc')->get();
        return response()->json($albums);
    }
    public function store(StoreAlbumRequest $request){
        Album::create($request->validated());
        return response()->json(['messege' => 'album created'],201);
    }
}
