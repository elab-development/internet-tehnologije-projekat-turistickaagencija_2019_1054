<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;

class AdController extends Controller
{
  public function index()
{
    // Proverava da li postoji parametar 'cat' u zahtevu
    if (isset(request()->cat)) {
        // Pronalazi kategoriju koja odgovara imenu prosleđenom kroz 'cat' parametar
       // $cat = Category::where('name', request()->cat)->first();
        
        // Ako je kategorija pronađena, dohvata sve oglase povezane sa tom kategorijom
        // Uključen je i `category` model sa svakim oglasom pomoću `with` za optimizaciju upita
       // $all_ads = Ad::with('category')->where('category_id', $cat->id)->get();
      // Koristi whereHas da dohvati sve oglase koji pripadaju kategoriji sa određenim imenom
      $all_ads = Ad::whereHas('category',function ($query)
      {
         // $query->where('name',request()->cat);
         $query->whereName(request()->cat);

      })->get();
      

    } else {
        // Ako 'cat' parametar nije postavljen, dohvata sve oglase
        $all_ads = Ad::all();
    }

    // Dohvata sve kategorije koje se prikazuju kao filteri ili meni u prikazu
    $categories = Category::all();

    // Prosleđuje varijable `all_ads` i `categories` u `welcome` pogled
    return view('welcome', compact('all_ads', 'categories'));
}
  public function show($id){

    $single_ad = Ad::find($id);

    if (Auth::check() && Auth::user()->id !== $single_ad->user_ad) {
      $single_ad->increment('views');
  }
   
    return view('singleAd',compact('single_ad'));

}
}
