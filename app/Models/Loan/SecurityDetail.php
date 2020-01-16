<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class SecurityDetail extends Model {
    public $table = "loans_security_details";

    protected $fillable = [
        'loan_id',
        'is_collateral_property',
        'othersecurity_type',
       // 'others_value',
        'collateral_type',
        'area',
        'city',
        'pincode',
        'owner',
        'latest_valuation',
        'occupied_type',
        'equipment_type',
        //'equipment_type_others',
        'description',
        'sourced_type',
        'manufacturer_name_mandatory',
        'manufacture_year_mandatory',
        'manufacturer_name',
        'manufacture_year',
        'invoice_cif_in_lacs',
        'custom_duty',
        'invoice_cif_in_usd',
        'invoice_value',
        'avl_doc_name_1',
        'avl_doc_name_2',
        'avl_doc_name_3',
        'avl_doc_name_4',
        'avl_doc_name_5',
        'avl_doc_name_6',
        'avl_doc_name_7',
        'avl_doc_name_8',
        'avl_doc_name_9',
        'avl_doc_name_10',
        'avl_doc_name_11',
        'avl_doc_name_12',
        'natureOfInventory',
        'typeOfInventory',
        'valuOfInventory',
        'otherSecurityOther',
        'propertyLand',
        'nameOfLessor',
        'is_any_other_security',
        'propertyIs'

    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}