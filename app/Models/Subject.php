<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    public function subject_point(){
        return $this->hasOne(Point::class, 'id_subject');
    }
    protected $fillable = [
      'id', 'id_subject', 'id_user', 'point'  
    ];
  
    
}