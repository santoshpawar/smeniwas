<?php
namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {
    public $table = "addresses";

    protected $fillable = [
        'address1',
        'address2',
        'address3',
        'city',
        'state',
        'pincode'
    ];
}