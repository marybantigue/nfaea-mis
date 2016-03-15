<?php
namespace App;
use App\User;

class Helpers
{
    static function getProvince($id) {

        return User::find($id)->province()->first()->name;

    }
}