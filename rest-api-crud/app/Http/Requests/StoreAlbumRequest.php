<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlbumRequest extends FormRequest{
public function rules(){
    return [
        "title" => "required|string|max:255",
        "artist" => "required|string|max:255",
        "release_date" => "required|date",
    ];
}
}
