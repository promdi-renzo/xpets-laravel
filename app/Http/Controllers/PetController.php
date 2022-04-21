<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::join(
            "customers",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "customers.first_name",
                "pets.id",
                "pets.Pet_name",
                "pets.age",
                "pets.sex",
                "pets.type",
                "pets.images",
                "pets.customer_id",
                "pets.deleted_at"
            )
            ->orderBy("pets.id", "ASC")
            ->withTrashed()
            ->paginate(100);

        return view("pets.index", ["pets" => $pets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck("full_name", "id");
        return view("pets.create", [
            "customers" => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        $pets = new Pet();
        $pets->pet_name = $request->input("pet_name");
        $pets->sex = $request->input("sex");
        $pets->classification = $request->input("classification");
        $pets->customer_id = $request->input("customer_id");
        if ($request->hasfile("pictures")) {
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pictures/pets/", $filename);
            $pets->pictures = $filename;
        }
        $pets->save();
        return Redirect::to("/pets");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pets = Pet::find($id);
        $customers = Customer::pluck("full_name", "id");
        return view("pets.show", [
            "pets" => $pets,
            "customers" => $customers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pets = Pet::find($id);
        $customers = Customer::pluck("full_name", "id");
        return view("pets.edit", [
            "pets" => $pets,
            "customers" => $customers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetRequest $request, $id)
    {
        $pets = Pet::find($id);
        $pets->pet_name = $request->input("pet_name");
        $pets->sex = $request->input("sex");
        $pets->classification = $request->input("classification");
        $pets->customer_id = $request->input("customer_id");
        if ($request->hasfile("pictures")) {
            $destination = "pictures/pets/" . $pets->pictures;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pictures/pets/", $filename);
            $pets->images = $filename;
        }
        $pets->update();
        return Redirect::to("pets");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pet::destroy($id);
        return Redirect::to("pets");
    }

    public function restore($id)
    {
        Pet::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("pets.index");
    }

    public function forceDelete($id)
    {
        $pets = Pet::findOrFail($id);
        $destination = "pictures/pets/" . $pets->pictures;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $pets->forceDelete();
        return Redirect::route("pets.index");
    }
}
