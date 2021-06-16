<?php

namespace App\Services;

use Auth;
use App\User;
use App\Models\PemberianVitamin;

class ItemManager
{
    public static function insert(array $data, $model)
    {
        $input = $model::create($data);
        return $input;
    }

    public static function update(array $data, $id, $model)
    {
        $item = $model::where('id', $id)->update($data);
        return $item;
    }
}