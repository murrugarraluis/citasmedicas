<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CovidTeam extends Model
{
    use HasFactory;
		use SoftDeletes;
    protected $fillable = [
        'name',
    ];
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function doctors(){
        return $this->morphToMany(Doctor::class,'assignable');
    }
}
