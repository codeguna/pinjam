<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LoanApproval
 *
 * @property $id
 * @property $loan_id
 * @property $user_id
 * @property $name
 * @property $approved
 * @property $level
 * @property $date_approved
 * @property $created_at
 * @property $updated_at
 *
 * @property Loan $loan
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class LoanApproval extends Model
{
    
    static $rules = [
		'loan_id' => 'required',
		'user_id' => 'required',
		'name' => 'required',
		'approved' => 'required',
		'level' => 'required',
		'date_approved' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['loan_id','user_id','name','approved','level','date_approved'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function loan()
    {
        return $this->belongsTo('App\Models\Loan');
    }
    

}