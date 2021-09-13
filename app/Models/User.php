<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Information;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'users';
    protected $fillable = [
      'id', 'username','password', 'id_class', 'role' , 'fullname', 'birth_date','address','hobby','gender',
       'user_code' 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relationship
    public function point(){
        return $this->hasMany(Point::class, 'id_user');
    }
    public function subject(){
        return $this->belongsToMany(Subject::class, 'point', 'id_user', 'id_subject');
    }
    public function classroom(){
        return $this->hasOne(ClassRoom::class, 'id');
    }
      
 
}