<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSongsRequest extends FormRequest{
    public function rules(){
            return [
              "title" => "required|string|max:255",
                "artist" => "required|string|max:255",
                "album_Id" => "required|string|max:255",
            ];
    }
}
