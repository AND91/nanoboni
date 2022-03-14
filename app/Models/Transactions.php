<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
  use SoftDeletes;
  /**
   * name table
   *
   * @var string
  */
  protected $table = 'transactions';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
  */
  protected $fillable = ['type', 'quantity', 'note', 'employee_id', 'admin_id'];

}
