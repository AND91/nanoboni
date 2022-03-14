<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

// Models
use App\Models\{Employees, Transactions};
use Illuminate\Support\Facades\Session;

class EmployeesController extends BaseController {

  public function index() {
    $data['employees'] = Employees::all();
    return view('employees/index')->with($data);
  }

  public function register() {
    return view('employees/register');
  }

  public function create(Request $request) {
    $employee = Employees::create([
      'id_admin' => Auth::user()->id,
      'name' => $request->name,
      'login' => $request->email,
      'password' => Hash::make($request->password),
      'bank_balance' => 0
    ]);

    return redirect('funcionarios/detalhe/'.$employee->id);
  }

  public function detail($id) {
    $data['employee'] = Employees::find($id);
    $data['transactions'] = Transactions::select('transactions.id', 'transactions.type', 'transactions.quantity', 'transactions.note', 'transactions.employee_id', 'transactions.admin_id', 'transactions.updated_at',
       'u.name')
    ->join('users as u', 'transactions.admin_id', '=', 'u.id')  
    ->where('employee_id',$id)
    ->get();

    return view('employees/detail')->with($data);
  }

  public function updateEmployee(Request $request){

    $data = [
      'name' => $request->name,
      'login' => $request->email
    ];

    $employee = Employees::find($request->id_employee);
    $employee->update($data);

    return redirect('funcionarios/detalhe/'.$request->id_employee);
  }

}
