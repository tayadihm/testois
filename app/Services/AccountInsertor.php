<?php

namespace App\Services;

use App\User;
use App\Mahasiswa;
use App\Services\TimeFilter;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AccountInsertor
{
    public static function insert($request, $role, $model){
        $data = $request->all();

        //add default fields
        $data = self::addDefaultFields($data);

        //add user credentials
        $cred = self::userCredentials($data);

        //split account information detail
        $role_acc = $request->except( 'nim', 'nama_mhs', 'email', 'password');

        //check if $role_acc is array or not? if not, convert to array
        // is_array($role_acc) ? $role_acc = $role_acc : $role_acc = $role_acc->toArray();

        //create data in relation table
        // $role_tabel = self::roleAccount($role_acc, $model);
        // $cred['userable_id'] = $role_tabel->id;
        // $cred['userable_type'] = $model;

        //create user account
        $user = User::create($cred);
        // $user->attachRole($role);
        
        return $user;
    }

    public static function roleAccount(array $data, $model){
        //insert user detail data berdasar role & tabel masing-masing
        $acc = $model::create($data);

        return $acc;
    }

    
    private static function userCredentials(array $cred){
        //array to create user
        $user = [
            'nim' => $cred['nim'],
            'nama_mhs' => $cred['nama_mhs'],
            'email' => $cred['email'],   
            'password' => Hash::make($cred['password']),
            'created_at' => $cred['created_at'],
            'updated_at' => $cred['updated_at']
        ];

        return $user;
    }

    private static function addDefaultFields(array $data){
        //array to create user
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        if(!array_key_exists('provider', $data)){
            $data['provider'] = 'default';
            $data['provider_id'] = NULL;
        }

        return $data;
    }

    public static function update(array $data,$id){
        $user = User::find($id);

        //update table user
        $user->name = $data['name'];
        $user->phone = $data['phone'];
        $user->save();

        //update relation table
        $role_acc = $user->userable_type::find($user->userable_id)->update($data);
    }

}