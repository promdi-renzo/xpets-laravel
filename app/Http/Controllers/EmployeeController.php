<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateController;
use App\Http\Requests\LoginRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{

    public function getSignup()
    {
        return view("employee.signup");
    }

    public function postSignup(EmployeeRequest $request)
    {
        $Employees = new Employee([
            "full_name" => $request->full_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role,
        ]);

        $Employees->save();
        Auth::login($Employees);
        return redirect::route("employee.dashboard");
    }

    public function Dashboard()
    {
        return view("employee.dashboard");
    }

    public function getLogout()
    {
        Auth::logout();
        return view("employee.signin");
    }

    public function getSignin()
    {
        return view("employee.signin");
    }

    public function postSignin(LoginRequest $request)
    {
        if (
            Auth::attempt([
                "email" => $request->input("email"),
                "password" => $request->input("password"),
            ])
        ) {
            return redirect::route("employee.dashboard");
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Employees = Employee::withTrashed()->paginate(100);

        return view("employee.index", [
            "employees" => $Employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  return view("employee.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Employees = Employee::find($id);
        return view("employee.show")->with("employees", $Employees);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Employees = Employee::find($id);
        return view("employee.edit")->with("employees", $Employees);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateController $request, $id)
    {
        $employees = Employee::find($id);
        $employees->full_name = $request->input("full_name");
        $employees->email = $request->input("email");
        $employees->password = Hash::make($request->input("password"));
        $employees->role = $request->input("role");
        $employees->update();
        return Redirect::to("employee");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return Redirect::to("employee");
    }

    public function restore($id)
    {
        Employee::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("employee.index");
    }

    public function forceDelete($id)
    {
        $Employees = Employee::findOrFail($id);
        $Employees->forceDelete();
        return Redirect::route("employee.index");
    }
}
