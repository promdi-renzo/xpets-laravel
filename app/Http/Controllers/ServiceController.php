<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::withTrashed()->paginate(6);

        if (session(key:"success_message")) {
            Alert::image(
                "Congratulations!",
                session(key:"success_message"),
                "https://media1.giphy.com/media/RlI8KU5ZPym0f1bZoF/giphy.gif?cid=6c09b952413438a6eef5934ef4253170b611937fa7566f75&rid=giphy.gif&ct=s",
                "200",
                "200",
                "I Am A Pic"
            );
        }

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
            $file->move("uploads/services/", $filename);
            $services->images = $filename;
        }
        $services->save();
        return Redirect::to("/service")->withSuccessMessage(
            "New Service Added!"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = Service::find($id);
        return view("services.show")->with("services", $services);
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
            $destination = "uploads/services/" . $services->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/services/", $filename);
            $services->images = $filename;
        }
        $services->update();
        return Redirect::to("/service")->withSuccessMessage(
            "Service Data Updated!"
        );
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
        return Redirect::to("/service")->withSuccessMessage(
            "Service Data Deleted!"
        );
    }

    public function restore($id)
    {
        Service::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("service.index")->withSuccessMessage(
            "Service Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $Services = Service::findOrFail($id);
        $destination = "uploads/Services/" . $Services->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $Services->forceDelete();
        return Redirect::route("service.index")->withSuccessMessage(
            "Service Data Permanently Deleted!"
        );
    }
}
