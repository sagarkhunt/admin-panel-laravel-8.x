<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'password',
        'role_id',
        'profile_picture',
        'status',
        'device_id',
        'device_type',
        'device_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected  $appends = ['user_image_path'];

    public function getUserImagePathAttribute()
    {    
        return $this->profile_picture != null  ?  \URL::to('storage'.'/'.\Config::get('admin.image.user_image')).'/'. $this->profile_picture : Url('storage/default/logo-03.png'); 
        
    }
}
