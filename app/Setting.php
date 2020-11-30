<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'setting';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'key',
        'value',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
	
	public function getDateFormat()
	{
		return 'U';
	}
}