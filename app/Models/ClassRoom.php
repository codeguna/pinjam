<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClassRoom
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ClassRoom extends Model
{

  static $rules = [
    'name' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function student()
  {
    return $this->hasMany('App\Models\Student');
  }
}
