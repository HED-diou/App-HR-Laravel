<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Http\Models;
use App\Models\Role;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'balance',
        'hiredate',
        'company_id',
        'manager',
        'birthdate',
        'cin',
        'cnss',
        'tel',
        'statut',
        'admin',
        'address',
        'password',
        'token',
        'Token_startD',
        'Token_endD'

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

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasRole($role)
    {
        $roles = $this->roles()->where('name', $role)->count();

        if($roles == 1){
            return true;
        }

        return false;
    }

    public function setPasswordAttribute($password)
    {
        if(trim($password) === ''){
            return;
        }

        $this->attributes['password'] = Hash::make($password);
    }
    /**
     * Get the name of  associated company with the user.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
