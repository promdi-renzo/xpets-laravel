<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PersonnelRequest;
use App\Http\Requests\PersonnelUpdateController;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PersonnelController extends Controller
{
    public function Email()
    {
        return view("personnels.email");
    }

    public function Reset()
    {
        return view("personnels.reset");
    }

    public function getSignup()
    {
        return view("personnels.signup");
    }

    public function postSignup(PersonnelRequest $request)
    {
        $personnels = new Personnel([
            "full_name" => $request->full_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role,
        ]);

        $personnels->save();
        Auth::login($personnels);
        return redirect::route("personnels.dashboard")->withSuccessMessage(
            "New Personnel Added!"
        );
    }

    public function Dashboard()
    {
        return view("personnels.dashboard");
    }

    public function getLogout()
    {
        Auth::logout();
        return view("personnels.signin");
    }

    public function getSignin()
    {
        return view("personnels.signin");
    }

    public function postSignin(LoginRequest $request)
    {
        if (
            Auth::attempt([
                "email" => $request->input("email"),
                "password" => $request->input("password"),
            ])
        ) {
            return redirect::route("personnels.dashboard");
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
        $personnels = Personnel::withTrashed()->paginate(6);
        //$personnels = Personnel::all();

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

        return view("personnels.index", [
            "personnels" => $personnels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  return view("personnels.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonnelRequest $request)
    {
        //  $personnels = new Personnel();
        //  $personnels->full_name = $request->input("full_name");
        //  $personnels->email = $request->input("email");
        //  $personnels->password = Hash::make($request->input("password"));
        //  $personnels->role = $request->input("role");
        //  if ($request->hasfile("images")) {
        //      $file = $request->file("images");
        //      $extension = $file->getClientOriginalExtension();
        //      $filename = time() . "." . $extension;
        //      $file->move("uploads/personnels/", $filename);
        //      $personnels->images = $filename;
        //  }
        //  $personnels->save();
        //  return Redirect::to("login")->with("success", "New Personnel Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personnels = Personnel::find($id);
        return view("personnels.show")->with("personnels", $personnels);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personnels = Personnel::find($id);
        return view("personnels.edit")->with("personnels", $personnels);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonnelUpdateController $request, $id)
    {
        $personnels = Personnel::find($id);
        $personnels->full_name = $request->input("full_name");
        $personnels->email = $request->input("email");
        $personnels->password = Hash::make($request->input("password"));
        $personnels->role = $request->input("role");
        $personnels->update();
        return Redirect::to("personnel")->withSuccessMessage(
            "Personnel Data Updated!"
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
        Personnel::destroy($id);
        return Redirect::to("personnel")->withSuccessMessage(
            "Personnel Data Deleted!"
        );
    }

    public function restore($id)
    {
        Personnel::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("personnel.index")->withSuccessMessage(
            "Personnel Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $personnels = Personnel::findOrFail($id);
        $personnels->forceDelete();
        return Redirect::route("personnel.index")->withSuccessMessage(
            "Personnel Data Permanently Deleted!"
        );
    }
}
