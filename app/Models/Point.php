<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $table = 'point';
    protected $fillabe = [
        'id','id_user', 'id_subject','point'
    ];
    public function user(){
       return $this->belongsTo(User::class, 'id_user');
    }
    public function point_sub(){
       return $this->belongsTo(Subject::class, 'id_subject');
    }
}