<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
		use SoftDeletes;
    protected $fillable = [
        'speciality',
        'phone'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function hospitals(){
        return $this->morphedByMany(Hospital::class,'assignable')->withTimestamps();
    }
    public function covidteams(){
        return $this->morphedByMany(CovidTeam::class,'assignable');
    }
    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
