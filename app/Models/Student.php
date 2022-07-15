<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['family_id', 'name', 'surname', 'registration_code'];

    public function family(){
        return $this->belongsTo(Family::class);
    }
}
