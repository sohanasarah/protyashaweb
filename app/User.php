<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'user_name';
    public $timestamps = false;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'user_fullname', 'user_role', 'user_pass', 'user_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_pass', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function getAuthPassword()
    {
      return $this->user_pass;
    }

      /**
   * Overrides the method to ignore the remember token.
   */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }

    public function isDepot(){
        if($this->user_role == "depot-in-charge"){
            return true;
        }
        else {
            return false;
        }
    }

    public function isDivision(){
        if($this->user_role == "divisional_manager"){
            return true;
        }
        else {
            return false;
        }
    }

    public function isMarketing(){
        if($this->user_role == "marketing"){
            return true;
        }
        else {
            return false;
        }
    }

    public function isAdmin(){
        if($this->user_role == "admin"){
            return true;
        }
        else {
            return false;
        }
    }


}