<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InstallmentPayment
 *
 * @property $id
 * @property $loan_id
 * @property $parent_id
 * @property $installment
 * @property $isPay
 * @property $payment_date
 * @property $created_at
 * @property $updated_at
 *
 * @property Loan $loan
 * @property Parent $parent
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InstallmentPayment extends Model
{
    
    static $rules = [
		'loan_id' => 'required',
		'installment' => 'required',
		'isPay' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['loan_id','parent_id','installment','isPay','payment_date','attachment'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function loan()
    {
        return $this->hasOne('App\Models\Loan', 'id', 'loan_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentParent()
    {
        return $this->belongsTo('App\Models\StudentParent', 'parent_id', 'id');
    }
    

}