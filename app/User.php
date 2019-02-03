<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class User extends Model
{
    protected $primaryKey = 'admin_id';
    public $incrementing = false;
    public $timestamps = false;

    public static function check() {
    	if (Session::has('user')) {
    		return true;
    	}

    	return false;
    }

    public static function user() {
    	$user = Session::get('user');
    	return $user;
    }

    public static function login($id) {
    	Session::put('user', $id);
    }

    public static function logout() {
    	Session::flush();
    }
}
