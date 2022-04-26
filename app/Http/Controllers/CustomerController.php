<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::leftJoin(
            "pets",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "customers.id",
                "customers.full_name",
                "customers.number",
                "customers.pictures",
                "customers.deleted_at",
                "pets.pet_name"
            )
            ->orderBy("customers.id", "ASC")
            ->withTrashed()
            ->paginate(100);

        return view("customers.index", ["customers" => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $Customers = new Customer();
        $Customers->full_name = $request->input("full_name");
        $Customers->number = $request->input("number");
        if ($request->hasfile("pictures")) {
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pics/customers/", $filename);
            $Customers->pictures = $filename;
        }
        $Customers->save();
        return Redirect::to("customer");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $customers = Customer::leftJoin(
            "pets",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "customers.id",
                "customers.full_name",
                "customers.number",
                "customers.pictures",
                "customers.deleted_at",
                "pets.pet_name"
            )
            ->where('customers.id', $id)
            ->get();

        return View::make('customers.show', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::find($id);
        return View::make("customers.edit", compact("customers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $Customers = Customer::find($id);
        $Customers->full_name = $request->input("full_name");
        $Customers->number = $request->input("number");
        if ($request->hasfile("pictures")) {
            $destination = "pics/customers/" . $Customers->pictures;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pics/customers/", $filename);
            $Customers->pictures = $filename;
        }
        $Customers->update();
        return Redirect::to("customer");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return Redirect::to("customer");
    }

    public function restore($id)
    {
        Customer::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("customer.index");
    }

    public function forceDelete($id)
    {
        $Customers = Customer::findOrFail($id);
        $destination = "pics/customers/" . $Customers->pictures;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $Customers->forceDelete();
        return Redirect::route("customer.index");
    }

    public function result()
    {
        $result = $_GET["result"];
        $customers = Customer::rightJoin(
            "pets",
            "pets.customer_id",
            "=",
            "customers.id"
        )
            ->rightjoin(
                "transactions",
                "transactions.pets_id",
                "=",
                "pets.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transactions.service_id"
            )
            ->select(
                "customers.full_name",
                "pets.pet_name",
                "services.service_name",
                "services.cost",
                "transactions.id",
                "customers.deleted_at"
            )

            ->where("customers.full_name", "LIKE", "%" . $result . "%")
            ->get();
        return view("customers.result", [
            "customers" => $customers,
        ]);
    }
}
