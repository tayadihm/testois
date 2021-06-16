<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Services\SendResponse;
use Validator;
use App\Mahasiswa;
use App\User;
use Auth;
use DB;

class APIController extends Controller
{

    public function showUser()
    {
        try {
            $data = User::find(Auth::user()->id);
            return SendResponse::success($data, 200);
        }catch (\Exception $e) {
            return SendResponse::fail('Gagal, Karena: '.$e->getMessage(), 400);
        }
    }

    public function showMhs() {
        try {
            $data = Mahasiswa::where('no_kartu', Auth::User()->no_kartu)->get();

            return SendResponse::success($data, 200);
        }
        catch (\Exeception $e) {
            return SendResponse::fail($e->getMessage());
        }

    }

    public function detailMhs($no_kartu)
    {
        try {
            $data = Mahasiswa::where('no_kartu', Auth::User()->no_kartu)->get();

            return SendResponse::success($data, 200);
        }
        catch (\Exeception $e) {
            return SendResponse::fail($e->getMessage());
        }
    }

    public function riwayatParkir() {
        try {
            $data = DB::table('dataparkirs')->where('no_kartu', Auth::User()->no_kartu)->get();
            $status = DB::table('parkirs')
            ->select('parkirs.status')
            ->where('no_kartu', Auth::User()->no_kartu)
            ->get();

            return response()->json(['error'=>false,'Data'=>$data, 'Status Kendaraan'=>$status], 200);

        } catch (\Exception $e) {
            return SendResponse::fails($e->getMessage());
        }
    }

    public function riwayatKantin() {
        try {
            $data = DB::table('kantins')->where('no_kartu', Auth::User()->no_kartu)->get();

            return SendResponse::success($data, 200);

        } catch (\Exception $e) {
            return SendResponse::fails($e->getMessage());
        }
    }

    public function cekStatusKendaraan() {
        try {
            $data = DB::table('parkirs')->where('no_kartu', Auth::User()->no_kartu)->get();

            return SendResponse::success($data, 200);

        } catch (\Exception $e) {
            return SendResponse::fails($e->getMessage());
        }
    }

}
