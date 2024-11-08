<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    //addDeposit metoda: Ovo je metoda koja se poziva kada korisnik pristupi /home/add-deposit. Metoda vraća view home.partials.addDeposit, gde se prikazuje forma za dodavanje depozita.
    public function addDeposit()
    {
        return view('home.partials.addDeposit');
    }
    public function updateDeposit(Request $request){

        $user = Auth::user();


        $request->validate([
            "deposit"=>"required|max:4"

        ],
        [
            "deposit.max"=>"Can't add more then 9999 rsd at once"

        ]);
        $user->deposit =  $user->deposit + $request->deposit;
        return redirect(route('home'));
    }
    //Metoda učitava sve kategorije iz baze koristeći Category::all() i prosleđuje ih view-u showAddForm kako bi korisnik mogao izabrati kategoriju prilikom dodavanja oglasa.
    public function showAddForm(){
        $allCategories = Category::all();
        return view('home.showAddForm',['categories'=>$allCategories]);
    }
} 
