<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Parent
 *
 * @property $id
 * @property $user_id
 * @property $mobile
 * @property $occupation
 * @property $address
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class StudentParent extends Model
{

  static $rules = [
    'mobile' => 'required',
    'occupation' => 'required',
    'address' => 'required',
  ];

  protected $perPage = 20;
  protected $table = 'parents';
  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['user_id', 'mobile', 'occupation', 'address'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function student()
  {
    return $this->hasOne('App\Models\Student', 'parent_id', 'id');
  }
  public function installmentPayment()
  {
    return $this->hasMany('App\Models\InstallmentPayment', 'loan_id', 'id');
  }
}