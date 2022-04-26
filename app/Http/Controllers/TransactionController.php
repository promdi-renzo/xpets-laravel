<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            ->leftjoin(
                "employees",
                "employees.id",
                "=",
                "transactions.employee_id"
            )
            ->select(
                "transactions.id",
                "pets.pet_name",
                "services.service_name",
                "employees.full_name",
                "transactions.date",
                "transactions.deleted_at",
                "transaction_line.deleted_at",
            )

            ->orderBy("transaction_line.transaction_id", "ASC")
            ->withTrashed()
            ->paginate(100);

        return view("transaction.index", [
            "customers" => $customers,
        ]);
    }

    public function getInformation()
    {
        $pets = pet::join(
            "customers",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "customers.full_name",
                "pets.id",
                "pets.pet_name",
                "pets.sex",
                "pets.pictures",
                "pets.customer_id",
                "pets.classification"
            )
            ->get();
        $services = Service::all();
        return view("transaction.information", [
            "services" => $services,
            "pets" => $pets,
        ]);
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('transaction.shopping-cart');
        }
        $oldService = Session::get('cart');
        $cart = new Cart($oldService);
        return view('transaction.shopping-cart', ['services' => $cart->services, 'pets' => $cart->pets, 'totalCost' => $cart->totalCost]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $services = Service::find($id);
        $oldService = Session::has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldService);
        $cart->add($services, $services->id);
        $request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        $request->session()->save();
        return redirect()->route("information");
    }

    public function getPet(Request $request, $id)
    {
        $pets = Pet::find($id);
        $oldService = Session::has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldService);
        $cart->addPet($pets, $pets->id);
        $request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        $request->session()->save();
        return redirect()->route("information");
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeService($id);
        if (count($cart->services) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('transaction.shoppingCart');
    }

    public function removeService($id)
    {
        $this->totalCost -= $this->services[$id]['cost'];
        unset($this->services[$id]);
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has("cart")) {
            return redirect()->route("transaction.index");
        }
        $oldCart = Session::get("cart");
        $cart = new Cart($oldCart);
        try {
            DB::beginTransaction();
            foreach ($cart->services as $services) {
                foreach ($cart->pets as $pets) {
                    $id = $services["services"]["id"];
                    $pets_id = $pets["pets"]["id"];
                    DB::table("transactions")->insert([
                        "employee_id" => Auth::id(),
                        "service_id" => $id,
                        "pets_id" => $pets_id,
                        "created_at" => now(),
                        "updated_at" => now(),
                        "date" => now(),
                    ]);
                }
            }
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()
                ->route("transaction.shoppingCart")
                ->with("error", $e->getMessage());
        }
        DB::commit();
        Session::forget("cart");
        return redirect()->route("receipt");
    }

    public function getReceipt()
    {
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

            ->orderBy("transactions.id", "DESC")
        // ->where("pets.id" = "transations.id")
            ->latest("transactions.id")
            ->take("3")
            ->get();
        return view("transaction.receipt", [
            "customers" => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
