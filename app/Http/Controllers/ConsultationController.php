<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationRequest;
use App\Models\Consultation;
use App\Models\Employee;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ConsultationController extends Controller
{

    public function search()
    {
        $consultations = Consultation::join(
            "employees",
            "employees.id",
            "=",
            "consultations.employee_id"
        )
            ->join(
                "pets",
                "pets.id",
                "=",
                "consultations.animal_id"
            )
            ->select(
                "employees.full_name",
                "pets.pet_name",
                "consultations.id",
                "consultations.date",
                "consultations.disease_injury",
                "consultations.price",
                "consultations.comment",
                "consultations.employee_id",
                "consultations.animal_id",
                "consultations.deleted_at"
            )
            ->orderBy("consultations.id", "ASC")
            ->get();
        return view("consultations.search", [
            "consultations" => $consultations,
        ]);
    }

    public function results()
    {
        $result = $_GET["result"];
        $consultations = DB::table("consultations")
            ->join(
                "pets",
                "pets.id",
                "=",
                "consultations.animal_id"
            )
            ->join(
                "employees",
                "employees.id",
                "=",
                "consultations.employee_id"
            )
            ->select(
                "employees.full_name",
                "pets.pet_name",
                "consultations.id",
                "consultations.date",
                "consultations.disease_injury",
                "consultations.price",
                "consultations.comment",
                "consultations.employee_id",
                "consultations.animal_id",
                "consultations.deleted_at"
            )

            ->where("pets.pet_name", $result)
            ->get();

        return view("consultations.result", [
            "consultations" => $consultations,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultations = Consultation::join(
            "employees",
            "employees.id",
            "=",
            "consultations.employee_id"
        )
            ->join(
                "pets",
                "pets.id",
                "=",
                "consultations.animal_id"
            )
            ->select(
                "employees.full_name",
                "pets.pet_name",
                "consultations.id",
                "consultations.date",
                "consultations.disease_injury",
                "consultations.price",
                "consultations.comment",
                "consultations.employee_id",
                "consultations.animal_id",
                "consultations.deleted_at"
            )
            ->orderBy("consultations.id", "ASC")
            ->withTrashed()
            ->paginate(100);

        return view("consultations.index", ["consultations" => $consultations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pets = Pet::pluck("pet_name", "id");
        $employees = employee::pluck("full_name", "id");
        return view("consultations.create", [
            "pets" => $pets,
            "employees" => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $consultations = new Consultation();
            $consultations->date = $request->input("date");
            $consultations->disease_injury = $request->input("disease_injury");
            $consultations->price = $request->input("price");
            $consultations->comment = $request->input("comment");
            $consultations->employee_id = $request->input("employee_id");
            $consultations->animal_id = $request->input("animal_id");
            $consultations->save();
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()->route('consultation.index')->with(
                "error",
                $e->getMessage()
            );
        }
        DB::commit();
        return Redirect::to("/consultation");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consultations = Consultation::find($id);
        $pets = Pet::pluck("pet_name", "id");
        $employees = employee::pluck("full_name", "id");
        return view("consultations.show", [
            "pets" => $pets,
            "employees" => $employees,
            "consultations" => $consultations,
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
        $consultations = Consultation::find($id);
        $pets = Pet::pluck("pet_name", "id");
        $employees = employee::pluck("full_name", "id");
        return view("consultations.edit", [
            "pets" => $pets,
            "employees" => $employees,
            "consultations" => $consultations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsultationRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $consultations = Consultation::find($id);
            $consultations->date = $request->input("date");
            $consultations->disease_injury = $request->input("disease_injury");
            $consultations->price = $request->input("price");
            $consultations->comment = $request->input("comment");
            $consultations->employee_id = $request->input("employee_id");
            $consultations->animal_id = $request->input("animal_id");
            $consultations->update();
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()->route('consultation.index')->with(
                "error",
                $e->getMessage()
            );
        }
        DB::commit();
        return Redirect::to("/consultation");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Consultation::destroy($id);
        return Redirect::route("consultation.index");
    }

    public function restore($id)
    {
        Consultation::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("consultation.index");
    }

    public function forceDelete($id)
    {
        Consultation::findOrFail($id)->forceDelete();
        return Redirect::route("consultation.index");
    }
}
