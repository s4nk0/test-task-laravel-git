<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    public function receipt(){
        return $this -> hasMany('App\Models\Receipt', 'user_id','id');
    }

    public function prize(){
        if ($this->receipt()->pluck('prize')[0] == 1){
            return 'Призовой';
        } else{
            return 'Обычный';
        }
    }

    public function code(){
        if ($this->status() =='Принят' && $this->participatesStatus() !== ' - Не учавствует на этой неделе') {

            if ($this->receipt()->pluck('code')[0] == null) {
                return '';
            } else {
                return ' - Ваш код: ' . $this->receipt()->pluck('code')[0];
            }
        } else{
            if ($this->status() !=='Принят'){
                return '';
            } else {
                $this->participatesStatus();
            }
        }
    }

    public function participatesStatus(){
        if ($this->receipt()->get()[0]['created_at']->format('d.m.Y') <= date('d.m.Y',strtotime("-7 day",strtotime(date('d.m.y'))))){
            return ' - Не учавствует на этой неделе';
        } else{
            return '';
        }
    }

    public function status(){
        if ($this->receipt()->pluck('status')[0] == 1){
            return 'Принят';
        } else{
            return 'Отклонен';
        }
    }



    protected $fillable = [
        'name',
        'email',
        'password',
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
}
