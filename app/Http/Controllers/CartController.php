<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $services = DB::table("services")
            ->select(
                "services.service_name",
                "services.cost",
                "services.images",
            )

            ->get();

        $customers = Customer::pluck("full_name", "id");
        $pets = Pet::pluck("pet_name", "id");
        return view("carts.index", [
            "services" => $services,
            "customers" => $customers,
            "pets" => $pets,
        ]);
    }

    public function add($service, $customer, $pet)
    {
        try {
            DB::beginTransaction();
            $cart = new Cart();
            $cart->cart = $service;
            $cart->customer_id = $customer;
            $cart->service_id = $pet;
            $cart->save();
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()->route('carts.index')->with(
                "error",
                $e->getMessage()
            );
        }
        DB::commit();
        return Redirect::to("/cart");
    }
}
