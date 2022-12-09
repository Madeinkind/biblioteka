<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
	/**
	 * Связанная с моделью таблица.
	 *
	 * @var string
	 */
	protected $table = 'sessions';
  
	/**
	 * Определяет необходимость отметок времени для модели.
	 *
	 * @var bool
	 */
	public $timestamps = false;
  
	/**
	 * Формат хранения отметок времени модели.
	 *
	 * @var string
	 */
	//protected $dateFormat = 'U';
  
	//const CREATED_AT = 'creation_date';
	//const UPDATED_AT = 'last_update';
  
	/*protected function getDateFormat()
	{
		return 'U';
	}*/
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'ssid',
		'expired',
		'ugmtime_add',
		'ugmtime_change',
	];
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}