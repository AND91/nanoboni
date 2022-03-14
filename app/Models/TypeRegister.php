<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeRegister extends Model
{
  /**
   * name table
   *
   * @var string
  */
  protected $table = 'type_register';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
  */
  protected $fillable = ['profile', 'description'];
}
