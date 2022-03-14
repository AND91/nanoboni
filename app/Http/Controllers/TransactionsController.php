<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;

// Models
use App\Models\Transactions;
use Illuminate\Support\Facades\Session;
use App\Models\Employees;

class TransactionsController extends BaseController {

  public function index() {
    $data['transactions'] = DB::table('transactions as t')
                                          ->join('employees as e', 't.employee_id', '=', 'e.id')
                                          ->select('t.*', 'e.name as employee')
                                          ->get();
    return view('transactions/index')->with($data);
  }

  public function register() {
    $data['employees'] = Employees::all();
    return view('transactions/register')->with($data);
  }

  public function create(Request $request) {
    $transaction = Transactions::create([
      'admin_id' => Auth::user()->id,
      'employee_id' => $request->employee,
      'type' => $request->type,
      'quantity' => $request->quantity,
      'note' => $request->note
    ]);

    $employee = Employees::find($request->employee);

    if ($request->type == 'E') {
      $bank_balance = $employee->bank_balance + $request->quantity;
    } else {
      $bank_balance = $employee->bank_balance - $request->quantity;
    }

    $data = [
      'bank_balance' => $bank_balance
    ];
    $employee->update($data);

    return redirect('movimentacoes');
  }

}
