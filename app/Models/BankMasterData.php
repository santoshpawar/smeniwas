<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class BankMasterData extends Model
{
    public $table = "bank_master_datas";

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
