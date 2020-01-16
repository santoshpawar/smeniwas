<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanAdminChecklist extends Model
{
     protected $table = 'loanadmin_checklist';
    //primary key
    
    public $primaryKey = 'id';

    //Timestamp
    public $timestamps = true;
}
