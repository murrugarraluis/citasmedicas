<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincie extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'departament_id',
        'name'
    ];
    public function departament(){
        return $this->belongsTo(Departament::class);
    }
    public function distritics(){
        return $this->hasMany(Distritic::class);
    }
}
