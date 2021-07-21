<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ditrict',
        'provincie',
        'departament',
    ];
    public function covidteams()
    {
        return $this->hasMany(CovidTeam::class);
    }
    public function doctors(){
        return $this->morphToMany(Doctor::class,'assignable');
    }
}
