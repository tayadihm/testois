<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use App\Mahasiswa;
use Illuminate\Http\Request;
use App\Services\SendResponse;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginCard()
    {
        try {
          $req = request()->all();
          $log = Mahasiswa::where('no_kartu', '=', $req['no_kartu'])->first();

          if(!$log) {
            return SendResponse::fail('No Kartu tidak ditemukan', 401);
          } 

            $data['id'] = $log['id'];
            $data['nama_mhs'] = $log['nama_mhs'];
            $data['no_kartu'] = $log['no_kartu'];
            $data['nim'] = $log['nim'];
            $data['jurusan'] = $log['jurusan'];
            $data['saldo'] = $log['saldo'];
            $data['token'] =  $log->createToken('nApp')->accessToken;
            return SendResponse::success($data,200);
          
        } catch (\Exception $e) {
          return SendResponse::fail($e->getMessage(), 500);
        }
    }

    public function login()
    {
        try{
          if(!request()->email || !request()->password){
            return SendResponse::fail('Email and password column must be filled',400);
          }
          $req = request()->all();
          $user = Mahasiswa::where('email', '=', $req['email'])->first();
  
          //check email in users table
            if (!$user) {
              return SendResponse::fail('Email not found',400);
          }elseif($user->login_status == 1){
              return SendResponse::fail('Already login on another device',400);
          }
          if(Auth::attempt([
            'email' => $req['email'],
            'password' => $req['password'],
          ])){
            $data['id'] = $user['id'];
            $data['nama_mhs'] = $user['nama_mhs'];
            $data['email'] = $user['email'];
            $data['token'] =  $user->createToken('nApp')->accessToken;
            dd($data);
            return SendResponse::success($data,200);
          }else{
            return SendResponse::fail('Email or Password wrong',401);
          }
        }
        catch (\Exception $e) 
        {
          return SendResponse::fail($e->getMessage(), 500);
        }
    }
}
