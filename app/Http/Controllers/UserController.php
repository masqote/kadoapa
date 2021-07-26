<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'User atau password salah!'], 401);
        }
    }

    public function loginWeb(Request $req){
        $validator = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            $errorArr = json_decode($validator->errors());//$validator->messages();
            $errorStr ='';

            foreach ($errorArr as $item) {
                $errorStr .= '<div>'.$item[0].'</div>';
            }

            http_response_code(405);
            exit(json_encode(['error' => $errorStr]));
        }

        $email = $req->email;
        $password = $req->password;
        
        if (Auth::attempt(['email'=>$email, 'password' =>$password])) {
            return response()->json(['success' => 'User successfully signed in']);
        }else{
            return response()->json(['error'=>'User atau password salah!'], 401);
        }
    }


    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

}