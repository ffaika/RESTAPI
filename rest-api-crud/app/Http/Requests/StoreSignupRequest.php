<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSignupRequest extends FormRequest{
    public function rules(){
        return [
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
            "confirm_password" => "required|same:password",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
        ];
    }
}
