<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::withTrashed()->paginate(100);

        return view("services.index", ["services" => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("services.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $services = new Service();
        $services->service_name = $request->input("service_name");
        $services->cost = $request->input("cost");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("pics/services/", $filename);
            $services->images = $filename;
        }
        $services->save();
        return Redirect::to("/service");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = DB::table('services')
            ->select('services.id', 'services.service_name', 'services.cost', 'services.images')
            ->where('services.id', $id)
            ->get();

        return View::make('services.show', compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::find($id);
        return view("services.edit")->with("services", $services);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $services = Service::find($id);
        $services->service_name = $request->input("service_name");
        $services->cost = $request->input("cost");
        if ($request->hasfile("images")) {
            $destination = "pics/services/" . $services->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pics/services/", $filename);
            $services->images = $filename;
        }
        $services->update();
        return Redirect::to("/service");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);
        return Redirect::to("/service");
    }

    public function restore($id)
    {
        Service::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("service.index");
    }

    public function forceDelete($id)
    {
        $Services = Service::findOrFail($id);
        $destination = "pics/Services/" . $Services->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $Services->forceDelete();
        return Redirect::route("service.index");
    }
}
