<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Loan
 *
 * @property $id
 * @property $parent_id
 * @property $loan_date
 * @property $loan_purpose
 * @property $loan_amount
 * @property $long_installment
 * @property $installment_amount
 * @property $account_number
 * @property $attachment
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Loan extends Model
{
    
    static $rules = [
		'parent_id' => 'required',
		'loan_date' => 'required',
		'loan_purpose' => 'required',
		'loan_amount' => 'required',
		'long_installment' => 'required',
		'installment_amount' => 'required',
		'account_number' => 'required',
		'attachment' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id','loan_date','loan_purpose','loan_amount','long_installment','installment_amount','account_number','attachment'];



}
