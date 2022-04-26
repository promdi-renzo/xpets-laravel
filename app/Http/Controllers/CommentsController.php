<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{

    public function index()
    {
        $comments = DB::table("comments")
            ->join(
                "customers",
                "customers.id",
                "=",
                "comments.customer_id"
            )
            ->join(
                "services",
                "services.id",
                "=",
                "comments.service_id"
            )
            ->select(
                "comments.comment",
                "comments.id",
                "customers.full_name",
                "services.service_name",
            )

            ->get();
        error_log("Here");
        return view("comments.index", [
            "comments" => $comments,
        ]);
    }

    public function create()
    {
        $customers = Customer::pluck("full_name", "id");
        $services = Service::pluck("service_name", "id");

        return view("comments.create", [
            "customers" => $customers,
            "services" => $services,
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $comment = new Comments();
            $comment->comment = $request->input("comment");
            $comment->customer_id = $request->input("customer_id");
            $comment->service_id = $request->input("service_id");
            $comment->save();
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()->route('comments.index')->with(
                "error",
                $e->getMessage()
            );
        }
        DB::commit();
        return Redirect::to("/comment");
    }
}
