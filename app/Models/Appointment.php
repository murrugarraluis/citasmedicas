<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'date',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function doctor()
	{
		return $this->belongsTo(Doctor::class);
	}

	public function hospital()
	{
		return $this->belongsTo(Hospital::class);
	}

	public function attentionsheet()
	{
		return $this->hasOne(AttentionSheet::class);
	}
}
