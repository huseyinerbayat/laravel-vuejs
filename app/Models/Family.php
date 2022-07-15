<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'surname', 'phone_number', 'address'];

    public function students(){
        return $this->hasMany(Student::class);
    }
}
