<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property $id
 * @property $user_id
 * @property $nim
 * @property $class_id
 * @property $address
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Student extends Model
{

  static $rules = [
    'name' => 'required',
    'nim' => 'required',
    'class_id' => 'required',
    'address' => 'required',
  ];

  protected $perPage = 20;
  protected $table = 'students';
  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['parent_id', 'nim', 'name', 'class_id', 'address'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function user()
  {
    return $this->hasOne('App\User');
  }

  public function classRoom()
  {
    return $this->belongsTo('App\Models\ClassRoom', 'class_id', 'id');
  }

  public function studentParent()
  {
    return $this->belongsTo('App\Models\StudentParent', 'parent_id', 'id');
  }
}