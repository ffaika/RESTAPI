<?php
namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
class SongController extends Controller{
    public function index(){
        $songs = Song::orderBy('title', 'asc')->get();
        return response()->json(['songs' => $songs]);
    }
    public function store(Request $request)
    {
        Song::create($request->validated());
        return response()->json(['message' => 'song added successfully',201]);
    }
    public function show($id){
        $song = Song::findOrFail($id);
        return response()->json(['song' => $song]);
    }
}
