<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function review()
    {
        $services = Service::pluck("service_name", "id");
        return view("review", [
            "services" => $services,
        ]);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $contacts = [
            "name" => $request->name,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "review" => $request->review,
            "service_id" => $request->service_id,
        ];
        Contact::create($contacts);
        Mail::to("gabrielarafol.mendoza@tup.edu.ph")->send(
            new ContactMail($contacts)
        );
        return back()->with("success", "Feedback Successfully Send");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::join(
            "services",
            "services.id",
            "=",
            "contacts.service_id"
        )
            ->select(
                "services.service_name",
                "contacts.id",
                "contacts.name",
                "contacts.email",
                "contacts.phone_number",
                "contacts.review",
                "contacts.service_id",
                "contacts.deleted_at"
            )
            ->orderBy("contacts.id", "ASC")
            ->withTrashed()
            ->paginate(100);

        return view("contacts.index", [
            "contacts" => $contacts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacts = Contact::find($id);
        $services = Service::pluck("service_name", "id");
        return view("contacts.show", [
            "contacts" => $contacts,
            "services" => $services,
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
        return Redirect::to("contacts");
    }

    public function restore($id)
    {
        Contact::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("contacts.index");
    }

    public function forceDelete($id)
    {
        $contacts = Contact::findOrFail($id);
        $contacts->forceDelete();
        return Redirect::route("contacts.index");
    }
}
