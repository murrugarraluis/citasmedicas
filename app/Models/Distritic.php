<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distritic extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'provincie_id',
        'name'
    ];
    public function provincie(){
        return $this->belongsTo(Provincie::class);
    }
    public function hospitals(){
        return $this->hasMany(Hospital::class);
    }
		public function getCodeAttribute()
		{
			if (strlen($this->id < 100000)) {
				return "0".$this->id;
			}
			else{
				return $this->id;
			}
		}
}
