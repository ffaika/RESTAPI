<?php
namespace App\Http\Controllers;

use App\Models\SignupRequest;
use App\Http\Requests\StoreSignupRequest;
class SignupController extends Controller{
    public function store(StoreSignupRequest $request){
        $signup = SignupRequest::create($request->validated() + ["status" => "pending"] );
        return response()->json(["messege" => 'Registration request added successfully'],201);
    }
    public function index(){
        $signups = SignupRequest::orderBy('created_at','DESC')->get();
        return response()->json(["signups"=>$signups]);
    }
    public function accept($id){
        $signup = SignupRequest::findOrFail($id);
        $signup->update(["status" => "accepted"]);
        return response()->json(["messege" => 'Registration request successfully accepted']);
    }
    public function reject($id){
        $signup = SignupRequest::findOrFail($id);
        $signup->update(["status" => "rejected"]);
        return response()->json(["messege" => 'Registration request successfully refused']);
    }

}
