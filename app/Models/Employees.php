<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
  use SoftDeletes;
  /**
   * name table
   *
   * @var string
  */
  protected $table = 'employees';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
  */
  protected $fillable = ['id_admin', 'name', 'login', 'password', 'bank_balance', 'created_at', 'updated_at'];

}
