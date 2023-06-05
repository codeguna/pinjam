<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LoanApproval
 *
 * @property $id
 * @property $loan_id
 * @property $parent_id
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
    'parent_id' => 'required',
    'name' => 'required',
    'level' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['loan_id', 'parent_id', 'name', 'approved', 'level', 'date_approved'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function loan()
  {
    return $this->belongsTo('App\Models\Loan', 'id', 'loan_id');
  }

  public function studentParent()
  {
    return $this->belongsToMany('App\Models\Studentparent', 'id', 'parent_id');
  }
}
