<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model{
    protected $fillable = ["title","author"];
    public function songs(){
        return $this -> belongsToMany(Song::class);
    }
}
