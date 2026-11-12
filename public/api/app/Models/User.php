<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];
	
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
	];
	
	/**
     * Получение ролей пользователя по его id
     */
    public static function getRoles($user_id)
	{
		$arr = DB::table('user_role_users as uru')
			->leftJoin('user_roles as ur', 'ur.id', '=', 'uru.role_id')
			->select('uru.role_id', 'ur.api_name', 'ur.name')
			->where('user_id', '=', $user_id)
			->get();
		return $arr;
	}
}
