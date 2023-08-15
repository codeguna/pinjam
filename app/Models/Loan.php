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
    'loan_date' => 'required',
    'loan_purpose' => 'required',
    'loan_amount' => 'required',
    'long_installment' => 'required',
    'installment_amount' => 'required',
    'account_number' => 'required',
    'attachment_kk' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
    'attachment_ktp_orang_tua' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
    'attachment_ktp_mahasiswa' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = [
    'parent_id',
    'loan_date',
    'loan_purpose',
    'loan_amount',
    'long_installment',
    'installment_amount',
    'account_number',
    'attachment_kk',
    'attachment_ktp_orang_tua',
    'attachment_ktp_mahasiswa'
  ];

  public function loanApproval()
  {
    return $this->hasMany('App\Models\LoanApproval');
  }

  public function studentParent()
  {
    return $this->belongsTo('App\Models\StudentParent', 'parent_id', 'id');
  }
  public function student()
  {
    return $this->belongsTo('App\Models\Student', 'parent_id');
  }

  public function installmentPayment()
  {
    return $this->hasMany('App\Models\InstallmentPayment');
  }
}