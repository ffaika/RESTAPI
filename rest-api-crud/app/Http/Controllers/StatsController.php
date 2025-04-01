<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller{
    public function index(Request $request){
        $request->validate([
            'type' => 'required|in:artists,albums,songs,playing_time',
            'user_id' => 'sometimes|integer|exists:users,id',
            'from' => 'sometimes|date',
            'to' => 'sometimes|date'
        ]);
        $type = $request->type;
        $query = DB::table("listening_logs");

        if ($request->user_id) $query->where('user_id', $request->user_id);
        if ($request->from) $query->where('listened_at', '>=', $request->from);
        if ($request->to) $query->where('listened_at', '<=', $request->to);

        $stats = match ($type) {
            'artists' => $this->getTopArtists($query),
            'albums' => $this->getTopAlbums($query),
            'songs' => $this->getTopSongs($query),
            'playing_time' => $this->getPlayingTime($query)
        };
        return response()->json(['stats' => $stats]);
    }
    private function getTopArtists($query)
    {
        return $query->join('songs','listening_logs.song_id','=','songs.id')
            ->select('songs.artist',DB::raw('SUM(listening_logs.duration) as time'))
            ->groupBy('songs.artist')
            ->orderBy('time', 'desc')
            ->limit(3)
            ->get();
    }
    private function getTopAlbums($query){
        return $query->join('albums','song.album_id','=','albums.id')
            ->select('albums.title','albums.artist',DB::raw('SUM(listening_logs.duration) as time'))
            ->groupBy('albums.id','albums.title','albums.artist')
            ->orderBy('time', 'desc')
            ->limit(3)
            ->get();
    }
    private function getTopSongs($query){
        return $query->join('songs','listening_logs.song.id','=','song_id')
            ->select('songs.title','songs.artist',DB::raw('SUM(listening_logs.duration) as time'))
            ->groupBy('songs.id','songs.title','songs.artist')
            ->orderBy('time', 'desc')
            ->limit(3)
            ->get();
    }

    private function getPlayingTime($query){
        return $query->sum('duration');
    }
}

