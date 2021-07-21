<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttentionSheet extends Model
{
    use HasFactory;
    protected $fillable = [
        'description'
    ];
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
    public function medicalhistory(){
        return $this->belongsTo(MedicalHistory::class);
    }
}
