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

    public function search()
    {
        $customers = Customer::rightJoin(
            "pets",
            "pets.customer_id",
            "=",
            "customers.id"
        )
            ->rightjoin(
                "transaction_line",
                "transaction_line.animal_id",
                "=",
                "pets.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transaction_line.service_id"
            )
            ->leftjoin(
                "transactions",
                "transactions.id",
                "=",
                "transaction_line.transaction_id"
            )
            ->select(
                "customers.first_name",
                "pets.animal_name",
                "services.service_name",
                "services.cost",
                "transactions.id",
                "customers.deleted_at"
            )

            ->orderBy("customers.id", "ASC")
            ->get();
        return view("customers.search", [
            "customers" => $customers,
        ]);
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
                "transaction_line",
                "transaction_line.animal_id",
                "=",
                "pets.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transaction_line.service_id"
            )
            ->leftjoin(
                "transactions",
                "transactions.id",
                "=",
                "transaction_line.transaction_id"
            )
            ->select(
                "customers.first_name",
                "pets.animal_name",
                "services.service_name",
                "services.cost",
                "transactions.id",
                "customers.deleted_at"
            )

            ->where("customers.first_name", "LIKE", "%" . $result . "%")
            ->get();
        return view("customers.result", [
            "customers" => $customers,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Customers = Customer::leftJoin(
            "pets",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "Customers.id",
                "Customers.first_name",
                "Customers.last_name",
                "Customers.phone_number",
                "Customers.images",
                "Customers.deleted_at",
                "pets.animal_name"
            )
            ->orderBy("Customers.id", "ASC")
            ->withTrashed()
            ->paginate(100);

        return view("customers.index", ["customers" => $Customers]);

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
        $Customers->first_name = $request->input("first_name");
        $Customers->last_name = $request->input("last_name");
        $Customers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/customers/", $filename);
            $Customers->images = $filename;
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
        $Customers = Customer::find($id);
        return View::make("customers.show", compact("Customers"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Customers = Customer::find($id);
        return View::make("customers.edit", compact("Customers"));
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
        $Customers->first_name = $request->input("first_name");
        $Customers->last_name = $request->input("last_name");
        $Customers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $destination = "uploads/customers/" . $Customers->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/customers/", $filename);
            $Customers->images = $filename;
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
        $destination = "uploads/customers/" . $Customers->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $Customers->forceDelete();
        return Redirect::route("customer.index");
    }
}
