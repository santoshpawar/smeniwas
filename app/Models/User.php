<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Config;
use App\Models\Messenger\Messagable;
use Illuminate\Contracts\Auth\Registrar;
use Auth;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    public function __construct() {
        //$this->loginNames = ['email','username'];
    }

use Authenticatable,
    CanResetPassword,
    Messagable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'bank_id',
        'permissions',
    ];
    protected static $rolesModel = 'App\Models\Roles';
    

    public function roles() {
        return $this->belongsToMany(static::$rolesModel, 'role_users', 'user_id', 'role_id')->withTimestamps();
    }
    
    public function MobileAppDataDetail() {
        return $this->hasOne('App\Models\Loan\MobileAppData', 'Email', 'email');
    }
      public function getRefereedUserDetail() {
        return $this->hasMany('App\Models\UserProfile', 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userProfile() {
        return $this->hasOne('App\Models\UserProfile')->get()->first();
    }

    public function getRefereedUser() {
        return $this->hasMany('App\Models\UserProfile', 'id', 'user_id');
    }

    public function getLoans() {
        return $this->hasMany('App\Models\Loan\Loan', 'id', 'user_id');
    }

    public function isSME() {
        return $this->checkRole(Config::get('constants.RL_SME'));
    }

    public function isCA() {
        return $this->checkRole(Config::get('constants.RL_CP'));
    }

    public function isAnalyst() {

        return $this->checkRole(Config::get('constants.RL_ANALYST'));
    }
     

    public function isBroker() {
//        dd($this->checkRole(Config::get('constants.RL_BROKER')));
        return $this->checkRole(Config::get('constants.RL_BROKER'));
    }

    public function isAdmin() {
        return $this->checkRole(Config::get('constants.RL_ADMIN'));
    }

    public function isExecutive() {
        return $this->checkRole(Config::get('constants.RL_EXECUTIVE'));
    }

    public function isBankUser() {
        return $this->checkRole(Config::get('constants.RL_BANK_USER'));
    }    
    public function isApproveUser() {
        return $this->checkRole(Config::get('constants.RL_APPROVE_USER'));
    }

    public function isManagement() {
        return $this->checkRole(Config::get('constants.RL_MANAGEMENT'));
    }

     public function isApproverUser() {
        return $this->checkRole(Config::get('constants.RL_APPROVE_USER'));
    }
    public function isLoanAdmin() {
        return $this->checkRole(Config::get('constants.RL_LOAN_ADMIN'));
    }

    public function isSMENiwasEmployee() {
        return ($this->isAdmin() || $this->isAnalyst() || $this->isExecutive() || $this->isManagement());
    }

    protected function checkRole($roleName) {
        $role = Roles::where('slug', '=', $roleName)->get()->first();
        $userRoles = $this->roles()->get();
        if (isset($role) && count($role) > 0) {
            foreach ($userRoles as $userRole) {
                if ($userRole->pivot->role_id == $role->id) {
                    return true;
                }
            }
        } else {
            return false;
        }
//        return false;
    }

}
