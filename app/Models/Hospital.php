<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $fillable = [
		'distritic_id',
		'name',
	];
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function distritic()
	{
		return $this->belongsTo(Distritic::class);
	}
	public function covidteams()
	{
		return $this->hasMany(CovidTeam::class);
	}
	public function doctors()
	{
		return $this->morphToMany(Doctor::class, 'assignable')->withTimestamps();
	}

	public function getBossAttribute()
	{
		$name = $this->user->name;
		$lastname =  $this->user->lastname;
		return $name." ".$lastname;
	}
}
