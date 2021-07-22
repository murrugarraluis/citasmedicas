<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name'
    ];
    public function provincies(){
        return $this->hasMany(Provincie::class);
    }
}
