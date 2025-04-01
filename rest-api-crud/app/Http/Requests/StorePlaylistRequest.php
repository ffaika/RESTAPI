<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaylistRequest extends FormRequest{
    public function rules(){
        return [
            "title" => "required|string|max:255",
            "author" => "required|string|max:255",
            "songs" => "required|array",
            "songs.*" =>"exists:songs,id",
        ];
    }
}
